<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyPrefix;

class companyPrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyPrefix::create([
            'company_id' => 15,
            'prefix' => 'BRI'
        ]);
        CompanyPrefix::create([
            'company_id' => 16,
            'prefix' => 'FEM'
        ]);
        CompanyPrefix::create([
            'company_id' => 17,
            'prefix' => 'SAL'
        ]);
        CompanyPrefix::create([
            'company_id' => 18,
            'prefix' => 'SGM'
        ]);
        CompanyPrefix::create([
            'company_id' => 19,
            'prefix' => 'ECO'
        ]);
        CompanyPrefix::create([
            'company_id' => 20,
            'prefix' => 'NAL'
        ]);
        CompanyPrefix::create([
            'company_id' => 21,
            'prefix' => 'LYM'
        ]);
        CompanyPrefix::create([
            'company_id' => 22,
            'prefix' => 'MBS'
        ]);
        CompanyPrefix::create([
            'company_id' => 23,
            'prefix' => 'JLZ'
        ]);
        CompanyPrefix::create([
            'company_id' => 24,
            'prefix' => 'JPA'
        ]);
        CompanyPrefix::create([
            'company_id' => 25,
            'prefix' => 'RQZ'
        ]);
        CompanyPrefix::create([
            'company_id' => 26,
            'prefix' => 'FUM'
        ]);
        CompanyPrefix::create([
            'company_id' => 27,
            'prefix' => 'KIT'
        ]);
        CompanyPrefix::create([
            'company_id' => 28,
            'prefix' => 'CYH'
        ]);
        CompanyPrefix::create([
            'company_id' => 29,
            'prefix' => 'MAT'
        ]);
        CompanyPrefix::create([
            'company_id' => 30,
            'prefix' => 'PRA'
        ]);
        CompanyPrefix::create([
            'company_id' => 31,
            'prefix' => 'VIS'
        ]);
        CompanyPrefix::create([
            'company_id' => 32,
            'prefix' => 'PRO'
        ]);
        CompanyPrefix::create([
            'company_id' => 33,
            'prefix' => 'TRA'
        ]);
    }
}
