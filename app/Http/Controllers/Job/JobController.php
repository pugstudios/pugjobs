<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        // Middleware
        $this -> middleware('auth.job');
    }

    /**
     * Create a job
     * 
     * @return type
     */
    public function create() {
        return view('pages.create-job', self::$data);
    }

}
