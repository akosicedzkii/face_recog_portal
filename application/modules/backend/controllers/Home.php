<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();  
    }
	public function index()
	{
		redirect(base_url("portal"));
	}
}
