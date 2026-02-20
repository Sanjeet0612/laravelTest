<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAuthenticationController extends Controller
{
    public function showAdminLogin(){
        return view('admin.authentication.signin');
    }

    public function admin_login(Request $request){
        $request->validate([
            'emailid' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = [
            'emailid' => $request->emailid,
            'password' => $request->password,
            'status'   => 1, // only active admin login
        ];
        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.admin_dashboard')->with('success', 'Login Successful');
        }
        return back()->with('error', 'Invalid Credentials');
    }

    public function admin_dashboard(Request $request){
        return view('admin.dashboard.admin_dashboard');
    }

    public function admin_logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.admin_login');
    }


}