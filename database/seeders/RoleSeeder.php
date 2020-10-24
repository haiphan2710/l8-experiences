<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $roles = [
        [
            'name'         => RoleEnum::OWNER,
            'display_name' => 'Owner Of System', // optional
            'description'  => 'Full power in the system', // optional
        ],
        [
            'name'         => RoleEnum::ADMIN,
            'display_name' => 'User Administrator', // optional
            'description'  => 'Manage all content', // optional
        ],
        [
            'name'         => RoleEnum::EDITOR,
            'display_name' => 'User Editor', // optional
            'description'  => 'User is allowed to manage contents', // optional
        ],
        [
            'name'         => RoleEnum::GUEST,
            'display_name' => 'Guest', // optional
            'description'  => 'Guest', // optional
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->roles)->each(function ($role) {
            Role::create($role);
        });
    }
}
