<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->helper('LLC');
    }
}