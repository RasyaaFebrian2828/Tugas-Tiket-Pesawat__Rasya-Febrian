<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        User::create(['name'=>'Admin LionAir','email'=>'admin@lionair.test','password'=>Hash::make('password'),'role'=>'admin']);
        User::create(['name'=>'Rasya','email'=>'user@lionair.test','password'=>Hash::make('password'),'role'=>'user']);
    }
}
