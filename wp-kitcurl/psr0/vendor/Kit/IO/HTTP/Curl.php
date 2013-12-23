<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP;


class Curl {

    const _VERSION = 1000;

    private static $_instCURL = null;

    private static $exposed_methods = array(
        'curl_setopt',
        'curl_unescape',
        'curl_version',
    );

    private $_instCURLCopy    = null;

    private $_response = array();

    private $_complete = FALSE;

    public function __construct(){

        if(self::$_instCURL===null){

            self::$_instCURL = curl_init();

            Curl\CurlOptions::setOption(CURLOPT_HEADERFUNCTION, array($this, '_setHeader'));

            Curl\CurlOptions::applyOptions(self::$_instCURL);
echo "kjhjgjgjhgjhghjgjhghj";
        }

    }


    public static function __callStatic($method,$args){
        if(in_array($method,self::$exposed_methods)
           && is_callable($method))
               return call_user_func_array($method,$args);
        throw new \Exception();
    }


    private function _setHeader($ch, $header)
    {

        $this->_response['responce'][] = $header;

        return strlen($header);

    }


    static function processUrl($url){

        return str_replace('&amp;','&',$url);

    }


    public function load($url,$options=array())
    {

        $this->_instCURLCopy = curl_copy_handle(self::$_instCURL);

        $options[CURLOPT_URL] = self::processUrl($url);

        curl_setopt_array($this->_instCURLCopy,$options);

        $this->_response['content']  = curl_exec($this->_instCURLCopy);

        $this->_response['responce'] = curl_getinfo( $this->_instCURLCopy );

        curl_close($this->_instCURLCopy);

    }


    public function closeParent(){

        curl_close(self::$_instCURL);

        self::$_instCURL = null;

    }


    public function getResponce(){ return $this->_complete ? $this->_response['responce'] : NULL; }

    public function getHeaders(){  return $this->_complete ? $this->_response['header'] : NULL; }

    public function getData(){     return $this->_complete ? $this->_response['responce'] : NULL; }

} 