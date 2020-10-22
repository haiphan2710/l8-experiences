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
        $this->createOwner();
        $this->createAdmin();
        $this->generate(10, RoleEnum::GUEST);
    }

    /**
     * Create an owner
     *
     * @return void
     */
    protected function createOwner () {
        $admin = User::factory()->create([
            'email' => 'owner@gmail.com',
            'name'  => 'Owner'
        ]);

        $admin->attachRole(RoleEnum::OWNER);
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

        $admin->attachRole(RoleEnum::ADMIN);
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

        $users->each(function ($user) use ($role) {
            $user->attachRole($role);
        });
    }
}
