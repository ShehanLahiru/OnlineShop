<?php

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shops')->delete();

        \DB::table('shops')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Ns stores',
                'address' => '123/5 nochchiyagama',
                'contact_no' => '0718792578',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'SN Stores',
                'address' => '123/6 nochchiyagama',
                'contact_no' => '0718792578',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
