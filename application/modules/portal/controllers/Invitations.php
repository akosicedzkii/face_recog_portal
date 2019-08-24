<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invitations extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/invitations_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_invitations()
	{
        $this->invitations_model->title = $this->input->post("title");
        $this->invitations_model->description = $this->input->post("description");
        $this->invitations_model->content = $this->input->post("content");
        $this->invitations_model->status = $this->input->post("status");
        $this->invitations_model->author = $this->input->post("author");
        $this->invitations_model->cover_image = $this->input->post("cover_image");
        $this->invitations_model->email_address = $this->input->post("email_address");
        $this->invitations_model->last_name = $this->input->post("last_name");
        $this->invitations_model->first_name = $this->input->post("first_name");
        $this->invitations_model->middle_name = $this->input->post("middle_name");
        $this->invitations_model->contact_number = $this->input->post("contact_number");
        $this->invitations_model->event_place = $this->input->post("event_place");
        $this->invitations_model->event_date = $this->input->post("event_date");
        $this->invitations_model->event_time = $this->input->post("event_time");
        $this->invitations_model->present = $this->input->post("present");
        $this->invitations_model->price = $this->input->post("price");
        $this->invitations_model->age = $this->input->post("age");
        $this->invitations_model->guest_email_address = $this->input->post("email_list");
        echo $this->invitations_model->insert_invitations();
	}

    public function email_content()
    {
        $this->load->view("main/email_content_view");
    }

	public function edit_invitations()
	{
        $invitations_id = $this->input->post("id");
        $this->invitations_model->cover_image = $this->input->post("cover_image");
        $this->invitations_model->title = $this->input->post("title");
        $this->invitations_model->description = $this->input->post("description");
        $this->invitations_model->content = $this->input->post("content");
        $this->invitations_model->status = $this->input->post("status");
        $this->invitations_model->author = $this->input->post("author");
        $this->invitations_model->email_address = $this->input->post("email_address");
        $this->invitations_model->last_name = $this->input->post("last_name");
        $this->invitations_model->first_name = $this->input->post("first_name");
        $this->invitations_model->middle_name = $this->input->post("middle_name");
        $this->invitations_model->contact_number = $this->input->post("contact_number");
        $this->invitations_model->event_place = $this->input->post("event_place");
        $this->invitations_model->event_date = $this->input->post("event_date");
        $this->invitations_model->event_time = $this->input->post("event_time");
        $this->invitations_model->present = $this->input->post("present");
        $this->invitations_model->price = $this->input->post("price");
        $this->invitations_model->guest_email_address = $this->input->post("email_list");
        $this->invitations_model->age = $this->input->post("age");
        $this->invitations_model->id = $invitations_id;
        echo $this->invitations_model->update_invitations();
	}

	public function delete_invitations()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        
        $data_invitations = $this->db->get("invitations");
        $this->db->where("id",$id);
        echo $result = $this->db->delete("invitations");
        $data = json_encode($data_invitations->row());
        $this->logs->log = "Deleted Updates - ID:". $data_invitations->row()->id .", Updates Title: ".$data_invitations->row()->title ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "invitations";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_invitations_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("invitations");
        $invitations = $result->row();
        if($invitations->cover_image != null)
        {
            if(is_numeric( $invitations->cover_image ))
            {
                $invitations->cover_image_id = $invitations->cover_image;
                $invitations->cover_image = $this->db->where("id",$invitations->cover_image)->get("media")->row()->file_name;
            }
        }
        $return["invitations"] = $invitations;
        echo json_encode($return); 
    }

    public function get_invitations_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t4.file_name as cover_image","IF(t1.status=1,'Enabled','Disabled') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.title","t4.file_name","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","title","cover_image","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "invitations AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.cover_image";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.content_type = 'invitations'";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/invitations/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    public function get_my_invitations_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.title","t4.file_name as cover_image","IF(t1.status=1,'Enabled','Disabled') as status","t1.date_created","t1.date_modified");  
        $this->dt_model->where  = array("t1.id","t1.title","t4.file_name","t1.status","t1.date_created","t1.date_modified");  
        $select_columns = array("id","title","cover_image","status","date_created","date_modified");  
        $this->dt_model->table = "invitations AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by LEFT JOIN media as t4 on t4.id = t1.cover_image";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.content_type = 'invitations' AND t1.created_by = ".$this->session->userdata("USERID");
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/invitations/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["title"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

}
