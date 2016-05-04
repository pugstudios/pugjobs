<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Helper\HelperController as pr;

class Job extends Model {


    protected $fillable = [
        'title'
    ];

    protected $hidden = [];
    
    protected $table = 'jobs';

    public static function GetJobs() {
        return Job::get();
    }
}
