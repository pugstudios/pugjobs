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

    /**
     * GetJobs
     * 
     * @return array
     */
    public static function GetJobs() {
        return Job::get();
    }

    /**
     * CreateJob
     * 
     * @param type $data
     * @return \App\Models\Job
     */
    public static function CreateJob($data) {
        // Determine the start/end dates
        $daterange = explode(' - ', $data['daterange']);
        $start = $daterange[0];
        $end = $daterange[1];

        $job = new Job();
        $job -> status = 'saved';
        $job -> employer_id = $data['employer_id'];
        $job -> title = e(ucwords($data['title']));
        $job -> description = e($data['description']);
        $job -> remote = $data['remote'];
        $job -> location = e(ucwords($data['location']));
        $job -> salary = $data['salary'];
        $job -> start = $start;
        $job -> end = $end;
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
