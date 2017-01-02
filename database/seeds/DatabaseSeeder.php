<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('UsersSeeder');
    }
}


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'email' => 'first@gmail.com',
            'password' => 'qweasd',
            'is_active' => 1,
            'email_date' => DB::raw('CURRENT_TIMESTAMP'),
            'email_code' => '1234'
        ]);
        User::create([
                    'email' => 'second@gmail.com',
                    'password' => 'qweasd',
                    'is_active' => 1,
                    'email_date' => DB::raw('CURRENT_TIMESTAMP'),
                    'email_code' => '1234'
                ]);
        User::create([
                    'email' => 'third@gmail.com',
                    'password' => 'qweasd',
                    'is_active' => 1,
                    'email_date' => DB::raw('CURRENT_TIMESTAMP'),
                    'email_code' => '1234'
                ]);

       
    }
}