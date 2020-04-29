<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->delete();

        \DB::table('items')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'sugar',
                'description' => 'white sugar',
                'category_id' => 1,
                'shop_id' => 1,
                'price' => 100,
                'quantity' => '10kg',
                'quantity_type' => 'loose',
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'sunlight',
                'description' => 'sunlight 65g',
                'category_id' => 2,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type' => 'piece',
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
