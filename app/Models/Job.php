<?php

namespace App\Models;

use App\Models\PugModel;
use App\Http\Controllers\Helper\HelperController as pr;

class Job extends PugModel {

    protected $fillable = [
        'title'
    ];
    protected $hidden = [];
    protected $table = 'jobs';

    // Associations
    // Stages
    public function company() {
        return $this -> belongsTo('App\Models\User', 'employer_id', 'id');
    }

    /**
     * GetCompanyJobs
     * 
     * @return array
     */
    public static function GetCompanyJobs() {
        return Job::where('employer_id', session('user') -> id) -> orderBy('created_at', 'desc') -> paginate();
    }

    /**
     * GetJobs
     * 
     * @return array
     */
    public static function GetJobs() {
        return Job::with('company') -> orderBy('created_at', 'desc') -> paginate();
    }

    /**
     * CreateJob
     * 
     * @param type $data
     * @return \App\Models\Job
     */
    public static function CreateJob($data) {
        $job = new Job();
        $job -> status = 'saved';
        $job -> employer_id = $data['employer_id'];
        $job -> title = e(ucwords($data['title']));
        $job -> description = e($data['description']);
        $job -> remote = $data['remote'];
        $job -> location = e(ucwords($data['location']));
        $job -> salary = $data['salary'];
        $job -> start = self::DetermineStartEndDate($data['daterange'], 'start');
        $job -> end = self::DetermineStartEndDate($data['daterange'], 'end');
        $job -> save();

        return $job;
    }

    public static function EditJob($data, $id) {
        $job = Job::GetBy(array('id' => $id));
        $job -> title = e(ucwords($data['title']));
        $job -> description = e($data['description']);
        $job -> remote = $data['remote'];
        $job -> location = e(ucwords($data['location']));
        $job -> salary = $data['salary'];
        $job -> save();

        return $job;
    }

    /**
     * DeterminePrice
     * 
     * @param type $job
     * @return type
     */
    public static function DeterminePrice($job) {
        $start = new \DateTime($job -> start);
        $end = new \DateTime($job -> end);
        $diff = $start -> diff($end);

        return $diff -> days * env('PRICE_PER_DAY');
    }

    /**
     * Determine Date Range
     * 
     * @param type $dateRange
     * @return type
     */
    private static function DetermineStartEndDate($dateRange, $option) {
        // Determine Date Range
        $daterange = explode(' - ', $dateRange);
        
        if($option == "start") {
            // Start Date
            return $daterange[0];
        } else {
            // End Date
            return $daterange[1];
        }
    }

    /**
     * DetermineDays
     * 
     * @param type $job
     * @return type
     */
    public static function DetermineDays($job) {
        $start = new \DateTime($job -> start);
        $end = new \DateTime($job -> end);
        $diff = $start -> diff($end);

        return $diff -> days;
    }

}
