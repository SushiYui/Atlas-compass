<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'over_name' => 'モンキーD',
                'under_name' => 'ルフィ',
                'over_name_kana' => 'モンキーディ',
                'under_name_kana' => 'ルフィ',
                'mail_address' => 'monkeydluffy@onepiece.com',
                'sex' => 1,
                'birth_day' => '1997-05-05',
                'role' => 1,
                'password' => Hash::make('onepiece'), 
                'remember_token' => Str::random(10),
            ],
            [
                'over_name' => 'トラファルガーD',
                'under_name' => 'ワーテルロー',
                'over_name_kana' => 'トラファルガーディ',
                'under_name_kana' => 'ワーテルロー',
                'mail_address' => 'trafalgarlaw@onepiece.com',
                'sex' => 1,
                'birth_day' => '1997-10-06',
                'role' => 1,
                'password' => Hash::make('onepiece'),
                'remember_token' => Str::random(10),
            ],
            [
                'over_name' => 'ポートガスD',
                'under_name' => 'エース',
                'over_name_kana' => 'ポートガスディ',
                'under_name_kana' => 'エース',
                'mail_address' => 'portgasdace@onepiece.com',
                'sex' => 1,
                'birth_day' => '1997-01-01',
                'role' => 1,
                'password' => Hash::make('onepiece'),
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}
