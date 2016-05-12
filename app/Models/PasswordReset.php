<?php

namespace App\Models;

use App\Http\Controllers\Helper\HelperController as pr;
use App\Models\PugModel;
use App\Models\User;
use DateTime;

class PasswordReset extends PugModel {

    protected $fillable = [
        'email', 'token'
    ];
    protected $hidden = [];
    protected $table = 'password_resets';
    
    /**
     * Create Reset
     * 
     * @param type $email
     */
    public static function CreateReset($email) {
        // Create the reset token
        $token = pr::createToken();

        // Create the password reset link
        try {
            $reset = new PasswordReset();
            $reset -> email = $email;
            $reset -> token = $token;
            $reset -> save();

            Email::Send('email.password-reset-link', $email, 'Password Reset Request', ['subject' => 'Password Reset Request', 'token' => $token]);
        } catch (Exception $e) {
            pr::show($e);
            die();
        }
    }

    /**
     * DestroyReset
     * @param type $token
     */
    public static function DestroyReset($token) {
        PasswordReset::where('token', $token) -> delete();
    }

    /**
     * Send Reset Link
     * 
     * @param type $email
     */
    public static function SendResetLink($email) {
        // Variables
        $user_found = TRUE;

        // Get the user
        if ($user = User::where('email', $email) -> first()) {
            // Create the password reset link
            self::CreateReset($email);
        } else {
            $user_found = FALSE;
        }

        return $user_found;
    }

    /**
     * Validate Reset
     * @param type $token
     * @return boolean
     */
    public static function ValidateReset($token) {
        // Variables
        $validated = FALSE;

        if ($reset = PasswordReset::where('token', $token) -> first()) {
            // Setup timestamps
            $created = new DateTime($reset -> created_at);
            $now = new DateTime('NOW');
            $diff = $created -> diff($now);

            // Is reset still within valid window
            if ($diff -> format('%h') < env('PASSWORD_RESET_MAX_HOURS')) {
                $validated = TRUE;
            } else {
                // Destroy the reset
                self::DestroyReset($token);
            }
        }

        return $validated;
    }

}
