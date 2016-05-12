<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder {

    public function run(){
        DB::table('users')->insert(array(
            array('id'=>1, 'name'=>"", 'email'=>'', 'password'=>''),
            array('id'=>2, 'name'=>"", 'email'=>'', 'password'=>''),
        ));
    }

}