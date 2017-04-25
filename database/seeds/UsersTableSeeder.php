<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name"          => "Marco Ramirez",
                "email"         => "marco@example.com",
                "username"      => "marco",
                "password"      => bcrypt('marco123'),
                "artist"        => 1,
                "verified"      => true,
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Alex Gonzalez",
                "email"         => "alex@example.com",
                "username"      => "alex",
                "password"      => bcrypt('alex123'),
                "artist"        => 1,
                "verified"      => true,
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Juan Lopez",
                "email"         => "juan@example.com",
                "username"      => "juan",
                "password"      => bcrypt('juan123'),
                "artist"        => 1,
                "verified"      => false,
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Pedro Garza",
                "email"         => "pedro@example.com",
                "username"      => "pedro",
                "password"      => bcrypt('pedro123'),
                "artist"        => 0,
                "verified"      => false,
                "created_at"    => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        DB::table('users')->insert($users);
    }
}
