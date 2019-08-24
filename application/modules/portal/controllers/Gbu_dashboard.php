<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gbu_dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function daily_logs(){
		$year = $_POST['year'];
		$month = $_POST['month'];
		$day = $_POST['day'];
		$cmd = "curl 'https://10.244.3.218/gbu_dashboard/function_php/daily_logs.php?year=$year&month=$month&day=$day'";
		echo shell_exec("$cmd");

	}
	
	public function access_log_per_month(){
		$year = $_POST['year'];
		echo shell_exec("curl 'https://10.244.3.218/gbu_dashboard/function_php/access_log_per_month.php?year=$year'");

	}
}
