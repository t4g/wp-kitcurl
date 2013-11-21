<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl;


interface KitCurlCacheInterface {

    const PREFIX  = __CLASS__;
    const TTL     = 600;

    function get($key);
    function set($key,$data);
    function flush($key);

} 