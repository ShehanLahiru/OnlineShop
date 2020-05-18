<?php

use Illuminate\Database\Seeder;

class QuantityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('quantity_types')->delete();

        \DB::table('quantity_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'piece',
                'unit1' => '',
                'unit2' => '',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'loose',
                'unit1' => 'Kg',
                'unit2' => 'g',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'liquide',
                'unit1' => 'L',
                'unit2' => 'Ml',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
