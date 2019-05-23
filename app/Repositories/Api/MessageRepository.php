<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 8/29/2017
 * Time: 2:23 PM
 */

namespace App\Repositories\Api;


interface MessageRepository
{
    public function sendMessage($request);

}