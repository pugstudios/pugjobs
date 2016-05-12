<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;

class HelperController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }
    
    /**
     * Show
     * 
     * @param type $array
     */
    public static function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    
    /**
     * createToken()
     * Generates a randomized token to be used for any purpose
     *
     * @return string
     */
    public static function createToken($num = NULL) {
        if (!empty($num)) {
            $str = "";
            for ($i = 0; $i < $num; $i++) {
                $str .= self::S4() . '-';
            }
            $str = substr($str, 0, -1);
        } else {
            $str = self::S4() . self::S4() .
                    '-' . self::S4() .
                    '-' . self::S4() .
                    '-' . self::S4() .
                    '-' . self::S4() . self::S4();
        }
        return $str;
    }

    /**
     * s4()
     * Returns a randomly generated string that is four characters in length
     * @return string
     */
    private static function S4() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';
        for ($i = 0; $i <= 4; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

}
