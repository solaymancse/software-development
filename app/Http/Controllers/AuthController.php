<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function registerStore(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $confirm_password = $request->confirm;
        
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = md5($password);
        $user->role = 'Student';
        if($user->save()){
            return redirect()->back()->with('info', 'Account Created. Waiting for admin approval');
        }
    }
    public function login(){
        return view('auth.login');
    }
    public function loginStore(Request $request){
        $email = $request->email;
        $password = $request->password; # 123456
        $user = User::where('email', '=', $email)
            ->where('password', '=', md5($password))
            ->first();
        if($user){
            if($user->is_approved == 1){
                Session::put('username', $user->name);
                Session::put('userrole', $user->role);
                return redirect('dashboard');
            }
            else{
                return redirect()->back()->with('failure', 'Account not yet approved');
            }
        }
    }
    public function dashboard(){
        return view('auth.dashboard');
    }
}
