<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }
}