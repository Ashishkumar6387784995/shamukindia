<?php

use App\Models\LeadsLog;

if(!function_exists('generate_log')) {
    function generate_log($lead_id, $message, $user_id) {
        $log = new LeadsLog();
        $log->lead_id = $lead_id;
        $log->message = $message;
        $log->executer_id = $user_id;
        $log->save();
    }
}