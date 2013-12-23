<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\Curl;


use Kit\IO\HTTP\Curl;

class CurlOptions {

    static $options = array(

        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1",

        CURLOPT_FOLLOWLOCATION => FALSE,

        CURLOPT_ENCODING => "",

        CURLOPT_RETURNTRANSFER => FALSE,

        CURLOPT_AUTOREFERER => TRUE,

        CURLOPT_SSL_VERIFYPEER => FALSE,

        CURLOPT_CONNECTTIMEOUT => 15,

        CURLOPT_TIMEOUT => 15,

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_HEADER => FALSE,

    );


    static public function setOption($option, $value)
    {
        self::$options[$option]=$value;
    }

    static public function applyOptions(&$handle)
    {
        if(!empty(self::$options))
            curl_setopt_array($handle,self::$options);
        //print_r($handle)."ghghg";
    }

    static public function loadMixedArray($array)
    {
        foreach($array AS $option=>$value)
        {
            if(is_int($option))
            {
                self::$options[$option] = $value;
            }
            elseif(static::validateOptionKey($option))
            {
                self::$options[constant($option)] = $value;
            }
        }
    }

    static public function validateStringKey($key){

        if(!defined($key)) return FALSE;

        return TRUE;
    }

}


