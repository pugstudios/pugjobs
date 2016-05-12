<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;
use App\Models\User;
use App\Models\PasswordReset;

class UserController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Create An Account
     * 
     * @return view
     */
    public function create() {
        return view('pages.create-account', self::$data);
    }

    /**
     * Create A Company Account
     * 
     * @return view
     */
    public function createCompany() {
        return view('pages.create-company', self::$data);
    }

    /**
     * Create An Account Post
     * 
     * @return view
     */
    public function createPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'newsletter' => 'required|boolean',
            'type' => 'required|in:employee,employer,staff',
            'name' => 'sometimes|required',
        ]);

        // Create user
        $userData = array(
            'email' => $request -> get('email'),
            'password' => $request -> get('password'),
            'newsletter' => $request -> get('newsletter'),
            'type' => $request -> get('type'),
            'name' => $request -> get('name') !== null ? $request -> get('name') : NULL,
            'description' => $request -> get('description') !== null ? $request -> get('description') : NULL,
            'logo' => $request -> file('logo') !== null ? $request -> file('logo') : NULL,
        );
        User::CreateUser($userData);

        // Login the user
        User::LoginUser($request -> get('email'), $request -> get('password'));

        // Redirect to homepage
        return redirect('\\') -> with('success', 'You have successfully created your account.');
    }

    /**
     * Login
     * 
     * @return view
     */
    public function login() {
        return view('pages.login', self::$data);
    }

    /**
     * Login Post
     * 
     * @param Request $request
     * @return type
     */
    public function loginPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Login User
        if (User::LoginUser($request -> get('email'), $request -> get('password'))) {
            // Redirect to homepage
            return redirect('\\') -> with('success', 'Welcome back, ' . session('user') -> email);
        } else {
            return redirect('user\login') -> with('invalid-credentials', 'Email and/or password is invalid.');
        }
    }

    /**
     * Logout
     * 
     * @return view
     */
    public function logout(Request $request) {
        // Destroy the user in the session
        $request -> session() -> forget('user');

        // Redirect to homepage
        return redirect('\\') -> with('success', 'You have successfully logged out.');
    }

    /**
     * Reset Password
     * 
     * @return view
     */
    public function password() {
        return view('pages.password', self::$data);
    }

    /**
     * Password Post
     * 
     * @param Request $request
     * @return type
     */
    public function passwordPost(Request $request) {
        // Validation
        $this -> validate($request, [
            'email' => 'required|email'
        ]);

        // Send the reset link
        if ($result = PasswordReset::SendResetLink($request -> get('email'))) {
            return redirect('\\') -> with('success', 'A password reset link was successfully sent '
                            . 'to ' . $request -> get('email') . '. The link will stay active for only 1 hour.');
        } else {
            return redirect('user\password') -> with('error', 'Email address was not found in the system.');
        }
    }

    /**
     * Password Reset
     * 
     * @param Request $request
     * @param type $token
     * @return type
     */
    public function passwordReset(Request $request, $token) {
        if (PasswordReset::ValidateReset($token)) {
            // Get the reset object (used to get the email that was passed in)
            $reset = PasswordReset::GetBy(array('token' => $token));

            // Get the user 
            self::AddData('user', User::GetBy(array('email' => $reset -> email)));

            return view('pages.password-reset', self::$data);
        } else {
            return redirect('user\password') -> with('error', 'Your reset token has expired or does not exist.');
        }
    }

    /**
     * Password Reset Post
     * 
     * @param Request $request
     * @param type $token
     * @return type
     */
    public function passwordResetPost(Request $request, $token) {
        // Validation
        $this -> validate($request, [
            'user_id' => "required|integer|exists:users,id",
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Update the users password
        $userUpdate = array(
            'password' => Hash::make($request -> get('password'))
        );
        User::UpdateUser($request -> get('user_id'), $userUpdate);
        
        // Delete the reset
        PasswordReset::DestroyReset($token);
        
        return redirect('user\login') -> with('success', 'Your password has been successfully updated.');
    }

}
