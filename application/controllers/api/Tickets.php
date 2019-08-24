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
class Tickets extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		//$this->load->library('mongo_db');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['v1_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['v1_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['v1_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function v1_get()
    {
		$ticket_id = $this->get("ticket_id"); 
		$circuit_id = $this->get("circuit_id"); 
		$dbconn3 = pg_connect("host=10.8.84.195 port=5433 dbname=CognosVerticaDB user=globe123 password=globe123!");
	
		if($ticket_id != null)
		{
			$result = pg_query($dbconn3, "SELECT * from MAXIMO.TICKET WHERE TICKETID='$ticket_id' LIMIT 1");
			if (!$result) {
			echo "An error occurred.\n";
			exit;
			}
			$result = pg_fetch_array($result, NULL, PGSQL_ASSOC);
			if(!$result)
			{
				$result = null;
			}
		}
		else if($circuit_id != null)
		{
			$result = pg_query($dbconn3, "SELECT TICKETID,REPORTDATE,STATUS from MAXIMO.TICKET WHERE CINUM='$circuit_id' ORDER BY REPORTDATE DESC LIMIT 5");
			if (!$result) {
			echo "An error occurred.\n";
			exit;
			}
			
			$return = array();
			while ($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)) {
				
				array_push($return,$row);
			}
			$rows_num_ticket = pg_num_rows($result);

			if($rows_num_ticket <= 0)
			{
				$return = null;
			}
			else
			{
				
				$result = $return;
			}
		}
		else
		{	
			$result = null;
		}
		
		//var_dump(pg_num_rows($result)); 
		
		$return = [ "message" => "Data", "data" => $result ];
		// Set the response and exit
		$this->response($return, REST_Controller::HTTP_OK); 
		
    }

    public function v1_post()
    {
        // $this->some_model->update_user( ... );
		$ticket_number = $this->post('ticket_number');
		$data = ["ticket_number" => $ticket_number , "date_created" => date("Y-m-d H:i:s A")];
		//var_dump();
		$value = $this->db->insert("tickets",$data);
		$return = [ "message" => "Ticket successfully saved." , "data" => $data];
        $this->set_response($return, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
	
	public function v1_put()
    {
    }

    public function v1_delete()
    {
    }

}
