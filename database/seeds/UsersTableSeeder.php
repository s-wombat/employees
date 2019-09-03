<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for ($i = 1; $i <= 500; $i++) {
        $parent_id = random_int(0,10);
        if($parent_id == $i){
            $parent_id = $i - 1;
        }
            $users[] = [
                'parent_id' =>$parent_id,
                'name' => 'user'.$i,
//                'name' => Str::random(10),
                'patronymic' => Str::random(15),
                'surname' => Str::random(10),
                'email' => Str::random(5) . '@gmail.com',
                'position' => Str::random(10),
                'employment_date' => today(),
                'salary' => random_int(1, 100),
                'password' => bcrypt('123'),
            ];
        }
        DB::table('users')->insert($users);
    }
}
