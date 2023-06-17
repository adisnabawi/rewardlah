<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Department;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $company = [
            'name' => 'RewardLah',
            'ssm' => '123456789',
            'address' => '123, Jalan 123, Taman 123, 12345, Kuala Lumpur',
        ];

        $company = Company::firstOrCreate($company);

        $departmentData = [
            ['name' => 'Sales', 'color' => '#9c6efc', 'company_id' => $company->id],
            ['name' => 'Marketing', 'color' => '#ff6b6b', 'company_id' => $company->id],
            ['name' => 'Finance', 'color' => '#feca57', 'company_id' => $company->id],
            ['name' => 'Human Resource', 'color' => '#48dbfb', 'company_id' => $company->id],
            ['name' => 'IT', 'color' => '#1dd1a1', 'company_id' => $company->id],
        ];

        foreach ($departmentData as $department) {
            Department::firstOrCreate(['name' => $department['name'], 'company_id' => $department['company_id']], ['color' => $department['color']]);
        }
        $user = User::where('email', 'admin@rewardlah.my')->first();
        if (!$user) {
            \App\Models\User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@rewardlah.my',
                'password' => bcrypt('password'),
                'company_id' => $company->id,
                'points' => 1000,
                'level' => 1,
            ]);
        }

        $user = User::where('email', 'adis@rewardlah.my')->first();
        if (!$user) {
            \App\Models\User::factory()->create([
                'name' => 'Adis',
                'email' => 'adis@rewardlah.my',
                'password' => bcrypt('password'),
                'company_id' => $company->id,
                'department_id' => Department::where('name', 'IT')
                    ->where('company_id', $company->id)
                    ->first()
                    ->id,
                'level' => 2,
            ]);
        }

        \App\Models\User::factory(10)->create(
            [
                'level' => 2,
                'company_id' => $company->id,
            ]
        );
        
        $products = [
            [
                'id' => 1,
                'name' => 'Rumos Ray Cinema Projector',
                'description' => 'LUMOS RAY gives you the complete home cinema experience with a huge 150-inch projected screen, 1080p-supported resolution and theater-like dual built-in Dolby Audio Speakers.',
                'redeem_points' => 10000,
                'price' => 620,
                'image' => '/img/products/1.png',
            ],
            [
                'id' => 2,
                'name' => 'JBL FLIP 6 Portable Water Proof Speaker',
                'description' => 'The waterproof, dustproof JBL Flip 6 has 12 hours of battery life, delivering powerful JBL Original Pro Sound wherever the music takes you.',
                'redeem_points' => 8000,
                'price' => 560,
                'image' => '/img/products/2.png',
            ],
            [
                'id' => 3,
                'name' => 'JBL Tune 230NC TWS TRUE Wireless Bud',
                'description' => 'The waterproof, dustproof JBL Flip 6 has 12 hours of battery life, delivering powerful JBL Original Pro Sound wherever the music takes you.',
                'redeem_points' => 7000,
                'price' => 389,
                'image' => '/img/products/3.png',
            ],
            [
                'id' => 4,
                'name' => 'Netflix Gift Card (RM50)',
                'description' => 'Enjoy watching Netflix.',
                'redeem_points' => 700,
                'price' => 50,
                'image' => '/img/products/4.png',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate($product);
        }
    }
}
