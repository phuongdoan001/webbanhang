<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;
use App\Model\Roles;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();


        $admin  = Admin::create([
        	'username' => 'Đoàn phan Tấn Phương',
        	'img'	   => '12.jpg',
        	'email'    => 'phuong@gmail.com',
        	'phone'	   => '0779552938',
        	'role'	   => '1',
        	'password' => bcrypt('123123')
        ]);
        $author  = Admin::create([
        	'username' => 'Đoàn phan Tấn Phương',
        	'img'	   => '12.jpg',
        	'email'    => 'phuong1@gmail.com',
        	'phone'	   => '0779552938',
        	'role'	   => '2',
        	'password' => bcrypt('123123')
        ]);
        $user  = Admin::create([
        	'username' => 'Đoàn phan Tấn Phương',
        	'img'	   => '12.jpg',
        	'email'    => 'phuong2@gmail.com',
        	'phone'	   => '0779552938',
        	'role'	   => '3',
        	'password' => bcrypt('123123'),
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
