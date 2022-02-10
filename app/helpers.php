<?php

use App\Models\Pendaftaran;

if (!function_exists('date_format_id')) {
    function date_format_id($date)
    {
        $months = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $ex = explode('-', $date);
        return "$ex[2] " . $months[(int)$ex[1]] . " $ex[0]";
    }
}

if (!function_exists('is_array_empty')) {
    function is_array_empty($arr)
    {
        if(is_array($arr)) {
            foreach($arr as $key => $value){
                if(!empty($value) || $value != NULL || $value != ""){
                    return true;
                    break;
                }
            }
            return false;
        }
    }
}

if (!function_exists('pin_generator')) {
    function pin_generator($digits)
    {
        return substr(str_shuffle("0123456789"), 0, $digits);
    }
}

if (!function_exists('grader')) {
    function grader($mark)
    {
        if ($mark >= 80 && $mark <= 100) {
            return "A";
        } else if ($mark >= 70 && $mark < 80) {
            return "B";
        } else if ($mark >= 55 && $mark < 70) {
            return "C";
        } else if ($mark >= 40 && $mark < 55) {
            return "D";
        } else if ($mark < 40) {
            return "E";
        }
    }
}
