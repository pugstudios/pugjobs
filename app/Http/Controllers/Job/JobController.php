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
        $this -> middleware('auth.isCompany', ['only' => [
                'posted', 'edit'
        ]]);
    }

    /**
     * Create a job
     * 
     * @return type
     */
    public function create() {
        return view('pages.create-job', self::$data);
    }

    /**
     * Edit
     * 
     * @return type
     */
    public function edit(Request $request, $id) {
        // Get the job
        $job = Job::GetBy(array('id' => $id));

        // Ensure the company that is logged in owns this job
        if ($job -> employer_id != $request -> session() -> get('user') -> id) {
            return redirect('/job/posted') -> with('error', 'You do not own this job posting.');
        } else {
            self::AddData('job', $job);
            return view('pages.edit-job', self::$data);
        }
    }

    public function editPost(Request $request, $id) {
        // Validation
        $this -> validate($request, [
            'title' => 'required|min:6',
            'employer_id' => 'required|integer',
            'description' => 'required|min:6',
            'remote' => 'required|integer',
            'location' => 'required_if:remote,(0,2)'
        ]);

        // Save the edited job
        Job::EditJob($request -> all(), $id);
        
        // Redirect to job postings
        return redirect('job/posted') -> with('success', 'You have successfully updated your job posting.');
    }

    /**
     * Company Posted Jobs
     * 
     * @return type
     */
    public function posted() {
        // Get the jobs
        self::AddData('jobs', Job::GetCompanyJobs());

        return view('pages.posted-jobs', self::$data);
    }

}
