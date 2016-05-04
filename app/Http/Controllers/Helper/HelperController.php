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
    
    public static function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}
