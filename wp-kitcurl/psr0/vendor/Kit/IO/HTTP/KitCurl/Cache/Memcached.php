<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl\Cache;


use Kit\IO\HTTP\KitCurl\KitCurlCacheInterface;


class Memcached implements KitCurlCacheInterface {

    private static $memcached = null;


    private function _firstCall(){
        $servers         = new \Kit\DB\Memcached\MemcachedConnector( 'localhost', '11211' );
        self::$memcached = new \Kit\DB\Memcached\MemcachedSafe( self::PREFIX, $servers );
    }

    private function hash($key){
        return md5(self::PREFIX.$key);
    }

    public function __construct(){
        if(self::$memcached === null) $this->_firstCall();
    }

    public function get($url){
        return self::$memcached->get($this->hash($url));
    }

    public function set($key, $data)
    {
        return self::$memcached->get($this->hash($key),$data,self::TTL);
    }

    function flush($key)
    {
        return self::$memcached->flush();
    }

    function &backend($key)
    {
        return self::$memcached;
    }
}