<?php

namespace App\Repositories\Api;

use App\Define\Systems;
use App\Events\UserLogin;
use App\Http\Controllers\AppBaseController;
use App\Models\BaseModel;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\Message;
use App\Models\NmCategoryItem;
use App\Models\OauthAccessTokens;
use App\Models\PasswordReset;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostFavorite;
use App\Models\PostLike;
use App\Models\ProfileBlock;
use App\Models\ProfileCostume;
use App\Models\ProfileFavorite;
use App\Models\ProfileHistory;
use App\Models\ProfileItemHistory;
use App\Models\ProfileReport;
use App\Models\ProfileUser;
use App\Models\ProfileBussines;
use App\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Intervention\Image\ImageManagerStatic as Image;
use InfyOm\Generator\Common\BaseRepository;
use Mockery\Exception;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Api\ProfileRepository;
use Elasticsearch;
use DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Profiler\Profile;

/**
 * Class ProfileRepositoryRepositoryEloquent
 * @package namespace App\Repositories\Api;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return User::class;
    }

    protected $fillable = [
        'name', 'email', 'password', 'description', 'weight', 'height',
        'gender', 'gender_visivility', 'birthday_visivility', 'blood_type',
        'zodiac_sign', 'hometown', 'personnality', 'special_skills',
        'hobbies', 'my_current_obsession', 'achievement', 'favorite_place',
        'favorite_food', 'favorite_celebrity', 'favorite_music', 'favorite_sport',
        'favorite_word', 'hairstyle', 'language'
    ];


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function checkLogIn($username, $password)
    {
        if (\Auth::attempt(['username' => $username, 'password' => $password])) {
            $user = \Auth::user();
            $user['token'] = $user->createToken('eyeland')->accessToken;
            return [
                # 'status'    =>  CODE_SUCCESS,
                'message' => MSG_SUCCESS,
                'data' => $user,
            ];
        } else {

            #return $this->sendError(MSG_UNAUTHORIZED,CODE_UNAUTHORIZED);
        }

        #return $username;
        // TODO: Implement checkLogIn() method.
    }

    public function register($request)
    {

        try {
            $name = $request->input('name', "");
            $password = $request->input('password', "");
            $gender = (int)$request->input('gender', 0);
            $birthday = $request->input('birthday', "");
            $genderVisivility = (int)$request->input('gender_visivility', 1);
            $birthdayVisivility = (int)$request->input('birthday_visivility', 0);
            $imei = $request->input('imei', "");
            $email = $request->input('email', "");
            $is_business = (int)$request->input('is_business', 0);
            $input['email'] = $email;
            $input['password'] = bcrypt($password);
            $input['name'] = $name;
            $input['is_business'] = $is_business;
            $input['imei'] = $imei;
            $user = $this->create($input);

            if (!isset($user)) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }

            $accountId = NUMBER_ACCOUNT_ID + $user->id;
            $profileUpdate['username'] = $accountId;
            $this->update($profileUpdate, $user->id);

            //insert to table profile user
            $profileUser = new ProfileUser();
            $profileUser->profile_id = $user->id;
            $profileUser->gender = $gender;
            $profileUser->gender_visivility = $genderVisivility;
            $profileUser->birthday_visivility = $birthdayVisivility;
            if (!is_null($birthday)) {
                $profileUser->birthday = $birthday;
                $profileUser->birth_year = date('Y') - date('Y', strtotime(date($birthday)));
            }

            \Log::info($profileUser, ['ABout' => $user->id]);
            if (!$profileUser->save()) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }
            if (\Auth::attempt(
                [
                    'email' => $email,
                    'password' => $password,
                    'status' => BaseModel::STATUS_ENABLE,
                    'is_deleted' => STATUS_NONE_DELETED
                ]
            )
            ) {
                //update last login
                event(new UserLogin($user->id));
                $authUser = $this->getInfor();
                $authUser['token'] = $authUser->createToken('eyeland')->accessToken;
                $this->updateAccessToken($authUser);
            } else {
                $authUser = $user->toArray();
            }

            return [
                'success' => true,
                'data' => $authUser
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
            ];
        }

    }

    /**
     * @param $request
     * @return array
     */
    public function registerBusiness($request)
    {
        //create user_profile
        try {
            $input['email'] = $request->input('email', "");
            $input['password'] = bcrypt($request->input('password', ""));
            $input['name'] = $request->input('name', "");
            $input['is_business'] = $request->input('is_business', 1);
            $input['imei'] = $request->input('imei', "");
            $image = $request->input('avatar', "");

            $profileBussiness = $this->create($input);

            if (!isset($profileBussiness)) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }
            $accountId = NUMBER_ACCOUNT_ID + $profileBussiness->id;
            $profileUpdate['username'] = $accountId;
            //insert to table e_shop
            /*if ($image) {

                $file = 'avatar' . DIRECTORY_SEPARATOR . date("Y/m/d/H");
                $avatar_name = $profileBussiness->id . time() . '.jpg';
                $avatar_path = Systems::uploadBasse64($image, $file, $avatar_name);
                if ($avatar_path) {
                    $profileUpdate['avatar_path'] = $avatar_path;
                }
            }*/

            //update profile by id
            \Log::info($profileUpdate, ['ABout' => $profileBussiness->id]);
            $this->update($profileUpdate, $profileBussiness->id);

            //insert to table e_shop

            $profileShop = new ProfileBussines();
            $profileShop->profile_id = $profileBussiness->id;
            $profileShop->name = $request->input('name', "");
            $profileShop->avatar = isset($avatar_path) ? $avatar_path : "";
            $profileShop->hyperlink = $request->input('hyperlink', "");
            $profileShop->rel_hyperlink = $request->input('rel_hyperlink', "");
            $profileShop->bussines_type_id = $request->input('bussines_type_id', "");
            $profileShop->mobile = $request->input('mobile', "");
            \Log::info($profileShop, ['ABout' => $profileBussiness->id]);

            if (!$profileShop->save()) {
                return [
                    'success' => false,
                    'data' => "",
                ];
            }
            if (\Auth::attempt(
                [
                    'email' => $profileBussiness->email,
                    'password' => $request->input('password', ""),
                    'status' => BaseModel::STATUS_ENABLE,
                    'is_deleted' => STATUS_NONE_DELETED
                ])
            ) {
                $user = $this->getInfor();
                $user['token'] = $user->createToken('eyeland')->accessToken;
                $this->updateAccessToken($user);
            } else {
                $user = $profileBussiness->toArray();
            }

            return [
                'success' => true,
                'data' => $user
            ];

        } catch (\Exception $ex) {

            return [
                'success' => false,
                'data' => $ex->getMessage()
            ];
        }

    }

    public function changePassowrd($request)
    {
        try {
            $profile = $this->getInfor();
            $newPassword = $request->input('password', "");
            $input['password'] = bcrypt($newPassword);
            $profileUpdate = $this->update($input, $profile->id);
            if (!isset($profileUpdate)) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }
            $profile['token'] = $profile->createToken('eyeland')->accessToken;
            $this->updateAccessToken($profile);

            return [
                'success' => true,
                'data' => $profile
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage()
            ];
        }


    }

    public function getInfor()
    {
        // TODO: Implement getInfor() method.
        $user = \Auth::user();

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByUserId($id)
    {

        try {
            $user = User::find(intval($id));
            if (!isset($user)) {
                throw new \Exception("User not exist", 422);
            }
            return $this->showInforUser($user);
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),

            ];
        }

    }

    /**
     * @param $user
     * @return mixed
     */
    public function showInforUser($user)
    {
        //check xem là profile doanh nghiệp hay profile thường
        if ($user->is_business == PROFILE_BUSSINESS) {
            $profileBussiness = $user->getProfileBussiness()->first();
            $user->profile_infor = isset($profileBussiness) ? $profileBussiness : [];
        } elseif ($user->is_business == PROFILE_DEFAULT) {
            $profileDefault = $user->getProfileUsers()->first();

            $user->profile_infor = isset($profileDefault) ? $profileDefault : [];
        }


        return $user;
    }

    public function findWhereAge($field, $request, $userId = 0, $columns = ['*'])
    {
        $startAge = $request->get('start_age', 18);
        $endAge = $request->get('end_age', 70);
        $gender = $request->get('gender', "");
        $query = ' 1=1 ';
        if ($gender != "" && in_array($gender, [-1, 0, 1])) {

            $query = ' gender =? ';
        }
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model
            ->whereNotIn('id', [$userId])
            ->where($field, '>=', intval($startAge))
            ->where($field, '<=', intval($endAge))
            ->whereRaw($query, [intval($gender)])
            ->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Block profile
     * @param $request
     * @return array|bool
     */
    public function blockProfile($request)
    {
        $profile = \Auth::user();

        $profile_block = new ProfileBlock();
        $profile_block->profile_id = $profile->id;
        $profile_block->profile_id_block = $request->input('profile_id_block');
        if ($profile_block->save()) {
            return [
                'success' => true,
                'data' => $profile_block
            ];
        }

        return false;
    }

    /**
     * Un block profile
     * @param $request
     * @return bool
     */
    public function unBlockProfile($request)
    {
        $profile = \Auth::user();

        // delete profile block id
        if (ProfileBlock::where([
            'profile_id' => $profile->id,
            'profile_id_block' => $request->input('profile_id_block')
        ])->delete()
        ) {
            return [
                'success' => true,
                'data' => []
            ];
        }

        return false;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function favoriteProfile($request)
    {
        $profile = \Auth::user();

        $profile_favorite = new ProfileFavorite();
        $profile_favorite->profile_id = $profile->id;
        $profile_favorite->profile_id_favorite = $request->input('profile_id_favorite');
        if ($profile_favorite->save()) {
            return [
                'success' => true,
                'data' => $this->getByUserId($request->input('profile_id_favorite'))
            ];
        }

        return false;
    }

    /**
     * @param $request
     * @return array|bool
     * Search user da chat or comment (Tương tác)
     */
    public function searchFavoriteProfile($request)
    {
        $profile = \Auth::user();
        $profileAction = [];

        //Lay user mà profile đã gửi message
        $profileChat = Message::select('id')->where(['profile_sent' => $profile->id])
            ->where('profile_recive', '<>', $profile->id)->distinct()->get();
        if (count($profileChat) > 0) {
            foreach ($profileChat as $value) {
                $profileAction[] = $value['id'];
            }
        }

        /**
         * Lay user đã comment những post của mình
         */
        $profilePost = Post::select('id')->where(['profile_id' => $profile->id])->get();  //Get cac post cua user
        $postList = [];
        if (count($profilePost) > 0) {
            foreach ($profilePost as $value) {
                $postList[] = $value['id'];
            }
        }
        $profileComment = [];
        if (count($postList) > 0) {
            $profileComment = PostComment::select('profile_id')->distinct()->where('profile_id', '<>', $profile->id)
                ->whereIn('post_id', $postList)->get(); //Get cac profile da comment
        }

        if (count($profileComment) > 0) {
            foreach ($profileComment as $value) {
                if (!in_array($value['profile_id'], $profileAction)) {
                    $profileAction[] = $value['profile_id'];
                }
            }
        }

        $result = [];
        $total = 0;
        if (count($profileAction) > 0) {
            $query = User::whereIn('id', $profileAction);
            $total = count($query->get());
        }

        if (isset($request['limit'])) {
            $query = $query->limit($request['limit']);
        }

        if (isset($request['offset'])) {
            $query = $query->offset($request['offset']);
        }

        if ($total > 0) {
            $result = $query->get();
        }

        return [
            'success' => true,
            'data' => $result,
            'total' => $total,
        ];

    }

    /**
     * @param $request
     * @return array|bool
     */
    public function unFavoriteProfile($request)
    {
        $profile = \Auth::user();

        // delete profile block id
        if (ProfileFavorite::where([
            'profile_id' => $profile->id,
            'profile_id_favorite' => $request->input('profile_id_favorite')
        ])->delete()
        ) {
            return [
                'success' => true,
                'data' => [
                    'profile_id_favorite' => $request->input('profile_id_favorite')
                ]
            ];
        }

        return false;
    }

    /**
     *
     * @param $request
     * @return array|bool
     */
    public function favoritePost($request)
    {
        $profile = \Auth::user();

        $post_favorite = new PostFavorite();
        $post_favorite->profile_id = $profile->id;
        $post_favorite->post_id = $request->input('post_id');
        if ($post_favorite->save()) {
            return [
                'success' => true,
                'data' => $post_favorite
            ];
        }

        return false;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function unFavoritePost($request)
    {
        $profile = \Auth::user();
        $post_id = $request->input('post_id');
        // delete profile block id
        if (PostFavorite::where([
            'profile_id' => $profile->id,
            'post_id' => $post_id
        ])->delete()
        ) {
            return [
                'success' => true,
                'data' => [
                    'profile_id' => $profile->id,
                    'post_id' => $post_id,
                ]
            ];
        }

        return false;
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function reportProfile($request)
    {
        $profile = \Auth::user();

        $profile_report = new ProfileReport();
        $profile_report->profile_id = $profile->id;
        $profile_report->profile_id_report = $request->input('profile_id_report');
        if ($profile_report->save()) {
            return [
                'success' => true,
                'data' => $profile_report
            ];
        }

        return false;
    }

    /**
     * @param $type
     * @param string $id
     * @param int $point
     * @return array|string
     */
    public function transferPoint($type, $id = "", $point = 0)
    {

        try {
            $profile = User::find(intval($id));
            \Log::info(json_encode(['type' => $type, 'user_id' => $id, 'point' => $point]), ['id' => LOG_USER_TO_TRANFER]);
            if (!$profile) {
                throw new \Exception("The profile do not exist", 422);
            }
            if ($type == DEDUCTION_POINT) {
                if (intval($point) >= $profile->point) {
                    throw new \Exception("Point is not enough", 422);
                }
                $profile->point = $profile->point - intval($point);

            } elseif ($type == PLUS_POINT) {
                $profile->point = $profile->point + intval($point);
            }
            \Log::info(json_encode(['type' => $type, 'user_id' => $id, 'point' => $profile->point]), ['user_id' => $id]);
            if (!$profile->save()) {
                throw new \Exception("The profile do not exist", 422);
            }
            return [
                'success' => true,
                'data' => $profile->toArray()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => $e->getMessage()
            ];
        }
    }

    public function updateAccessToken($user)
    {
        //Get Oauth Access tokens moi nhat
        $oatTmp = OauthAccessTokens::where(['user_id' => $user->id])->orderBy('created_at', 'DESC')->first();
        if (isset($oatTmp)) {
            $oat = new OauthAccessTokens();
            $oat->id = $oatTmp->id;
            $oat->user_id = $oatTmp->user_id;
            $oat->client_id = $oatTmp->client_id;
            $oat->name = $oatTmp->name;
            $oat->scopes = $oatTmp->scopes;
            $oat->revoked = $oatTmp->revoked;
            $oat->created_at = $oatTmp->created_at;
            $oat->updated_at = $oatTmp->updated_at;
            $oat->token = $user->token;
            $oat->expires_at = $oatTmp->expires_at;

            //Delete other this user accesstoken
            DB::table('oauth_access_tokens')->where('user_id', '=', $user->id)->delete();

            $oat->save();
        }
    }

    public function updateOnline($request)
    {
        try {
            $profile = \Auth::user();
            $requestAll = $request->all();
            $data = $this->update($requestAll, $profile->id);
            if (!$data) {
                return [
                    'success' => false,
                    'data' => "312321"
                ];
            }
            return [
                'success' => true,
                'data' => $this->getByUserId($profile->id)
            ];
        } catch (\Exception $exception) {
            return [
                'success' => false,
                'data' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $request
     * @return array|bool
     */
    public function resetPassword($request)
    {
        $passwordReset = new PasswordReset();
        $passwordReset->email = $request->input('email');
        $passwordReset->token = Systems::generateTransaction($passwordReset->email);

        // save success
        if ($passwordReset->save()) {
            // send email reset password to user by queue
            $linkReset = env('APP_URL', '') . '/password/reset/' . $passwordReset->token;
            Mail::to($passwordReset->email)->queue(new \App\Mail\PasswordReset($linkReset));

            // return api
            return [
                'success' => true,
                'data' => []
            ];
        }

        return false;
    }

    public function updateLocation($request)
    {
        try {
            $profile = \Auth::user();
            $longitude = (double)$request->input('longitude', 0);
            $latitude = (double)$request->input('latitude', 0);
            $requestProfile = [];
            if ($longitude > 0 && $latitude > 0) {
                $location = BaseModel::getAddress($longitude, $latitude);
                $requestProfile['longitude'] = $longitude;
                $requestProfile['latitude'] = $latitude;
                if (!empty($location)) {
                    $requestProfile['location'] = $location;
                }
            }
            $data = $this->update($requestProfile, $profile->id);

            if (!$data) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }
            //cập nhật user nếu là tài khoản thường
            BaseModel::updateProfileElasticsearch($profile->id);
            //update last login
            event(new UserLogin($profile->id));
            return [
                'success' => true,
                'data' => $this->getByUserId($profile->id)
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
            ];
        }
    }

    public function buyItem($request)
    {
        try {
            $profile = \Auth::user();
            $item_id = $request->input('item_id', []);

            $itemIds = explode(',', $item_id);

            if (!is_array($itemIds)) {
                return [
                    'success' => false,
                    'data' => trans('Item list invalid'),
                    'code' => 500,
                ];
            }

            //Check item
            if (count($itemIds) < 1) {
                return [
                    'success' => false,
                    'data' => trans('Please choose items'),
                    'code' => 500,
                ];
            }

            //Check point
            $point = DB::table("e_item")->select('point')->whereIn('id', $itemIds)->sum('point');
            if (intval($profile->point) < intval($point)) {
                return [
                    'success' => false,
                    'data' => trans('Point is not enough'),
                    'code' => 500,
                ];
            }

            $result = [];
            $itemBuying = [];
            foreach ($itemIds as $key => $id) {
                $item = Item::find($id);
                if (!isset($item)) {
                    return [
                        'success' => false,
                        'data' => trans('item(' . $id . ').not.exist'),
                        'code' => 500,
                    ];
                }

                /*
                 * Check if profile has item.
                 *  => return message
                 * */
                $proItem = ProfileItemHistory::select('id')->where(['profile_id' => $profile->id, 'item_id' => $id])->first();
                if (isset($proItem)) {
                    return [
                        'success' => false,
                        'data' => 'Profile has item(' . $id . ')',
                        'code' => 500,
                    ];
                }

                $profileItemHis = new ProfileItemHistory();
                $profileItemHis->profile_id = $profile->id;
                $profileItemHis->item_id = $id;
                $profileItemHis->point = $item->point ? $item->point : 0;

                if ($profileItemHis->save()) {
                    //Charging point
                    $profile::billingPoint(User::DEDUCTION, $item->point);

                    $itm = [];
                    $itm['item_id'] = $item->id;
                    $itm['item_path'] = $item->avatar;
                    $itm['item_point'] = $item->point ? $item->point : 0;
                    $itemBuying[] = $itm;

                    //Luu de thong ke
                    $profileHis = new ProfileHistory();
                    $profileHis->profile_id = $profile->id;
                    $profileHis->item_id = $id;
                    $profileHis->point = $item->point ? $item->point : 0;
                    $profileHis->type = BUY_ITEM;
                    $profileHis->save();

                } else {
                    return [
                        'success' => false,
                        'data' => trans('buy.item.is.error'),
                        'code' => 500,
                    ];
                }
            }

            $result['profile'] = $profile->toArray();
            $result['items_buying'] = $itemBuying;

            //Set costume if buying success
            $profileCostume = ProfileCostume::where('profile_id', $profile->id)->first();
            if (!isset($profileCostume)) {
                $profileCostume = new ProfileCostume();
            }

            $profileCostume->profile_id = $profile->id;
            $profileCostume->item_ids = isset($profileCostume->item_ids) ? $profileCostume->item_ids . ',' . $item_id : $item_id;

            $profileCostume->updated_at = date('Y-m-d H:i:s');
            $profileCostume->save();
            $result = $profileCostume->toArray();

            return [
                'success' => true,
                'data' => $result,
            ];


        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
                'code' => 500,
            ];
        }
    }

    /*
     * Get list items which user has buy
     */
    public function itemListByUser($request)
    {
        try {
            $profile = \Auth::user();
            $category_id = $request->input('category_id');
            if (isset($category_id)) {
                $itemIdInCate = Item::select('id')->where(['category_id' => $category_id])->get();
            }

            $queryItemHist = ProfileItemHistory::where(['profile_id' => $profile->id]);
            if (isset($itemIdInCate)) {
                $queryItemHist = $queryItemHist->whereIn('item_id', $itemIdInCate);
            }

            $itemHis = $queryItemHist->get();
            $arrItemsId = [];
            if (count($itemHis) > 0) {
                foreach ($itemHis as $item) {
                    $arrItemsId[] = $item->item_id;
                }
            }

            $query = Item::whereIn('id', $arrItemsId);
            $total = count($query->get());

            $limit = $request['limit'];
            $offset = $request['offset'];
            if (isset($limit)) {
                $query = $query->limit($limit);
            }

            if (isset($offset)) {
                $query = $query->offset($offset);
            }

            return [
                'success' => true,
                'data' => $query->get(),
                'total' => $total,
            ];

        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
                'code' => 500,
            ];
        }
    }

    /*
     * Get list favorite post of user
     */
    public function listFavoritePost($request)
    {
        try {
            $profile = \Auth::user();
            $query = PostFavorite::where('profile_id', $profile->id);
            $total = count($query->get());
            $limit = $request['limit'];
            $offset = $request['offset'];
            if (isset($limit)) {
                $query = $query->limit($limit);
            }

            if (isset($offset)) {
                $query = $query->offset($offset);
            }

            return [
                'success' => true,
                'data' => $query->get(),
                'total' => $total,
            ];

        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
                'code' => 500,
            ];
        }
    }

    public function donatePoint($request)
    {
        try {
            $point = $request->input('point', 0);
            $profile = \Auth::user();

            if (intval($point) >= $profile->point) {
                return [
                    'success' => false,
                    'data' => 'Point is not enough',
                    'code' => 422,
                ];
            }

            //Trừ tiền người tặng
            $this->transferPoint(DEDUCTION_POINT, $profile->id, $point);
            //thêm vào bảng profile_history
            $this->createProfileHistory($profile->id, $point, GIVE_POINT);
            $receiver_id = $request->input('receiver_id', 0);
            $receiver = User::find($receiver_id);
            if (!isset($receiver)) {
                return [
                    'success' => false,
                    'data' => 'User not exist',
                    'code' => 422,
                ];
            }
            //Cộng tiền người được nhận
            $this->transferPoint(PLUS_POINT, $receiver_id, $point);
            $this->createProfileHistory($receiver_id, $point, PLUS_POINT_WHEN_GIVE);
            $data = $profile->toArray() + ['donate_point' => $point, 'receiver' => ['id' => $receiver->id, 'name' => $receiver->name, 'email' => $receiver->email]];

            return [
                'success' => true,
                'data' => $data,
                'code' => 200,
            ];

        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
                'code' => 500,
            ];
        }
    }

    /*
     * Get list items which user has buy
     */
    public function categoryListByUser($request)
    {
        try {
            $profile = \Auth::user();
            $itemHis = ProfileItemHistory::where(['profile_id' => $profile->id])->get();
            $arrItemsId = [];
            $categories = [];
            if (count($itemHis) > 0) {
                foreach ($itemHis as $item) {
                    $arrItemsId[] = $item->item_id;
                }
            }

            $categories = Item::select('category_id')->whereIn('id', $arrItemsId)->groupBy('category_id')->get();

            $query = CategoryItem::whereIn('id', $categories)->orderBy('sort_order', 'ASC');
            $total = count($query->get());

            $limit = $request['limit'];
            $offset = $request['offset'];
            if (isset($limit)) {
                $query = $query->limit($limit);
            }

            if (isset($offset)) {
                $query = $query->offset($offset);
            }

            $cate = $query->get();
            $_result = [];
            if (count($cate) > 0) {
                foreach ($cate as $value) {
                    $tmp = $value;
                    $itemInCate = Item::where(['category_id' => $value['id']])->whereIn('id', $arrItemsId)->get();
                    $tmp['items'] = $itemInCate->toArray();
                    $_result[] = $tmp;
                }
            }

            return [
                'success' => true,
                'data' => $_result,
                'total' => $total,
            ];

        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
                'code' => 500,
            ];
        }
    }

    public function deleteProfile()
    {
        $user = $this->getInfor();
        $userUpdate = $this->update([
            'status' => STATUS_NONE_DELETED,
            'is_deleted' => DELETE_PROFILE
        ], $user->id);
        if ($userUpdate->is_deleted) {
            return [
                'success' => true,
                'message' => '削除成功',
            ];
        } else {
            return [
                'success' => false,
                'message' => '削除に失敗しました',
            ];
        }

    }

    public function createProfileHistory($userId, $point, $type)
    {
        try {
            ProfileHistory::create([
                'profile_id' => $userId,
                'point' => $point,
                'type' => $type
            ]);
        } catch (\Exception $ex) {
            throw new NotFoundHttpException($ex->getMessage());
        }
    }

    public function changeEmail($request)
    {
        $return = ['success' => false, 'message' => 'error'];
        try {
            $email = $request->input('email', "");
            $userUpdate = $this->getInfor();
            $this->update([
                'email' => $email
            ], $userUpdate->id);
            if (\Auth::check()) {
                $user = $this->getInfor();
                $user['email'] = $email;
                $user['token'] = $user->createToken('eyeland')->accessToken;
                $this->updateAccessToken($user);
                $return['success'] = true;
                $return['message'] = $user;
            }
        } catch (\Exception $ex) {
            $return['message'] = $ex->getMessage();
        }
        return $return;
    }

}
