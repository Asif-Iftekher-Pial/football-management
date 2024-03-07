<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FootballGroupStaff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['football_group_staff','partner','player','registered_football_club','manager','other_football_job'];
        //drop Role table first
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // \App\Models\User::factory(10)->create();

        $user =User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'photo' =>'admin.png'
        ]);

        FootballGroupStaff::create([
            'user_id'=>$user->id,
            'name' => 'Super Admin',
            'address' => 'Test Address',
            'country' => 'London',
            'telephone' => '011111111',
            'contact' => '111111',
            'website' =>'www.google.com',
            'status' => 'approved',
            'payment_status' => 'paid'

        ]);
        //assing role to user
        $user->syncRoles($roles);
    }
}
