<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Department;
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
    }
}
