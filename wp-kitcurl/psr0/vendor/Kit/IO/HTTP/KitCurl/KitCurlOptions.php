<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl;


class KitCurlOptions {

    const CACHE_ENABLED  = TRUE;

    const CACHE_DISABLED = FALSE;

    const CACHE_ENGINE_MEMCACHED = 'Memcached';

    const CACHE_ENGINE_FILE      = 'File';

    const CACHE_ENGINE_REDIS     = 'Redis';

} 