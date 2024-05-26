<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $users = [
            [
                'name' => '仙人太郎',
                'email' => 'sennin@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '牛助太郎',
                'email' => 'ushisuke@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '戦慄太郎',
                'email' => 'senritsu@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => 'ルーク太郎',
                'email' => 'ru-ku@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '志摩屋太郎',
                'email' => 'shimaya@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '香太郎',
                'email' => 'kaori@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => 'JJ太郎',
                'email' => 'jj@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '極み太郎',
                'email' => 'kiwami@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '鳥雨太郎',
                'email' => 'toriame@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '築地太郎',
                'email' => 'tsukiji@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '晴海太郎',
                'email' => 'harumi@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '三子太郎',
                'email' => 'sanko@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '八戒太郎',
                'email' => 'hakkai@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '福助太郎',
                'email' => 'fukusuke@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => 'ラー北太郎',
                'email' => 'rakita@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '翔太郎',
                'email' => 'kakeru@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '経緯太郎',
                'email' => 'keii@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '漆太郎',
                'email' => 'urushi@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => 'TOOL太郎',
                'email' => 'tool@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '木船太郎',
                'email' => 'kifune@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '2',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => 'アドミン太郎',
                'email' => 'admin@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '1',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '一般一太郎',
                'email' => 'ippan1@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '0',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '一般二太郎',
                'email' => 'ippan2@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '0',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '一般三太郎',
                'email' => 'ippan3@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '0',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
            [
                'name' => '一般四太郎',
                'email' => 'ippan4@rese.com',
                'password' => Hash::make('password'),
                'auth_id' => '0',
                'email_verified_at' => '2024-04-01 10:00:00',
                'created_at' => '2024-04-01 10:00:00',
                'updated_at' => '2024-04-01 10:00:00',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        };
    }
}
