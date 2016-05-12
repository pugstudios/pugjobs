<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\iModel;
use App\Http\Controllers\Helper\HelperController as pr;

class PugModel extends Model implements iModel {

    // Interface Methods
    public static function GetBy(array $params) {
        $query = self::select('*');
        foreach ($params as $k => $v) {
            $query -> where($k, $v);
        }
        return $query -> first();
    }

}
