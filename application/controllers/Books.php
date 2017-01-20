<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Books extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

	public function index_get()
	{
		echo 1;
	}
	public function find_get($id)
	{
		$this->load->view('welcome_message');
	}
	public function index_post()
	{
		$this->load->view('welcome_message');
	}
	public function index_put($id)
	{
		$this->load->view('welcome_message');
	}
	public function index_delete($id)
	{
		$this->load->view('welcome_message');
	}
}
