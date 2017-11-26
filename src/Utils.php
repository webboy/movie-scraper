<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 11/25/2017
 * Time: 10:00 PM
 */

namespace Webboy\MovieScraper;


class Utils
{
    static function remove_year($string='')
    {
        if (empty($string))
        {
            return $string;
        }
        for ($i = 1900;$i<=intval(date('Y'));$i++)
        {
            $string = str_replace('('.$i.')','',$string);
        }

        return $string;
    }

    static function string_between($start='',$end='',$string='')
    {
        if (empty($start) || empty($end) || empty($string))
        {
            return $start;
        }

        $s_pos = strpos($string,$start);
        $e_pos = strpos($string,$end);
        $l = $e_pos-$s_pos;

        return intval(substr($string,$s_pos+1,$l-1));
    }
}