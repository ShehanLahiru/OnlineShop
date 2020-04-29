<?php

use Illuminate\Database\Seeder;

class CategoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('item_categories')->delete();

        \DB::table('item_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Sugar',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Soap',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
