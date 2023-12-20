<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**php artisan db:seed --class=UserSeeder
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
 
        $seos = Seo::create([
            'meta_title'     => 'Admin',
            
        ]);
        $site_setting = SiteSetting::create([
            'email'    => 'admin@example.org',
            
        ]);
    }
}
