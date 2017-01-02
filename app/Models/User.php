<?php

namespace App\Models;
use Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createRandomPassword() {

        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        return $pass;

    }

    public function applyEmailCode($id, $password){
        return DB::table('users')
            ->where('id', $id)
            ->where('email_code', $password)
            ->update(array('is_active' => 1));
    }


    public function send_email($email, $email_code){

        $text = "Please enter this code: $email_code";

        Mail::raw($text, function($message) use ($email)
        {
            $message->to($email, 'Джон Смит')->subject('Email code');
            $message->from('mamedovtimur14@gmail.com', 'Laravel');
        });
    }

    public function add_user(){
        $email = Input::get('email');
        $email_code = User::createRandomPassword();



        $user_id = DB::table('users')->insertGetId(
            [
                'email' => $email,
                'password' => Input::get('password'),
                'is_active' => 0,
                'email_date' => Carbon::now(),
                'email_code' => $email_code,
                'count_send_emails' => 1,
            ]
        );

        if(!empty($user_id))
            $this->send_email($email, $email_code);

        session()->put('id', $user_id);
    }

    public function check_code(){

       $result =  DB::table('users')
            ->where('id', session()->get('id'))
            ->update(array('is_active' => 1));
        if($result) {
            $this->rememberUser();
            echo 'success';
        }
        else
            echo 'wrong password';

    }
    
    public static function rememberUser(){
        $user = DB::table('users')
            ->select('email')
            ->where('id', session()->get('id'))
            ->get();
        session()->put('email', $user[0]->email);
    }
    
    
    public static function deleteNonActiveUsers()
    {
        $users = DB::table('users')
        ->select('id')
        ->where('is_active', 0)
        ->where('count_send_emails', 2)
        ->where('email_date', '<', Carbon::now().' - INTERVAL 12 HOUR')->get();

        foreach($users as $user) {
            DB::table('users')
                ->select('user')
                ->where('id', $user->id)
                ->delete();
        }
    }
    
    public static function SendSecondMessage()
    {
        $users = DB::table('users')
            ->select('id','email')
            ->where('is_active', 0)
            ->where('count_send_emails', 1)->get();
        $user = new User();
        foreach($users as $u) {

            $email_code = User::createRandomPassword();
            $user->send_email($u->email, $email_code);

            DB::table('users')
                ->where('is_active', 0)
                ->where('count_send_emails', 1)
                ->update(array(
                    'count_send_emails' => 2,
                    'email_code' => $email_code,
                    'email_date' => Carbon::now()));

        }
    }
    public static function login()
    {
        $user = DB::table('users')
            ->select('email','id')
            ->where('email', Input::get('email'))
            ->where('password', Input::get('password'))->get();

        if(!empty($user)){
            session()->put('email', $user[0]->email);
            session()->put('id', $user[0]->id);
            echo 'success';
        }

        else
            echo 'error';
    }

}
