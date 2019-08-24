<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itouch_search_logs extends CI_Controller {
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

	
    public function get_itouch_search_logs_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.sdate","t1.refno","t1.email","t1.description");  
        $this->dt_model->where  = array("t1.id","t1.sdate","t1.refno","t1.email","t1.description");  
        $select_columns = array("id","sdate","refno","email","description");  
        $this->dt_model->table = "gbts.searches as t1";  
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
        $log = $this->db->get("itouch_logs")->row();
        $this->db->where("id",$log->created_by);
        $username = $this->db->get("user_accounts")->row()->username;
        
        $this->db->where("user_id",$log->created_by);
        $profile = $this->db->get("user_profiles")->row();
        $log->created_by = str_replace("  "," ",$profile->first_name . " " . $profile->middle_name . " " . $profile->last_name). "(".$username.")" ;
        $data["log"] = $log;
        echo json_encode($data);
    }
    public function delete_all_itouch_logs()
	{
        $action = $this->input->post("action");
        if($action == "delete")
        {
            echo $result = $this->db->truncate("itouch_logs");
            $this->itouch_logs->log = "Deleted All Logs" ;
            $this->itouch_logs->created_by = $this->session->userdata("USERID");
            $this->itouch_logs->insert_log();
        }
        
    }
    public function download()
    {
        $toDate = $this->input->get("toDate")." 23:59:59";
        $fromDate = $this->input->get("fromDate")." 00:00:00";
        $query = "SELECT t1.id,t1.sdate,t1.refno,t1.email,t1.description FROM gbts.searches as t1  WHERE t1.sdate >= '".$fromDate."' AND t1.sdate <='".$toDate."'";
        $itouch_logs = $this->db->query($query)->result_array();
      
        // file name 
        $filename = 'itouch_search_logs_'.date('YmdHis').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        // file creation 
        $file = fopen('php://output', 'w');
        
        $header = array("ID","Date","Ticket #","Username","Description"); 
        fputcsv($file, $header,"|");
        foreach ($itouch_logs as $key=>$line){ 
            fputcsv($file,$line,"|"); 
        }
        fclose($file); 
        echo "<script>window.close();</script>";
        exit; 
    }
}
