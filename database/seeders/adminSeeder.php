<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder {
    public function run(): void {
        Admin::create([
            'name'     => 'Tamzid',
            'email'    => 'admin@tamzid.com',
            'password' => bcrypt('Admin@1234'),
        ]);
    }
}