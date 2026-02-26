<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl\Cache;


use Kit\IO\HTTP\KitCurl\KitCurlCacheInterface;


class Redis implements KitCurlCacheInterface {

    private static $redis = null;


    private function _firstCall(){
        self::$redis = new \Redis();
        self::$redis->connect( 'localhost', 6379 );
        self::$redis->setOption( \Redis::OPT_PREFIX, self::PREFIX . ':' );
        self::$redis->setOption( \Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP );
    }

    private function hash($key){
        return md5(self::PREFIX.$key);
    }

    public function __construct(){
        if(self::$redis === null) $this->_firstCall();
    }

    public function get($url){
        $result = self::$redis->get($this->hash($url));
        if($result === FALSE) return FALSE;
        return $result;
    }

    public function set($key, $data)
    {
        return self::$redis->setex($this->hash($key), self::TTL, $data);
    }

    function flush($key)
    {
        return self::$redis->flushDB();
    }

    function &backend()
    {
        return self::$redis;
    }
}
