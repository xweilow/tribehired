<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
    }
    
    public function getRealIpAddr(){
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
            $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
    
    public function success($data) {
        echo json_encode(array('status' => 1, 'data' => $data), JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function fail($data) {
        echo json_encode(array('status' => -1, 'data' => $data), JSON_UNESCAPED_UNICODE);
        die();
    }
}