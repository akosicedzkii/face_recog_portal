<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itouch_users extends CI_Controller {
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

	
    public function get_itouch_users_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.email","t1.fname","t1.lname","t1.division","t1.department","t1.tower","t2.active as status","t1.sdate");  
        $this->dt_model->where  = array("t1.id","t1.email","t1.fname","t1.lname","t1.division","t1.department","t1.tower","t2.active","t1.sdate");  
        $select_columns = array("id","email","fname","lname","division","department","tower","status","sdate");  
        $this->dt_model->table = "gbts.customer as t1 LEFT JOIN gbts.activation as t2 ON t2.ID = t1.id";  
        $this->dt_model->index_column = "t1.id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "email" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
					else if($col == "status")
					{
						if($aRow[$col] == "1")
						{
							$row[] = "Active";
						}else{
							$row[] = "Not Active";
						}
					}
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            //$btns = '<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>';
            //array_push($row,$btns);
            $output['data'][] = $row;
        }
        
        echo json_encode( $output );
    }
    public function get_log_details()
    {
        $this->db->where("id",$this->input->post("id"));
        $log = $this->db->get("itouch_users")->row();
        $this->db->where("id",$log->created_by);
        $username = $this->db->get("user_accounts")->row()->username;
        
        $this->db->where("user_id",$log->created_by);
        $profile = $this->db->get("user_profiles")->row();
        $log->created_by = str_replace("  "," ",$profile->first_name . " " . $profile->middle_name . " " . $profile->last_name). "(".$username.")" ;
        $data["log"] = $log;
        echo json_encode($data);
    }
    public function delete_all_itouch_users()
	{
        $action = $this->input->post("action");
        if($action == "delete")
        {
            echo $result = $this->db->truncate("itouch_users");
            $this->itouch_users->log = "Deleted All Logs" ;
            $this->itouch_users->created_by = $this->session->userdata("USERID");
            $this->itouch_users->insert_log();
        }
        
    }
    public function download()
    {
        $toDate = $this->input->get("toDate")." 23:59:59";
        $fromDate = $this->input->get("fromDate")." 00:00:00";
        $query = "SELECT t1.id,t1.sdate,t1.username FROM gbts.access_log as t1  WHERE t1.sdate >= '".$fromDate."' AND t1.sdate <='".$toDate."'";
        $itouch_users = $this->db->query($query)->result_array();
      
        // file name 
        $filename = 'itouch_users_'.date('YmdHis').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("ID","Log Date","Username"); 
        fputcsv($file, $header,"|");
        foreach ($itouch_users as $key=>$line){ 
            fputcsv($file,$line,"|"); 
        }
        fclose($file); 
        echo "<script>window.close();</script>";
        exit; 
    }
}
