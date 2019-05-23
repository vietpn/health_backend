<?php

namespace App\Repositories\Api;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProfileRepositoryRepository
 * @package namespace App\Repositories\Api;
 */
interface ProfileRepository extends RepositoryInterface
{
    public function checkLogIn($username, $password);

    public function getInfor();

    public function getByUserId($id);

}
