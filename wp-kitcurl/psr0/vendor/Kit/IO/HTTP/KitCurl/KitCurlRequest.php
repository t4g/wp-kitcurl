<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl;


use Kit\IO\HTTP\Curl;
use Kit\IO\HTTP\KitCurl as KitParent;

class KitCurlRequest {

    const REQTYPE_GET  = FALSE;

    const REQTYPE_POST = TRUE;

    protected $_timeout_enabled = TRUE;

    protected $_timeout_value   = 5;

    protected $_uncached        = FALSE;

    protected $_expire_cache    = 600;

    private $_inst_caller       = null;

    private $_inst_responce     = null;

    private $_inst_pcurl        = null;

    private $url;

    private $reqtype;


    public function __construct(KitParent &$callee, $url, $reqtype = self::REQTYPE_GET)
    {

        $this->_inst_caller = $callee;
        $this->_inst_responce = new KitCurlResponce();
        $this->_inst_pcurl = new Curl();
        $this->url = $url;
        $this->reqtype = $reqtype;

    }



    public function execute()
    {
        $this->_inst_responce->start();

        if($this->_inst_caller->cache_enable() &&
        (FALSE !== ($data_array=$this->_inst_caller->cache()->get($this->url))))
        {
            $data=$data_array['data'];
            $head=$data_array['head'];
        }
        else
        {
            $this->_inst_pcurl->load($this->url);
            $data = $this->_inst_pcurl->getData();
            $head = $this->_inst_pcurl->getHeaders();
            if($this->_inst_caller->cache_enable())
            {
                $this->_inst_caller->cache()->set(
                    $this->url,
                    array(
                    'url'=>$this->url,
                    'header'=>$head,
                    'body'=>$data,
                    )
                );
            }
        }
        $this->_inst_responce->finish(
            KitCurlStatus::SUCCESS,
            $data,
            $head
        );

        return $this->_inst_responce;
    }



} 