<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Books extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Model_Books');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get()
    {
        $book = $this->Model_Books->Get();
        if (! is_null($book)) {
            $this->response(array('data' => $book), REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function find_get($id)
    {
        $book = $this->Model_Books->Get($id);
        if (! is_null($book)) {
            $this->response(array('data' => $book), REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_post()
    {
        if (! $this->post('book')) {
            $this->response(NULL,400);
        }
        $bookId = $this->Model_Books->Save($this->post('book'));
        if (! is_null($bookId)) {
            $this->response(array('data' => $bookId), REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_put($id)
    {
        if (! $this->put('book') || ! $id) {
            $this->response(NULL,400);
        }
        $update = $this->Model_Books->Update($id, $this->put('book'));
        if (! is_null($update)) {
            $this->response(array('data' => 'listo'), REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function index_delete($id)
    {
        if (! $id) {
            $this->response(NULL,400);
        }
        $delete = $this->Model_Books->Delete($id);
        if (! is_null($delete)) {
            $this->response(array('data' => 'listo'), REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
