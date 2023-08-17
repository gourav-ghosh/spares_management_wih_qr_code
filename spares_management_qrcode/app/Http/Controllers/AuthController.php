<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }
    public function login_post(Request $request)
    {

        $user = User::where('phone', '=', $request->get('phone'))->first();

        $remember_me = $request->has('remember_me') ? true : false;

        if ($user) {
            if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password], $remember_me)) {
                $user = auth()->user();
                $request->session()->put('user', $user);
                // return redirect()->back()->with('message', 'Logged in successfully');
                return redirect('/dashboard')->with('message', 'Logged in successfully');
            } else {
                return redirect()->back()->withErrors(['error' => ['Invalid Password']]);
            }

        } else {
            return redirect()->back()->withErrors(['error' => ['Mobile does not Exists. Please register your account']]);
        }
    }
    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('message', 'Logged out successfully');
    }
    public function reset_password()
    {
        if (Auth::check()) {
            return view('auth.reset_password');
        } else {
            return redirect()->back()->withErrors(['error' => ['You have to log in to reset your password']]);
        }
    }
    public function reset_password_post(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('password_new') == $request->get('password_confirm')) {
                if (Hash::check($request->get('password_old'), Auth::user()->password)) {
                    $user = User::where('id', Auth::id())->whereNull('leaving_date')->first();
                    $user->password = Hash::make($request->get('password_new'));
                    $user->save();
                    session()->flush();
                    return redirect('/login')->with('message', 'Password has been changed successfully');
                } else {
                    return redirect()->back()->withErrors(['error' => ['Incorrect current password']]);
                }
            } else {
                return redirect()->back()->withErrors(['error' => ['New password and confirm password does not match.']]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['You have to log in to reset your password']]);
        }
    }
    public function add_user()
    {
        if (Auth::check()) {
            if (Auth::user()->role != 'associate') {
                return view('auth.add_user');
            } else {
                return redirect()->back()->withErrors(['error' => ["You don't have the authority to add a user"]]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['You have to log in to add a user']]);
        }
    }
    public function add_user_post(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role != 'associate') {
                if ($request->get('password') == $request->get('password_confirm')) {
                    $user = new User;
                    $user->company_id = $request->get('company_id');
                    $user->name = $request->get('name');
                    $user->phone = $request->get('phone');
                    $user->email = $request->get('email');
                    $user->department = $request->get('department');
                    $user->role = $request->get('role');
                    $user->joining_date = $request->get('joining_date');
                    $user->password = Hash::make($request->get('password'));
                    $user->save();
                    return redirect()->back()->with('message', 'User added successfully.');
                } else {
                    return redirect()->back()->withErrors(['error' => ["Password and confirmed password do not match"]]);
                }
            } else {
                return redirect()->back()->withErrors(['error' => ["You don't have the authority to add a user"]]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => ['You have to log in to add a user']]);
        }
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        } else {
            return redirect('/login')->withErrors(['error' => ['You have to log in to access the dashboard page']]);
        }
    }
}