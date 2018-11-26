<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 5/11/18
 * Time: 20:59
 */

namespace Tests\Feature\Traits;

use App\User;
use Spatie\Permission\Models\Permission;

trait CanLogin
{
    protected function login($guard = null)
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,$guard);
        return $user;
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsTaskManager($guard = null)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole('TaskManager');
        $this->actingAs($user,$guard);
        return $user;
    }
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginWithPermission($guard = null,$permission)
    {
        $user = factory(User::class)->create();
        Permission::create([
            'name' => $permission
        ]);
        $user->givePermissionTo($permission);
        $this->actingAs($user,$guard);
        return $user;
    }
    protected function loginAsSuperAdmin($guard = null)
    {
        $user = factory(User::class)->create();
        $user->admin = true;
        $user->save();
        $this->actingAs($user,$guard);
        return $user;
    }
}