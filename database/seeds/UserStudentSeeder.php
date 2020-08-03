<?php

use App\User;
use Illuminate\Database\Seeder;

class UserStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name'=> 'abdullah butt',
            'email'=>'abdullahbutt3434@gmail.com',
            'role'=>'admin',
            'password'=>bcrypt('Royal782')

        ]);
        $user1 = User::create([
            'name'=> 'Usman',
            'email'=>'usman@gmail.com',
            'role'=>'student',
            'RegNo'=>'17-SE-67',
            'grade'=>'N/A',
            'password'=>bcrypt('Royal782')

        ]);

        $user2 = User::create([
            'name'=> 'Ali',
            'email'=>'Ali@gmail.com',
            'role'=>'student',
            'RegNo'=>'17-SE-99',
            'grade'=>'N/A',
            'password'=>bcrypt('Royal782')

        ]);

        $user3 = User::create([
            'name'=> 'Umer',
            'email'=>'umer@gmail.com',
            'role'=>'student',
            'RegNo'=>'17-SE-77',
            'grade'=>'N/A',
            'password'=>bcrypt('Royal782')

        ]);
        $user4 = User::create([
            'name'=> 'fahad',
            'email'=>'fahad@gmail.com',
            'role'=>'student',
            'RegNo'=>'17-SE-23',
            'grade'=>'N/A',
            'password'=>bcrypt('Royal782')

        ]);

    }
}
