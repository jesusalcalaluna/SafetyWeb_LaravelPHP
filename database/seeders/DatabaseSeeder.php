<?php

namespace Database\Seeders;

use App\Models\Dangers;
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
        $this->call([
            behaviorsGroupSeeder::class,
            actsTypeSeeder::class,
            dangersSeeder::class,
            dangerousConditionsSeeder::class,
            companiesAndDepartmentsSeeder::class,
            peopleSeeder::class,
            goldRulesSeeder::class,
            rolesSeeder::class,
            conditionGroupsSeeder::class,
            typeConditionSeeder::class,
            superUserSeeder::class,
            companyPrefixSeeder::class,
        ]);
    }
}
