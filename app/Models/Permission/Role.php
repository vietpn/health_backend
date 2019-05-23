<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

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
class Role extends Model
{
    public function User(){
       return $this->hasMany(RoleUser::class,'role_id','id');
    }
}
