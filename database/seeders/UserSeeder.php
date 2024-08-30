<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
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
        $category = Category::create([
            'category_name'     => 'Tshirt',
            'category_slug'    => 'tshirt',
            'category_image' => '/admin/assets/cat-1.png',
            
        ]);
        $category = Category::create([
            'category_name'     => 'IPAD',
            'category_slug'    => 'ipad',
            'category_image' => '/admin/assets/cat-1.png',
            
        ]);
        $category = Category::create([
            'category_name'     => 'shoes',
            'category_slug'    => 'shoes',
            'category_image' => '/admin/assets/cat-1.png',
            
        ]);
        $seos = Seo::create([
            'meta_title'     => 'Admin',
            
        ]);
        $site_setting = SiteSetting::create([
            'email'    => 'admin@example.org',
            
        ]);
    }
}
