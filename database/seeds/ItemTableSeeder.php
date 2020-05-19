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
                'quantity' => '100750',
                'quantity_type_id' =>2,
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
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'lux',
                'description' => 'lux 65g',
                'category_id' => 2,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'kohoba',
                'description' => 'kohoba 65g',
                'category_id' => 2,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'LifeBoy',
                'description' => 'LifeBoy 65g',
                'category_id' => 2,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'asd123',
                'description' => 'asd123 65g',
                'category_id' => 1,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'asd12345',
                'description' => 'asd12345 65g',
                'category_id' => 1,
                'shop_id' => 1,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Cocunut Oil',
                'description' => 'Oil liquide',
                'category_id' => 1,
                'shop_id' => 1,
                'price' => 330,
                'quantity' => '8750',
                'quantity_type_id' => 3,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'lux123',
                'description' => 'lux123 65g',
                'category_id' => 1,
                'shop_id' => 2,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'lux456',
                'description' => 'lux456 65g',
                'category_id' => 1,
                'shop_id' => 2,
                'price' => 55,
                'quantity' => '10',
                'quantity_type_id' => 1,
                'discount' => NULL,
                'image_url' => 'ADGGHGHF456asdfre456789',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
