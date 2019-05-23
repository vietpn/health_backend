<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Backend{
/**
 * Class ProfilePlusHistory
 *
 * @package App\Models\Backend
 * @version August 24, 2017, 9:59 am ICT
 * @property int $id
 * @property int $profile_id
 * @property int $point
 * @property bool $type 1:nạp từ iap_android;2:nap tự iap_ios;3:cộng từ chat
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereUpdatedAt($value)
 */
	class ProfilePlusHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BloodType
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodType whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BloodType whereName($value)
 */
	class BloodType extends \Eloquent {}
}

namespace App\Models{
/**
 * Class BussinesType
 *
 * @package App\Models\Backend
 * @version July 11, 2017, 2:46 am UTC
 * @property int $id
 * @property string $title
 * @property bool $status
 * @property string|null $created_at
 * @property int $created_id
 * @property string|null $updated_at
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereUpdatedId($value)
 * @mixin \Eloquent
 */
	class BussinesType extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CategoryItem
 *
 * @package App\Models\Backend
 * @version July 4, 2017, 3:05 am UTC
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $avatar Avatar of category
 * @property bool $status 1:Enable ; 0:Disable
 * @property int $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereUpdatedId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereType($value)
 */
	class CategoryItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $permissions
 * @property string|null $last_login
 * @property string|null $first_name
 * @property string|null $last_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CmsUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CmsUser whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CmsUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CmsUser wherePermissions($value)
 */
	class CmsUser extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Config
 *
 * @package App\Models
 * @version June 26, 2017, 4:02 am UTC
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $describe
 * @property bool $status 1: Enable ; 0:Disable
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereDescribe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereValue($value)
 * @mixin \Eloquent
 */
	class Config extends \Eloquent {}
}

namespace App\Models{
/**
 * Class IapAndroid
 *
 * @package App\Models
 * @version June 28, 2017, 4:03 am UTC
 * @property int $id
 * @property string $product_id
 * @property string $avatar
 * @property string $display_name
 * @property string $package
 * @property string $description
 * @property float $price Giá tiền tính theo usd
 * @property int $point
 * @property bool $status 1: Enable ; 0:Disable
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereUpdatedId($value)
 * @mixin \Eloquent
 */
	class IapAndroid extends \Eloquent {}
}

namespace App\Models{
/**
 * Class IapAndroidCharging
 *
 * @package App\Models\Backend
 * @version June 30, 2017, 7:43 am UTC
 * @property int $id
 * @property int $profile_id
 * @property bool $type 1: kiểu managed product, 2: kiểu subscription
 * @property int $amount Tiền vnd của goi
 * @property int $point Tiền icash của gói
 * @property string $product_id
 * @property string $package
 * @property string $purchase_token
 * @property bool $charge_status Trạng thái: 0 thất bại, 1 thành công
 * @property string $response response từ server google
 * @property string|null $response_at
 * @property string $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\CmsUser $Profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereChargeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePurchaseToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereResponseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IapAndroidCharging extends \Eloquent {}
}

namespace App\Models{
/**
 * Class IapIos
 *
 * @package App\Models
 * @version June 28, 2017, 4:13 am UTC
 * @property int $id
 * @property string $apple_id
 * @property string $product_id
 * @property string $avatar
 * @property string $display_name
 * @property string $description
 * @property float $price Giá tiền tính theo usd
 * @property int $point
 * @property bool $status 1: Enable ; 0:Disable
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereAppleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereUpdatedId($value)
 * @mixin \Eloquent
 */
	class IapIos extends \Eloquent {}
}

namespace App\Models{
/**
 * Class IapIosCharging
 *
 * @package App\Models\Backend
 * @version July 2, 2017, 2:39 pm UTC
 * @property int $id
 * @property int $profile_id
 * @property int $amount Tiền vnd của goi
 * @property int $point Tiền icash của gói
 * @property string $product_id
 * @property string $apple_id
 * @property string $purchase_token
 * @property bool $charge_status Trạng thái: 0 thất bại, 1 thành công
 * @property string $response response từ server google
 * @property string|null $response_at
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereAppleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereChargeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging wherePurchaseToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereResponseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IapIosCharging extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Item
 *
 * @package App\Models\Backend
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property string $name
 * @property string $avatar type PNG
 * @property int $point
 * @property string $description
 * @property bool $status 1: Enable ; 0:Disable
 * @property int $position
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item wherePosition($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property string|null $messages
 * @property int|null $profile_id
 * @property int|null $profile_sent
 * @property int|null $profile_recive
 * @property int|null $is_read
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $time_sent
 * @property-read \App\User|null $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMessages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileRecive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereReplyProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @property int|null $is_image 1: là ảnh 0: là text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsImage($value)
 * @property int|null $is_read_all 1: đã đọc tất cả ,0: chưa đọc hết
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsReadAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTimeSent($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * Class NgWord
 *
 * @package App\Models\Backend
 * @version July 18, 2017, 9:18 am ICT
 * @property int $id
 * @property string $word
 * @property string $pronounce
 * @property string $description
 * @property bool $status
 * @property int $created_id
 * @property string|null $created_at
 * @property int $updated_id
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord wherePronounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereUpdatedId($value)
 * @mixin \Eloquent
 */
	class NgWord extends \Eloquent {}
}

