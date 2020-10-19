<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * @var Collection
     */
    protected $roles;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles = Role::all();

        $this->createAdmin();
        $this->generate(10, RoleEnum::GUEST);
    }

    /**
     * Create an admin
     *
     * @return void
     */
    protected function createAdmin () {
        $admin = User::factory()->create([
            'email' => 'admin@gmail.com',
            'name'  => 'Administrator'
        ]);

        $admin->attachRole($this->roles->where('name', RoleEnum::ADMIN)->first());
    }

    /**
     * Generate users (role: guest)
     *
     * @param int $number
     * @param string $role
     *
     * @return void
     */
    protected function generate(int $number, string $role) {
        $users = User::factory($number)->create();
        $role  = $this->roles->where('name', )->first();

        $users->each(function ($user) use ($role) {
            $user->attachRole($role);
        });
    }
}
