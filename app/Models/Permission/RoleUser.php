<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

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
class RoleUser extends Model
{
    protected $table = "role_users";
    protected $primaryKey = 'user_id';
}
