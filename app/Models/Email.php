<?php

namespace App\Models;

use App\Http\Controllers\Helper\HelperController as pr;
use Illuminate\Support\Facades\Mail;
use App\Models\PugModel;

class Email extends PugModel {

    private static $email_active = TRUE;
    protected $fillable = [
        'to_emails', 'to_cc_emails', 'to_bcc_emails', 'from_email', 'template',
        'params'
    ];
    protected $hidden = [];
    protected $table = 'sent_emails';

    public static function Send($template, $to, $title, $params = array(), $cc = NULL, $bcc = NULL) {
        if (self::$email_active) {
            Mail::send($template, $params, function ($m) use ($to, $title, $cc, $bcc) {
                // From
                $m -> from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));

                // To
                if (is_array($to)) {
                    foreach ($to as $t) {
                        $m -> to($t, $t);
                    }
                } else {
                    $m -> to($to, $to);
                }

                // CC
                if (!empty($cc)) {
                    if (is_array($cc)) {
                        foreach ($tcc as $c) {
                            $m -> cc($c, $c);
                        }
                    } else {
                        $m -> cc($cc, $cc);
                    }
                }

                // BCC
                if (!empty($bcc)) {
                    if (is_array($bcc)) {
                        foreach ($bcc as $b) {
                            $m -> bcc($b, $b);
                        }
                    } else {
                        $m -> bcc($bcc, $bcc);
                    }
                }

                // Subject
                $m -> subject($title);
            });

            // Save the sent email here
        }
    }

}
