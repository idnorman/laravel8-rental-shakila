<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Customer Name";
        $user->email = "norman.primary@gmail.com";
        $user->phone = "0822";
        $user->address = "gang Jihad";
        $user->mou = "path to mou";
        $user->level = "admin";
        $user->password = Hash::make('12345678'); 
        $user->save();

        $user2 = new User;
        $user2->name = "Admin Name";
        $user2->email = "norman.secondary@gmail.com";
        $user2->phone = "0822";
        $user2->address = "gang Jihad";
        $user2->mou = "path to mou";
        $user2->level = "customer";
        $user2->password = Hash::make('12345678'); 
        $user2->save();
    }
}
