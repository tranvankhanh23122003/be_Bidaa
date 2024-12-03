<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'userName'  => "admin",
                'fullName'  => "adddsd",
                'phoneNumber'   => "1234567890",
                'role'  => "1",
                'avatar'    => "gh",
                'status'=> 1,
                'point' => 1,
                'password' => bcrypt("123456"),
            ]
        ]);
    }
}
