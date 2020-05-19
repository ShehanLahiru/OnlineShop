<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Shehan',
                'email' => 's.lahiru1995@gmail.com',
                'address' => 'dfnjhjkfgjhjslf',
                'shop_id' => 1,
                'contact_no' => '0710390283',
                'user_type' => 'super_admin',
                'password' => bcrypt('Shehan123'),
                'image_url' => 'ADGGHGHF456asdfre',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Shehan',
                'email' => 's.lahiru@gmail.com',
                'address' => 'dfnjhjkfgjhjslf',
                'shop_id' => 1,
                'contact_no' => '0710390283',
                'user_type' => 'admin',
                'password' => bcrypt('Shehan123'),
                'image_url' => 'ADGGHGHF456asdfre',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Vihanga',
                'email' => 'vihanga@gmail.com',
                'address' => 'dfnjhjkfgjhjslf',
                'shop_id' => Null,
                'contact_no' => '0710390283',
                'user_type' => 'user',
                'password' => bcrypt('Vihanga123'),
                'image_url' => 'ADGGHGHF456asdfre',
                'created_at' => '2020-03-05 00:00:00',
                'updated_at' => '2020-03-05 00:00:00',
            ),

        ));
    }
}
