<?php
/**
 * Created by PhpStorm.
 * User: soap
 * Date: 05/12/2013
 * Time: 01:03
 */

namespace Kit\IO\HTTP\KitCurl;


class KitCurlResponce {


    protected $_data          = "";

    protected $_headers       = FALSE;

    protected $_status        = KitCurlStatus::PRISTINE;

    protected $_path          = null;

    private $_iscached          = null;

    private $_stat_size       = null;

    private $_stat_microtime_start  = null;

    private $_stat_microtime_total  = null;



    public function __construct()
    {

        $this->_stat_microtime_start = microtime(TRUE);

    }



    public function __toString()
    {
        if( $this-> _status === KitCurlStatus::SUCCESS )
        {
            return $this->_data;
        }
        return FALSE;
    }


    public function getSize()
    {
        if($this->_status !== KitCurlStatus::SUCCESS) return 0;
        if($this->_stat_size===null) $this->_stat_size = strlen($this->_data);
        return $this->_stat_size;
    }

    private function _setTimer()
    {
        $this->_stat_microtime_total = microtime(TRUE) - $this->_stat_microtime_start;
    }

    /**
     * @return string
     */
    public function getData()
    {
        if( $this->_status === KitCurlStatus::SUCCESS)
            return $this->_data;
        return FALSE;
    }

    public function start(){
        $this->_setStatus(KitCurlStatus::ACTIVE);
    }

    /**
     * @param KitCurlStatus $status
     * @param string        $data
     * @param null          $headers
     */
    public function finish($status,$data="",$headers=NULL)
    {
        $this->_setTimer();
        $this->_setStatus($status);
        $this->_setData($data);
        $this->_headers=$headers;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param int|\Kit\IO\HTTP\KitCurl\KitCurlStatus $status
     */
    private function _setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @param int $data
     */
    private function _setData($data)
    {
        $this->_data = $data;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param null $path
     */
    public function setPath($path)
    {
        $this->_path = $path;
    }

    /**
     * @return null
     */
    public function getIsViaCached()
    {
        return $this->_iscached;
    }

    /**
     * @param null $iscached
     */
    public function setIsCached($iscached)
    {
        $this->_iscached = (bool) $iscached;
    }


    /**
     * @return boolean
     */
    public function getHeaders()
    {
        return $this->_headers;
    }


} 