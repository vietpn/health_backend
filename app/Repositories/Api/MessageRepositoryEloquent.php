<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 8/29/2017
 * Time: 2:47 PM
 */

namespace App\Repositories\Api;


use App\Define\Systems;
use App\Events\MessageSent;
use App\Models\Message;
use App\Repositories\EloquentRepository;
use InfyOm\Generator\Common\BaseRepository;

class MessageRepositoryEloquent extends EloquentRepository implements MessageRepository
{

    public function getModel()
    {
        return Message::class;
    }

    public function sendMessage($request)
    {
        $return = ['success' => false, 'message' => ''];
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
                            $return['message'] = __('systems.the_message_has_been_blocked');
                            return $return;
                        }
                    }
                }

            }
            \Log::info($request->all(), ['LOG_REQUEST_UPLOAD_IMG' => 1]);
            $requestAll['messages'] = $message;
            $idProfileRecive = $request->get('profile_recive', "");

            //trừ tiền tài khoản gửi tin nhắn trừ 10 point
            $profileSent = $this->profileRepository->getInfor();
            $profileRecive = $this->profileRepository->getByUserId($idProfileRecive);

            if (isset($profileRecive) && $profileRecive['success'] === false) {
                $return['message'] = $profileRecive['data'];
                return $return;
            }
            //lấy point trong config point
            $pointDeuction = !empty(Systems::_getRedis('POINT_CHAT_SEND')) ? Systems::_getRedis('POINT_CHAT_SEND') : DEDUCTION_POINT_CHAT;

            $respone = $this->profileRepository->transferPoint(DEDUCTION_POINT, $profileSent->id, $pointDeuction);

            if (!isset($respone) || $respone['success'] === false) {
                $return['message'] = $profileRecive['data'];
                return $return;
            }
            //lưu lịch sử trừ tiền user
            $this->_model->setTable('e_profile_history')->create([
                'profile_id' => $profileSent->id,
                'point' => CHAT_POINT,
                'type' => CHAT,
            ]);
            //check nếu reply === 0 thì trừ user gửi 10point
            //nếu reply === 1 trừ user gửi 10point và công user nhận 5point
            //check xem profile nhận đã gửi cho profile gửi chưa
            $checkPlusPoint = $this->_model->setTable('e_messages')->where('profile_sent', $idProfileRecive)
                ->where('profile_recive', $profileSent->id)->limit(1)->count();

            if ($checkPlusPoint > 0) {
                //cộng tiền cho user được reply
                //lấy point cộng reply
                $pointReply = !empty(Systems::_getRedis('POINT_CHAT_REPLY')) ? Systems::_getRedis('POINT_CHAT_REPLY') : PLUS_POINT_CHAT;
                $responeReply = $this->profileRepository->transferPoint(PLUS_POINT, $idProfileRecive, $pointReply);
                if (!isset($responeReply) || $responeReply['success'] === false) {
                    $return['message'] = $respone['data'];
                    return $return;
                }
                //cộng tiền cho user
                $this->_model->setTable('e_profile_history')->create([
                    'profile_id' => $idProfileRecive,
                    'point' => PLUS_POINT_CHAT,
                    'type' => CHAT,
                ]);
            }
            //check nếu có ảnh thì lưu xong thay ảnh message bằng ảnh rồi trả về

            if ($request->hasFile('img')) {
                $photo_path = Systems::uploadPhoto(
                    $request->file('img'),
                    'chat/image' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
                );
                $requestAll['messages'] = ($photo_path) ? $photo_path : null;;
                $requestAll['is_image'] = ASSERT_ACTIVE;
                \Log::info($message, ['LOG_RESOPONE_UPLOAD_IMG' => 1]);
            }

            //create request insser to banagr message

            $requestAll['profile_sent'] = $profileSent->id;
            $requestAll['profile_recive'] = $idProfileRecive;
            $repMsg = $profileSent->getMesssage()->create($requestAll);

            if (!$repMsg) {
                $return['message'] = __('systems.not_save_data');
                return $return;
            }
            //Bắn message to pusher
            \Log::info(date('Y-m-d H:i:s'), ['LOG_CHAT_TIME_START' => 1]);
            broadcast(new MessageSent($profileSent, $profileRecive, $repMsg))->toOthers();
            \Log::info(date('Y-m-d H:i:s'), ['LOG_CHAT_TIME_END' => 1]);
            $return['success'] = true;
            $return['message'] = $repMsg;

        } catch (\Exception $exception) {
            $return['message'] = $exception->getMessage();
        }
        return $return;
    }
}