<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */
/*
namespace Kit\IO\HTTP\Curl;


use Kit\IO\HTTP\Curl;

class CurlOptions {

    private static $defaultoptions = array(

        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1",

        CURLOPT_FOLLOWLOCATION => FALSE,

        CURLOPT_ENCODING => "",

        CURLOPT_RETURNTRANSFER => TRUE,

        CURLOPT_AUTOREFERER => TRUE,

        CURLOPT_SSL_VERIFYPEER => FALSE,

        CURLOPT_CONNECTTIMEOUT => 15,

        CURLOPT_TIMEOUT => 15,

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_HEADER => FALSE,

    );

    private $options = array();

    public  $strictchecking = FALSE;


    public function __construct(){
        $this->options = self::$defaultoptions;
    }

    public function getOptionsArray()
    {
        return $this->options;
    }

    public function flushOptions(Curl $h)
    {
        while(FALSE!==(list($k,$v)=array_pop($this->options))){
            curl_setopt($h,$k,$v);
        }
    }

    public function setOption($option, $value)
    {
        $this->options[$option]=$value;
    }

    function loadMessyArray($array)
    {
        foreach($array AS $option=>$value)
        {
            if(is_int($option))
            {
                $this->options[$option] = $value;
            }
            elseif($this->validateOptionKey($option))
            {
                $options[constant($option)] = $value;
            }
        }
    }

    function validateStringKey($key){

        if(!defined($key)) return FALSE;

        if($this->strictchecking){
            if(substr($key,0,7)==='CURLOPT_') return FALSE;
        }

        return TRUE;
    }

}

*/