namespace App\Models{
/**
 * Class NmCategoryItem
 *
 * @package App\Models
 * @version July 5, 2017, 7:52 am UTC
 * @property int $id
 * @property int $category_item_id
 * @property int $item_id
 * @property string|null $created_at
 * @property int $created_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCategoryItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereItemId($value)
 * @mixin \Eloquent
 */
	class NmCategoryItem extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OauthAccessTokens
 *
 * @package App\Models
 * @version July 3, 2017, 7:14 am UTC
 * @property string $id
 * @property int $user_id
 * @property int $client_id
 * @property string $name
 * @property string $scopes
 * @property bool $revoked
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $expires_at
 * @property string $token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereUserId($value)
 * @mixin \Eloquent
 */
	class OauthAccessTokens extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Page
 *
 * @package App\Models
 * @version June 29, 2017, 4:52 am UTC
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $content_en
 * @property int $created_id
 * @property int $updated_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedId($value)
 * @mixin \Eloquent
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PasswordReset
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property int|null $status Trạng thái: 0 chưa dùng, 1 đã dùng
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereToken($value)
 * @mixin \Eloquent
 */
	class PasswordReset extends \Eloquent {}
}

namespace App\Models\Permission{
/**
 * App\Models\Permission\Role
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission\RoleUser[] $User
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Permission{
/**
 * App\Models\Permission\RoleUser
 *
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission\RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
	class RoleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Pin
 *
 * @package App\Models
 * @version July 19, 2017, 10:07 am ICT
 * @property int $id
 * @property string $name
 * @property string $avatar
 * @property int $point
 * @property bool $status
 * @property string|null $created_at
 * @property int $created_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereStatus($value)
 * @mixin \Eloquent
 */
	class Pin extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PointConfig
 *
 * @package App\Models\Backend
 * @version August 23, 2017, 10:16 am ICT
 * @property int $id
 * @property string $key
 * @property int $point
 * @property string $describe
 * @property bool $status 1: Enable ; 0:Disable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereStatus($value)
 * @mixin \Eloquent
 */
	class PointConfig extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Post
 *
 * @package App\Models
 * @version July 6, 2017, 6:53 am UTC
 * @property int $id
 * @property int $profile_id
 * @property string $content
 * @property string $photo Ảnh cover
 * @property int $pin_id
 * @property float $longitude
 * @property float $latitude
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $postComments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLike[] $postLikes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostView[] $postViews
 * @property-read \App\User $profile
 * @property string|null $location_string
 * @property-read \App\Models\Pin|null $pin
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLocationString($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostFavorite[] $postFavorites
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PostComment
 *
 * @package App\Models\V2
 * @version July 11, 2017, 6:15 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $number_like
 * @property int $is_like
 * @property int $post_id Id của bài post
 * @property string $photo Ảnh của comment
 * @property string $content Nội dung comment
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCommentLike[] $postCommentLikes
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PostComment extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PostCommentLike
 *
 * @package App\Models\V2
 * @version July 11, 2017, 7:28 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_comment_id Id của comment trong post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\PostComment $postComment
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike wherePostCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PostCommentLike extends \Eloquent {}
}

namespace App\Models{
/**
 * Class e_post_favorite
 *
 * @package App\Models
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $Post_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileFavorite
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereId($value)
 * @mixin \Eloquent
 * @property int $post_id
 * @property-read mixed $content
 * @property-read \App\Models\Post $postFavorite
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostFavorite wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostFavorite whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostFavorite whereUpdatedAt($value)
 */
	class PostFavorite extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PostLike
 *
 * @package App\Models
 * @version July 7, 2017, 9:39 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_id Id của post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $ePost
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PostLike extends \Eloquent {}
}

namespace App\Models{
/**
 * Class PostView
 *
 * @package App\Models\V2
 * @version July 11, 2017, 3:58 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_id Id của bài post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $ePost
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PostView extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileBlock
 *
 * @package App\Models
 * @version July 3, 2017, 8:54 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_block
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileBlock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereProfileIdBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProfileBlock extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Shop
 *
 * @package App\Models\Backend
 * @version July 11, 2017, 3:01 am UTC
 * @property int $id
 * @property int $profile_id
 * @property string $name
 * @property string $avatar
 * @property string $hyperlink Link url of shop
 * @property int $bussines_type_id Bussines type
 * @property string $mobile
 * @property string|null $created_at
 * @property int $updated_id
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereBussinesTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereHyperlink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereUpdatedId($value)
 * @mixin \Eloquent
 * @property-read \App\User $eProfile
 */
	class ProfileBussines extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileFavorite
 *
 * @package App\Models
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_favorite
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileFavorite
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereProfileIdFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProfileFavorite extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileHistory
 *
 * @package App\Models\Backend
 * @version July 1, 2017, 7:37 pm UTC
 * @property int $id
 * @property int $profile_id
 * @property int $item_id
 * @property string $type_name
 * @property int $point
 * @property bool $type kiểu sử dụng point ví dụ như: mua item, search
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProfileHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileItemHistory
 *
 * @package App\Models\Backend
 * @version August 4, 2017, 10:53 am ICT
 * @property int $id
 * @property int $profile_id
 * @property int $item_id
 * @property float $point
 * @property string|null $created_at
 * @property-read \App\Models\Item $eItem
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereProfileId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Item $item
 * @property-read \App\User $profile
 */
	class ProfileItemHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileReport
 *
 * @package App\Models\V2
 * @version July 17, 2017, 3:16 pm ICT
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_report
 * @property bool $status Trạng thai xử lý: 0 chưa xử lý, 1 đã xử lý
 * @property string $des Miêu tả thêm
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileReport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereProfileIdReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ProfileReport extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ProfileUser
 *
 * @package App\Models
 * @version July 17, 2017, 3:34 pm ICT
 * @property int $id
 * @property int $profile_id
 * @property string $country Quê quán
 * @property int $height Chiều cao
 * @property bool $weight Cân nặng (kg)
 * @property bool $gender 0: nữ, 1: nam, -1 chưa xác định\
 * @property bool $gender_visivility 1: Show All, 0: Don't Show
 * @property \Carbon\Carbon $birthday ngày tháng năm sinh
 * @property int|null $birth_year năm sinh
 * @property bool $birthday_visivility 0: Don't Show,1: Show All,2:Only show month and day
 * @property int $blood_type Nhóm máu lấy từ bảng eblood_type
 * @property int $zodiac_sign Cung hoàng đạo lấy từ bảng e_zodiac_signs
 * @property string $same_person Người giống nhau
 * @property string $description Mô tả
 * @property string $hometown Quê quán
 * @property string $personnality tính cách
 * @property string $special_skills Kỹ năng đặc biệt
 * @property string $hobbies Sở thích
 * @property string $my_current_obsession Điều không thích hiện tại
 * @property string $achievement Thành tích trong app là things i'm proud of
 * @property string $favorite_place Địa điểm ưu thích
 * @property string $favorite_food Món ăn ưu thích
 * @property string $favorite_celebrity Người nổi tiếng ưu thích
 * @property string $favorite_music Âm nhạc ưu thích
 * @property string $favorite_sport Môn thể thao ưu thích
 * @property string $favorite_word Từ ưu thích
 * @property string $hairstyle Kiểu tóc
 * @property string $language Ngôn ngữ
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereBirthdayVisivility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereBloodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoriteCelebrity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoriteFood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoriteMusic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoritePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoriteSport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereFavoriteWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereGenderVisivility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereHairstyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereHobbies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereHometown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereMyCurrentObsession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser wherePersonnality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereSamePerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereSpecialSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileUser whereZodiacSign($value)
 * @mixin \Eloquent
 */
	class ProfileUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ZodiacSigns
 *
 * @property int $id
 * @property string $name Tên cung hoàng đạo
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZodiacSigns whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZodiacSigns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZodiacSigns whereName($value)
 */
	class ZodiacSigns extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string|null $username
 * @property string $name
 * @property string|null $email
 * @property string|null $location Địa chỉ
 * @property string|null $country Quê quán
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $point Số điểm của profile
 * @property mixed $avatar_path Ảnh đại diện
 * @property string|null $cover_path Ảnh cover
 * @property float|null $longitude
 * @property string|null $img ảnh bên ngoài
 * @property float|null $latitude
 * @property int|null $is_business 1: profile doanh nghiệp 0: là profile thường
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $last_updated Cập nhập mới nhất
 * @property string|null $last_login
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileHistory[] $ProfileHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-write mixed $birthday
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereZodiacSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogin($value)
 * @mixin \Eloquent
 * @property string|null $same_person Người giống nhau
 * =======
 * @property string|null $ same_person Người giống nhau
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSamePerson($value)
 * @property int|null $online_status Trạng thái online, 0: đang offline, 1: đang online
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOnlineStatus($value)
 * @property int|null $status 1: user con hoạt động , 0 : đã ngừng hoạt động
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 */
	class User extends \Eloquent {}
}

