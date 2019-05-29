<?php

namespace App\Validators;

use App\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Validation\Validator;
use DB;

class CustomValidator extends Validator
{

    public function validateDateLongTime($attribute, $value, $parameters)
    {
        $curentDate = date('Y-m-d');
        $year = date('Y') - date('Y', strtotime(date($value)));

        if (strtotime(date($value)) >= strtotime($curentDate) || $year == 0)
            return false;
        else
            return true;
    }

    public function validateFloat($attribute, $value, $parameters)
    {
        if (is_float((float)$value) == false) {
            return false;
        } else {
            return true;
        }
    }

    public function validateUniqueWith($attribute, $value, $parameters)
    {
        $count = DB::table($parameters[0])->where($attribute, $value)
            ->where($parameters[1], $parameters[2])
            ->count();

        if (empty($count)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateRangeNumber($attribute, $value, $parameters)
    {
        $paramsAttribute = ['online_status', 'gender_visivility'];
        if (in_array($attribute, $paramsAttribute)) {
            if (in_array($value, [0, 1])) {
                return true;
            } else {
                return false;
            }
        }
        if ($attribute == 'gender') {
            if (in_array($value, [-1, 0, 1])) {
                return true;
            } else {
                return false;
            }
        }
        if ($attribute == 'birthday_visivility') {
            if (in_array($value, [0, 1, 2])) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * validation kinh độ (-180,180)
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateLongtitue($attribute, $value, $parameters)
    {

        if ($value >= -180 && $value <= 180) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * validation vĩ độ (-90,90)
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateLatitue($attribute, $value, $parameters)
    {
        if ($value >= -90 && $value <= 90) {
            return true;
        } else {
            return false;
        }
    }
    public function validateOldPassword($attribute, $value, $parameters){
        if(\Hash::check($value, current($parameters))){
            return true;
        }else{
            return false;
        }
    }

    public function validateUniqueName($attribute, $value, $parameters){
        $countUser = User::where('username',trim($value))->count();
        if($countUser > 0){
            return false;
        }else{
            $countUserDelete = User::where('username',trim($value))->count();
            if($countUserDelete > 0){
                return false;
            }else{
                return true;
            }
        }
    }
    public function validateUniqueEmail($attribute, $value, $parameters){
        $countUser = User::where('email',trim($value))->count();

        if($countUser > 0){
            return false;
        }else{
            $countUserDelete = User::where('email',trim($value))->count();
            if($countUserDelete > 0){
                return false;
            }else{
                return true;
            }
        }

    }
    public function validateUniqueImei($attribute, $value, $parameters){
        $countUser = User::where('imei',trim($value))
            ->where('is_deleted',STATUS_NONE_DELETED)->count();
        if($countUser > 0){
            return false;
        }else{
            $countUserDelete = User::where('imei',trim($value))
                ->where('status',ENABLE)->count();
            if($countUserDelete > 0){
                return false;
            }else{
                return true;
            }
        }
    }
}
