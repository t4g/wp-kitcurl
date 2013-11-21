wp-kitcurl
=============

##Introduction
wp-kitcurl is a WordPress implementation of the Kit-KitCurl project. 

This project exposes the following **namespaces** for use in your custom plugins and themes:
* Kit\IO\HTTP\KitCurl
* Kit\DB\Memcached
* WPKit\KitCurl

### About KitCurl
KitCurl is a cURL based proxy service for loading external resources server side (for the times you just forced to).
Why KitCurl over cURL or fopen?
 * Written for server proformance and stablity.
 * Composer.phar driven
 * Modern PSR-0 coding pattern
 * Access to rationalised cURL configuration, like sane timeouts.
 * Memcached support with transparent failover for easiler development installs.
 * Support for mutliple memcached servers with failover and loadbalancing.
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
         
         $responce = $request -> execute();
         
         
    ** OOP **
         
         $kitcurl = new Kit\IO\HTTP\KitCurl();
         
         echo $kitcurl -> new_http_rawget(<url>) -> set_timeout(3) -> execute();
         
         
    ** STATIC OOP **
         
         use Kit\IO\HTTP as Kit
         
         echo Kit\KitCurlSingleton() -> new_http_rawget(<url>) -> set_timeout(3) -> execute();
         
         
    ** The responce **
         
         // get contents
         $mycontents = $responce;     // or echo $responce; etc etc
         
         // explore the responce
         echo $responce->getSize();   // total size of the doc
         
         if( $responce->getIsViaCached() ){ echo "Bingo" }   // total size of the doc


A short description of the motivation behind the creation and maintenance of the project. This should explain **why** the project exists.



##Variables
###Template Syntax
The most basic example looks like this:

	{$name}

If {$name} doesn't contain any value, null is returned. It's also possible to use a dot as a separator.

	{$foo.bar}

