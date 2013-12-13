wp-kitcurl
=============

### This project is in heavy beta & refactoring!

##Introduction

This project exposes the following **namespaces** for use in your custom plugins and themes:
* Kit\IO\HTTP\KitCurl
* Kit\DB\Memcached
* WPKit\KitCurl

### About KitCurl
KitCurl is a cURL based proxy service for loading external resources server side (for the times you just forced to).
Why KitCurl over cURL or fopen?
 * Written for server performance and stability.
 * Composer.phar driven
 * Modern PSR-0 coding pattern
 * Access to rationalised cURL configuration, like sane timeouts.
 * Memcached support with transparent failover for easier development installs.
 * Support for multiple memcached servers with failover and load-balancing.
 * Abstracted cache support for rapidly adding support for other caching systems.   
 
## Installation

Installation is done in bash (for now)

1) cd into your Wordpress mu-plugins or plugins directory

    	soap@codex:wp-contents/plugins$
	
2) grab the code

     	soap@codex:wp-contents/plugins$ git clone git@github.com:t4g/wp-kitcurl.git
	
3) build the project

      cd wp-kitcurl
    	curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
     	php bin/composer.phar install
     	
4) done! just enable it in the backend.


## Code Example

      <?php 
        
         $_ = new Kit\IO\HTTP\KitCurl();
         
         echo $_ -> new_http_rawget(<url>) -> execute()
   
   
 ---    
## Usage docs

#### Basic request

** Procedural **

         
         $kitcurl = new Kit\IO\HTTP\KitCurl();
         
         $request = $kitcurl -> new_http_rawget(<url>);
         
         $request -> set_timeout(3);   // optional, override setting on the fly
         
         $response = $request -> execute();
         
         
** OOP **

         
         $kitcurl = new Kit\IO\HTTP\KitCurl();
         
         echo $kitcurl -> new_http_rawget(<url>) -> set_timeout(3) -> execute();
         
         
** Static OOP **

         
         use Kit\IO\HTTP as Kit
         
         echo Kit\KitCurlSingleton() -> new_http_rawget(<url>) -> noCache -> execute();


** The working with the response **

         
         // get contents
         $mycontents = $response;     // or echo $response; etc etc
         

         // explore the response
         echo $response->getSize();   // total size of the doc
         

         if( $response->getIsViaCached() ){ echo "Bingo" }   // total size of the doc
         
         // .... For a full list of methods available see [[ docs ]]  


#### Using named requests

         
         $kitcurl -> add_named( 'something', 'http://api.example.com/blaa' );
         
         $kitcurl -> add_named( 'example',   'http://api.v2.example.com/blopen' );
         
         $nparam = array(
              'test'    => 'value',
              'version' => 'test'.
         )
         
         echo $kitcurl -> new_http_get('example') -> params($param) -> execute();
         
         
#### POST requests

         $postdata = array(
              'myfile'         => get_file_contents('~/etc/passed'),
              'or_login_deets' => 'myuser'
         )
         
         $kitcurl -> new_http_get('example') -> post($postdata) -> execute() -> getHeaders();


#### KitCurlRequest Sample

          HelloKit\IO\HTTP\KitCurl\KitCurlRequest Object
          (
             [_timeout_enabled:protected] =&gt; 1
             [_timeout_value:protected] =&gt; 5
             [_uncached:protected] =&gt; 
             [_expire_cache:protected] =&gt; 600
             [_inst_caller:Kit\IO\HTTP\KitCurl\KitCurlRequest:private] =&gt; Kit\IO\HTTP\KitCurl Object
                 (
                 )
         
             [_inst_responce:Kit\IO\HTTP\KitCurl\KitCurlRequest:private] =&gt; Kit\IO\HTTP\KitCurl\KitCurlResponce Object
                 (
                     [_data:protected] =&gt; 
                     [_headers:protected] =&gt; 
                     [_status:protected] =&gt; 0
                     [_path:protected] =&gt; 
                     [_iscached:Kit\IO\HTTP\KitCurl\KitCurlResponce:private] =&gt; 
                     [_stat_size:Kit\IO\HTTP\KitCurl\KitCurlResponce:private] =&gt; 
                     [_stat_microtime_start:Kit\IO\HTTP\KitCurl\KitCurlResponce:private] =&gt; 0.36297200 1386319704
                     [_stat_microtime_total:Kit\IO\HTTP\KitCurl\KitCurlResponce:private] =&gt; 
                 )

             [_inst_pcurl:Kit\IO\HTTP\KitCurl\KitCurlRequest:private] =&gt; Kit\IO\HTTP\Curl Object
                 (
                     [_instCURLCopy:Kit\IO\HTTP\Curl:private] =&gt; 
                     [_response:Kit\IO\HTTP\Curl:private] =&gt; Array
                         (
                         )

                     [_complete:Kit\IO\HTTP\Curl:private] =&gt; 
                 )

             [url:Kit\IO\HTTP\KitCurl\KitCurlRequest:private] =&gt; http://apple.com
             [reqtype:Kit\IO\HTTP\KitCurl\KitCurlRequest:private] =&gt; 
         )



#### Advanced : Working with the caching layer

** Cache options ** 

         ....
         
         use Kit\IO\HTTP\KitCurl as KitCurl;            // optional
         
         
         $kitcurl -> cache_enabled(  KitCurl/KitCurlOptions::CACHE_DISABLED  );
         
         
         
** Working with the Kit\DB\Memcached backend **
         

         ....
        
         //flushing
         $kitcurl -> cache() -> flush();
         
         
         //advanced stuff 
         $kitcurl -> cache() -> backend() -> getStats(); 
         
         $kitcurl -> cache() -> backend() -> getServerList();
         
         


#### Generate More Documentation



         soap@codex:plugins/wp-kitcurl$ 
         
         soap@codex:plugins/wp-kitcurl$ ./bin/generate_phpdocs.sh
         
         
** If you require phpdoc to be installed **


         cd ./developer
         
         php ../bin/composer.phar install
         
         
