<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.pre_login');
    }

    public function admin_login()
    {
        return view('login.admin_login');
    }
    public function user_login()
    {
        return view('login.user_login');
    }

    public function admin_login_request(Request $request){
        dd('admin login request', $request->all());
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ], 422);
        }

        // Attempt to log the user in
        $credentials = [
            'email' => $request->input('username'),
            'password' => $request->input('password'),
            'account_type' => $request->input('account_type'),
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            //return response()->json([
            //    'status' => 1,
            //    'message' => 'Login successful',
            //]);

            return redirect()->intended(route('admin.dashboard'));
        }
        elseif (Auth::guard('user')->attempt($credentials)) {
            // Authentication passed
            return response()->json([
                'status' => 1,
                'message' => 'Login successful',
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'status' => 0,
                'errors' => ['password' => ['Invalid email or password']],
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Determine the current route prefix
        $path = $request->path();

        // Logout the user from the appropriate guard
        if (str_starts_with($path, 'admin')) {
            Auth::guard('admin')->logout();
        }
        else {
            Auth::guard()->logout(); // Default guard
        }

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the appropriate login page based on the prefix
        if (str_starts_with($path, 'admin')) {
            return redirect()->route('login.admin_login');
        } elseif (str_starts_with($path, 'user')) {
            return redirect()->route('login.user_login');
        } else {
            return redirect()->route('login'); // Default route
        }
    }

}
