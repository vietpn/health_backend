<?php

namespace App\Models;

use Eloquent as Model;

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
class ProfileUser extends Model
{

    public $table = 'e_profile_user';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'country',
        'height',
        'weight',
        'gender',
        'gender_visivility',
        'birthday',
        'birth_year',
        'birthday_visivility',
        'blood_type',
        'zodiac_sign',
        'same_person',
        'description',
        'hometown',
        'personnality',
        'special_skills',
        'hobbies',
        'my_current_obsession',
        'achievement',
        'favorite_place',
        'favorite_food',
        'favorite_celebrity',
        'favorite_music',
        'favorite_sport',
        'favorite_word',
        'hairstyle',
        'language',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'id' => 'integer',
//        'profile_id' => 'integer',
//        'country' => 'string',
//        'height' => 'integer',
//        'weight' => 'integer',
//        'gender' => 'integer',
//        'gender_visivility' => 'integer',
//        'birthday' => 'date',
//        'birthday_visivility' => 'integer',
//        'blood_type' => 'integer',
//        'zodiac_sign' => 'integer',
//        'same_person' => '',
//        'description' => 'string',
//        'hometown' => 'string',
//        'personnality' => 'string',
//        'special_skills' => 'string',
//        'hobbies' => 'string',
//        'my_current_obsession' => 'string',
//        'achievement' => 'string',
//        'favorite_place' => 'string',
//        'favorite_food' => 'string',
//        'favorite_celebrity' => 'string',
//        'favorite_music' => 'string',
//        'favorite_sport' => 'string',
//        'favorite_word' => 'string',
//        'hairstyle' => 'string',
//        'language' => 'string'
//    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'profile_id', 'created_at', 'updated_at'
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
    }
    public static $mapAttribute =[
        'profile_id',
        'country',
        'height',
        'weight',
        'gender',
        'gender_visivility',
        'birthday',
        'birth_year',
        'birthday_visivility',
        'blood_type',
        'zodiac_sign',
        'same_person',
        'description',
        'hometown',
        'personnality',
        'special_skills',
        'hobbies',
        'my_current_obsession',
        'achievement',
        'favorite_place',
        'favorite_food',
        'favorite_celebrity',
        'favorite_music',
        'favorite_sport',
        'favorite_word',
        'hairstyle',
        'language',
        'created_at',
        'updated_at'
    ];
    public function getBloodType(){
        return $this->hasOne(BloodType::class,'id','blood_type');
    }
    public function getZodiacSign(){
        return $this->hasOne(ZodiacSigns::class,'id','zodiac_sign');
    }
    public function getDescriptionAttribute($value)
    {
        return ucfirst($value);
    }
    public function getCountryAttribute($value)
    {
        return ucfirst($value);
    }
    public function getHometownAttribute($value)
    {
        return ucfirst($value);
    }
    public function getPersonnalityAttribute($value)
    {
        return ucfirst($value);
    }
    public function getSpecialSkillsAttribute($value)
    {
        return ucfirst($value);
    }
    public function getHobbiesAttribute($value)
    {
        return ucfirst($value);
    }
    public function getMyCurrentObsessionAttribute($value)
    {
        return ucfirst($value);
    }
    public function getAchievementAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoritePlaceAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoriteFoodAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoriteCelebrityAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoriteMusicAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoriteSportAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFavoriteWordAttribute($value)
    {
        return ucfirst($value);
    }
    public function getHairstyleAttribute($value)
    {
        return ucfirst($value);
    }
    public function getLanguageAttribute($value)
    {
        return ucfirst($value);
    }
    public function getSamePersonAttribute($value)
    {
        return ucfirst($value);
    }
    public function getHeightAttribute($value)
    {
        return floatval($value);
    }
    public function getWeightAttribute($value)
    {
        return floatval($value);
    }
    public function getGenderVisivilityAttribute($value)
    {
        return intval($value);
    }
    public function getGenderAttribute($value)
    {
        return intval($value);
    }
    public function getBirthYearAttribute($value)
    {
        return intval($value);
    }
    public function getBirthdayVisivilityAttribute($value)
    {
        return intval($value);
    }
    public function getBloodTypeAttribute($value)
    {
        return intval($value);
    }
    public function getZodiacSignAttribute($value)
    {
        return intval($value);
    }
}
