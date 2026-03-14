<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder {
    public function run(): void {
        Admin::firstOrCreate(
            ['email' => 'admin@tamzid.com'],
            [
                'name'     => 'Tamzid',
                'password' => bcrypt('Admin@1234'),
            ]
        );
    }
}