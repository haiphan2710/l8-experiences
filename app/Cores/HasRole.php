<?php

namespace App\Cores;

use App\Models\Role;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRole
{
    /**
     * The roles that belong to the user.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * Assign a role to a user.
     *
     * @param  string  $role
     * @return mixed
     */
    public function attachRole(string $role)
    {
        if ($this->hasRole($role) || is_null($role)) {
            return $this;
        }

        $role = Role::where('name', $role)->firstOrFail();

        $this->roles()->attach($role->id);

        return $this;
    }

    /**
     * Check if this user is an administrator.
     *
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->hasRole(RoleEnum::ADMIN);
    }

    /**
     * Check if this user has the given role(s).
     *
     * @param array|string $roles
     *
     * @return bool
     */
    public function hasRole($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        return !! $this->roles->pluck('name')->intersect($roles)->count();
    }
}
