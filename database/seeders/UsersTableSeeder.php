<?php
namespace Database\Seeders;

use App\Models\alimentaire;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name' => 'admin',
            'email' => 'admin.admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        $user->attachRole(1); 
       
           
    }
}
