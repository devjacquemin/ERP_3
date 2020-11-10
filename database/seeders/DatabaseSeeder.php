<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Product_type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Company_type;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(10)->create();
        Company::factory(3)->create();
        //Company_type::factory(3)->create();
        Unit::factory(5)->create();
        //Product_type::factory(15)->create();
        Product::factory(15)->create();


    }
}
