<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 7/18/2017
 * Time: 1:58 PM
 */

namespace App\Repositories\Api;
use App\Models\ProfileUser;
use InfyOm\Generator\Common\BaseRepository;

class ProfileUserRepository extends BaseRepository
{
    /**
     * @var array
     */
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
     * Configure the Model
     **/
    public function model()
    {
        return ProfileUser::class;
    }
}