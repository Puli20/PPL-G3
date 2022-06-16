<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@coffe.com',
                'role' => '1',
                'tgl_lahir' => Carbon::parse('2000-01-01'),
                'no_telp' => '081237188952',
                'alamat' => 'Sidoarjo, Jawa Timur',
                'password' => Hash::make('12345678'),

            ]

        ];

        foreach ($user as $key => $value) {

            User::create($value);

        }

    }
}
