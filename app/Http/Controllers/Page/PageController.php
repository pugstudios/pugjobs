<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;
use App\Models\Job;

class PageController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        // Get the jobs
        self::AddData('jobs', Job::GetJobs());
        
        return view('pages.index', self::$data);
    }

}
