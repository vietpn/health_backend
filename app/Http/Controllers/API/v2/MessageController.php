<?php

namespace App\Http\Controllers\API\v2;

use App\Define\Systems;
use App\Events\MessageSent;
use App\Http\Requests\API\MessageRequest;
use App\Models\Backend\ProfilePlusHistory;
use App\Models\Message;
use App\Models\NgWord;
use App\Models\ProfileHistory;
use App\Repositories\Api\ChatRepository;
use App\Repositories\Api\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;
use Intervention\Image\ImageManagerStatic as Image;
use DB;
use Validator;

class MessageController extends AppBaseController
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepositoryRepository)
    {
        $this->profileRepository = $profileRepositoryRepository;
    }

    public function getMessages($id, Request $request)
    {
        try {
            $profileSent = $this->profileRepository->getInfor();
            $page = (int)$request->get('page', 1);
            $limit = (int)$request->get('limit', 15);
            $offset = ($page == 1) ? 0 : ($page - 1) * $limit;
            $temp = [];
            $message = Message::whereIn('profile_id', [$profileSent->id, $id])
                ->whereIn('profile_sent', [$profileSent->id, $id])
                ->whereIn('profile_recive', [$profileSent->id, $id])
                ->where('is_deleted',STATUS_NONE_DELETED)
                ->orderBy('created_at', SORT_DESC)
                ->limit($limit)->offset($offset)->get();
            if ($message) {
                foreach ($message as $key => $item) {
                    $temp[$key] = $item;

                    $profile = User::select('id', 'avatar_path', 'is_business')->where('id', $item->profile_sent)->first();
                    $temp[$key]['avatar_profile_sent'] = isset($profile) ? $profile->avatar_path : "";
                    $prfileRecive = User::select('id', 'avatar_path', 'is_business')->where('id', $item->profile_recive)->first();
                    $temp[$key]['avatar_profile_recive'] = isset($prfileRecive) ? $prfileRecive->avatar_path : "";

                }
            }
            return $this->sendResponse($temp, MSG_SUCCESS);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), CODE_BAD_REQUEST);
        }

    }

    /**
     * gửi message và bắn message bằng pusher
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sentMessage(MessageRequest $request)
    {
        try {
            $requestAll = [];
            //check những từ cẩm
            $message = $request->get('message', "");
            if (!empty($message)) {
                $ngWord = Systems::_getRedis(NG_WORD);
                if (!empty($ngWord)) {
                    $ngWord = json_decode($ngWord, true);
                    foreach ($ngWord as $item) {
                        if (strpos($message, $item) !== false) {
                            return $this->sendError(__('systems.the_message_has_been_blocked'), CODE_BAD_REQUEST);
                        }
                    }
                }

            }
            \Log::info($request->all(), ['LOG_REQUEST_UPLOAD_IMG' => 1]);
            $requestAll['messages'] = $message;
            $idProfileRecive = $request->get('receiver_id', "");
            //trừ tiền tài khoản gửi tin nhắn trừ 10 point
            $profileSent = $this->profileRepository->getInfor();
            $profileRecive = $this->profileRepository->getByUserId($idProfileRecive);

            if (isset($profileRecive) && $profileRecive['success'] === false) {
                return $this->sendError($profileRecive['data'], CODE_BAD_REQUEST);
            }
            //lấy point trong config point
            $pointDeuction = !empty(Systems::_getRedis('POINT_CHAT_SEND')) ? Systems::_getRedis('POINT_CHAT_SEND') : DEDUCTION_POINT_CHAT;

            $respone = $this->profileRepository->transferPoint(DEDUCTION_POINT, $profileSent->id, $pointDeuction);

            if (!isset($respone) || $respone['success'] === false) {
                return $this->sendError($respone['data'], CODE_BAD_REQUEST);
            }
            //lưu lịch sử trừ tiền user
            ProfileHistory::create([
                'profile_id' => $profileSent->id,
                'point' => CHAT_POINT,
                'type' => CHAT,
            ]);
            //check nếu reply === 0 thì trừ user gửi 10point
            //nếu reply === 1 trừ user gửi 10point và công user nhận 5point
            //check xem profile nhận đã gửi cho profile gửi chưa
            $checkPlusPoint = Message::where('profile_sent', $idProfileRecive)
                ->where('profile_recive', $profileSent->id)->limit(1)->count();

            if ($checkPlusPoint > 0) {
                //cộng tiền cho user được reply
                //lấy point cộng reply
                $pointReply = !empty(Systems::_getRedis('POINT_CHAT_REPLY')) ? Systems::_getRedis('POINT_CHAT_REPLY') : PLUS_POINT_CHAT;
                $responeReply = $this->profileRepository->transferPoint(PLUS_POINT, $idProfileRecive, $pointReply);
                if (!isset($responeReply) || $responeReply['success'] === false) {
                    return $this->sendError($respone['data'], CODE_BAD_REQUEST);
                }
                //cộng tiền cho user
                ProfilePlusHistory::create([
                    'profile_id' => $idProfileRecive,
                    'point' => PLUS_POINT_CHAT,
                    'type' => CHAT,
                ]);
            }
            //check nếu có ảnh thì lưu xong thay ảnh message bằng ảnh rồi trả về
            $image = $request->input('image',"");
            if(!empty($image)){
                $file = 'chat/image' . DIRECTORY_SEPARATOR . date("Y/m/d/H");
                $avatar_name =  time() . '.jpg';
                $avatar_path = Systems::uploadBasse64($image, $file, $avatar_name);
                if ($avatar_path) {
                    $requestAll['image'] = ($avatar_path) ? $avatar_path : null;;
                    $requestAll['is_image'] = ASSERT_ACTIVE;
                    \Log::info($message, ['LOG_RESOPONE_UPLOAD_IMG' => 1]);

                }else{
                    $requestAll['image'] ="";
                    $requestAll['is_image'] = DISABLE;
                }

            }
            //create request insser to banagr message
            $requestAll['profile_id']  = $profileSent->id;
            $requestAll['profile_sent'] = $profileSent->id;
            $requestAll['profile_recive'] = $idProfileRecive;
            $repMsg = Message::create($requestAll);

            if (!$repMsg) {
                return $this->sendError('không lưu được message', CODE_BAD_REQUEST);
            }
            //Bắn message to pusher
            \Log::info(date('Y-m-d H:i:s'), ['LOG_CHAT_TIME_START' => 1]);
            broadcast(new MessageSent($profileSent, $profileRecive, $repMsg))->toOthers();
            \Log::info(date('Y-m-d H:i:s'), ['LOG_CHAT_TIME_END' => 1]);
            return $this->sendResponse($repMsg, MSG_SUCCESS);

        } catch (\Exception $ex) {

            return $this->sendError($ex->getMessage(), CODE_BAD_REQUEST);
        }

    }

    public function listChat(Request $request)
    {
        try {
            $page = (int)$request->get('page', 1);
            $limit = (int)$request->get('limit', 15);
            $offset = ($page == 1) ? 0 : ($page - 1) * $limit;
            $profile = $this->profileRepository->getInfor();

            $firstChat = DB::table('e_messages')
                ->select('profile_sent as profile_chat')
                ->distinct()
                ->whereIn('profile_recive', [$profile->id]);
            $listChat = DB::table('e_messages')
                ->select('profile_recive as profile_chat')->distinct()
                ->whereIn('profile_sent', [$profile->id])
                ->union($firstChat)
                ->limit($limit)->offset($offset)
                ->get();
            $temp = [];
            if ($listChat) {
                foreach ($listChat as $item) {
                    $profileChat = User::select('id', 'name', 'avatar_path', 'is_business', 'online_status as is_online')->find($item->profile_chat);
                    $profileChat->is_online = ($profileChat->is_online == 1) ? true : false;
                    $checkRead = Message::where('profile_recive', $profile->id)
                        ->where('profile_sent', $item->profile_chat)
                        ->where('is_read', 0)->count();
                    $profileChat->is_reply = ($checkRead == 0) ? true : false;
                    array_push($temp, $profileChat);
                }
            }
            return $this->sendResponse($temp, MSG_SUCCESS);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), CODE_BAD_REQUEST);
        }
    }

    /**
     * @param MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatusMsg(MessageRequest $request)
    {
        try {
            $msgId = (int)$request->input('msg_id', "");
            $message = Message::find($msgId)->update(['is_read' => 1]);
            if ($message != true) {
                return $this->sendError('Not save record', CODE_BAD_REQUEST);
            }
            return $this->sendResponse(Message::find($msgId), MSG_SUCCESS);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), CODE_BAD_REQUEST);
        }
    }

    /**
     * @param MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatusAllMsg(MessageRequest $request)
    {
        try {
            $profileSent = (int)$request->input('profile_id', "");
            $profile = $this->profileRepository->getInfor();
            \Log::info(json_encode($profile), ['LOG_CHAT_PROFILE' => $profile->id]);
            if (intval($profileSent) != 0) {
                $message = Message::where('profile_sent', $profileSent)
                    ->where('profile_recive', $profile->id)
                    ->update([
                        'is_read' => 1,
                    ]);
            } else {
                $message = Message::where('profile_recive', $profile->id)
                    ->update([
                        'is_read' => 1,
                    ]);
            }
            return $this->sendResponse(['message' => 'Success'], MSG_SUCCESS);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), CODE_BAD_REQUEST);
        }
    }


}
