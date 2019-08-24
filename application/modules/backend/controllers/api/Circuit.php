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
class Circuit extends REST_Controller {

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
		$ci_num = $this->get("ci_num"); 
		/*$id = $this->get("formid");
		$version = $this->get("version");
		$from = "";
		if( $id != null)
		{
			//$data = ["_id" => new MongoId($id)];
			$data = ["form_id" => $id];
			if($version != null) 
			{
				$data = ["form_id" => $id, "version" => $version];
			}
			
			$sort = ["version" => "desc"];
			$value = $this->mongo_db->where($data)->order_by($sort)->get('tickets');
			$from = "-with_id";
		}
		else
		{
			//$value = $this->mongo_db->get('tickets');
			$value = $this->mongo_db->limit(2)->get('tickets');
			$from = "-no_id";
		}
		*/
		//$return = [ "message" => "Data".$from,"data" => $value ,"id" => $id ];
		$dbconn3 = pg_connect("host=10.8.84.195 port=5433 dbname=CognosVerticaDB user=globe123 password=globe123!");
		//simple check
		/*if($dbconn3)
		{
			var_dump($dbconn3);
		}*/
		if($ci_num != null)
		{
			$result = pg_query($dbconn3, "SELECT * from MAXIMO.CISPEC WHERE CINUM='$ci_num'");
			if (!$result) {
			echo "An error occurred.\n";
			exit;
			}
            
            $result_return = array();
            while($row = pg_fetch_assoc($result))
            {
                array_push($result_return,$row);
            }
			if(!$result)
			{
				$result_return = null;
			}
		}
		else
		{	
			$result_return = null;
		}
		
		//var_dump(pg_num_rows($result));
		
		$return = [ "message" => "Data", "data" => $result_return ];
		// Set the response and exit
		$this->response($return, REST_Controller::HTTP_OK); 
		
    }

    public function v1_post()
    {
        // $this->some_model->update_user( ... );
		//$ticket_number = $this->post('ticket_number');
		//$data = ["ticket_number" => $ticket_number , "date_created" => date("Y-m-d H:i:s A")];
		//var_dump();
        //$value = $this->db->insert("tickets",$data);
        $data = null;
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
