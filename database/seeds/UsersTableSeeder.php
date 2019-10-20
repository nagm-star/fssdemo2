<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'nagm yousif',
            'email' => 'nagmo90@gmail.com',
            'password' => Hash::make('starstar'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.png',
            'about' => 'ctetur adipisicing elit. Voluptatum quisquam voluptas facilis aut natus debitis aperiam, at distinctio dolorem tenetur molestias quaerat ',
            'facebook'=> 'facebook.com',
            'youtube'=> 'youtube.com'
        ]);
    }
}
