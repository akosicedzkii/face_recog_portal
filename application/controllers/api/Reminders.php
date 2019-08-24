<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Reminders extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		
		$this->load->database();
		//$this->load->library('mongo_db');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['v1_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['v1_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['v1_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function v1_get()
    {
		$viber_id = $this->get("viber_id"); 
		
		$status = $this->get("status"); 
		if($status == null){
			$status = 0;
		}
		$this->db->where("viber_id",$viber_id);
		$this->db->where("status",$status);
		$query = $this->db->get("reminders");
		
		//var_dump(pg_num_rows($result)); 
		$result = json_encode($query->result(),JSON_PRETTY_PRINT);
		//var_dump($result);
		$return = [ "message" => "Data", "data" => $result ];
		// Set the response and exit
		$this->response($return, REST_Controller::HTTP_OK); 
		
    }

    public function v1_post()
    {
        // $this->some_model->update_user( ... );
		$data["viber_id"] = $this->post('viber_id');
		$data["reminder_title"] = $this->post('reminder_title');
		$data["date_schedule"] = $this->post('date_schedule');
		$data["date_created"] =  date("Y-m-d H:i:s A");
		$data["status"] = 0;
		//var_dump();
		$this->db->insert("reminders",$data);
		$return = [ "message" => "Reminder successfully saved." , "data" => $data];
        $this->set_response($return, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
	
	public function v1_put()
    {
		$query = $this->db->query("SELECT * FROM reminders WHERE YEAR(date_schedule) = '".date("Y")."' AND MONTH(date_schedule) = '".date("m")."' AND DAY(date_schedule) = '".date("d")."'  AND HOUR(date_schedule) = '".date("H")."' AND MINUTE(date_schedule) = '".date("i")."' AND status = 0");
		
		if($query->result() != null){
			$data = json_encode($query->result());
		}else{
			$data = "No Reminder found";
		}
		$return = [ "message" => "PUT Data" , "data" => $data,"date" => date("Y-m-d H:i:s")];
        $this->set_response($return, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
		
    }

    public function v1_delete()
    {
		$data["status"] = 1;
		$data["id"] = $this->delete("id");
		$this->db->where("id",$this->delete("id"));
		$this->db->update("reminders",$data);
		$return = [ "message" => "DELETE Data" , "data" => $data,"date" => date("Y-m-d H:i:s")];
        $this->set_response($return, REST_Controller::HTTP_CREATED); 
    }

}
