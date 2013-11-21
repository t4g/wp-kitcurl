<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP;
use Kit\IO\HTTP\KitCurl\KitCurlOptions;
use Kit\IO\HTTP\KitCurl\KitCurlRequest;


class KitCurl {

    const _VERSION = 1000;

    protected static $_named = array();

    protected static $_cache_instance = null;

    protected static $_cache_enabled  = FALSE;

    protected static $_cache_engine   = KitCurlOptions::CACHE_ENGINE_MEMCACHED;


    /**
     * @return array
     */
    public static function list_named()
    {
        return self::$_named;
    }


    /**
     * @param array $named
     * @param       $baseuri
     */
    public static function add_named($named, $baseuri)
    {
        self::$_named[$named] = array('uri' => $baseuri, 'failures' => 0);
    }


    public function isPECLMemcachedInstalled()
    {
        if(class_exists('\Memcached', FALSE))
        {
            return TRUE;
        }
        return FALSE;
    }



    public function new_http_rawget($uri)
    {
        return new KitCurlRequest($this, $uri);
    }



    public function new_http_get($named)
    {
        if(isset(self::$_named[$named]))
        {
            return new KitCurlRequest($this, self::$_named[$named]['uri']);
        }
        else return new \Exception();
    }



    public function new_http_post($name_uri)
    {

        if(isset(self::$_named[$name_uri]))
        {
            return new KitCurlRequest($this, self::$_named[$name_uri]['uri'], KitCurlRequest::REQTYPE_POST);
        }
        else
        {
            return new KitCurlRequest($this, $name_uri, KitCurlRequest::REQTYPE_POST);
        }

    }


    public function cache_enable(KitCurlOptions $state = null)
    {

        if($state!== null)
        {
            self::$_cache_enabled = (bool) $state;
        }
        else return self::$_cache_enabled;

        if($state===TRUE)
        {
            if(self::$_cache_instance === null)
            {
                $engine = 'KitCurl\\Cache\\'.self::$_cache_engine;

                self::$_cache_instance = new $engine();
            }
        }
        elseif($state===FALSE)
        {
            self::$_cache_instance = null;
        }

    }

    /**
     * @return \Kit\IO\HTTP\KitCurl\Cache\Memcached
     */
    public function &cache(){

        if(self::$_cache_instance === null) return FALSE;


        return self::$_cache_instance;
    }

} 