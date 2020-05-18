<?php

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
           $this->call(UserTableSeeder::class);
           $this->call(ItemTableSeeder::class);
           $this->call(ShopTableSeeder::class);
           $this->call(CategoryTypeTableSeeder::class);
           $this->call(QuantityTypeTableSeeder::class);
    }
}
