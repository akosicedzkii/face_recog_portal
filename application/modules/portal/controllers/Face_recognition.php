<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Face_recognition extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/users_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_class()
	{
		$edit_id = $this->input->post("edit_id");
		if($edit_id == null)
		{
			$class_name = $this->input->post("class_name");
			$data["class_name"] = $class_name;
			$data["date_created"] = date("Y-m-d H:i:s A");
			$data["created_by"] = $this->session->userdata("USERID");
			$this->db->insert("face_classes",$data);
			$insertId = $this->db->insert_id();
			$filename = $_FILES['inputImage']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$folder = "/var/www/html/uploads/dataset/".$insertId;
			$location = $folder."/".$insertId.".1".".".$ext;
			$data2["filename"] = $insertId.".1".".".$ext;
			
			$branch_store = $this->input->post("branch_store");
			$case_number = $this->input->post("case_number");
			$class_name = $this->input->post("class_name");
			$data2["class_name"] = $class_name;
			$data2["branch_store"] = $branch_store;
			$data2["case_number"] = $case_number;
			$data2["face_id"] = $insertId;
			$data2["date_created"] = date("Y-m-d H:i:s A");
			$data2["created_by"] = $this->session->userdata("USERID");
			$this->db->insert("face_images",$data2);
			mkdir($folder);
			$uploadOk = 1;
			$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

			/* Valid Extensions */
			$valid_extensions = array("jpg","jpeg","png");
			/* Check file extension */ 
			if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
			   $uploadOk = 0;
			}

			if($uploadOk == 0){
			   echo 0;
			}else{
			   /* Upload file */

			   if(@move_uploaded_file($_FILES['inputImage']['tmp_name'],$location)){
				   
				  echo 1;
			   }else{
				  echo 0;
			   }
			}
		}else{
			$insertId = $edit_id;
			$filename = $_FILES['inputImage']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$folder = "/var/www/html/uploads/dataset/".$insertId;
			
			$fi = new FilesystemIterator($location, FilesystemIterator::SKIP_DOTS);
			$count = iterator_count($fi) + 1;
			$location = $folder."/".$insertId.".$count".".".$ext;
			$data2["filename"] = $insertId.".$count".".".$ext;
			$branch_store = $this->input->post("branch_store");
			$case_number = $this->input->post("case_number");
			$class_name = $this->input->post("class_name");
			$data2["class_name"] = $class_name;
			$data2["branch_store"] = $branch_store;
			$data2["case_number"] = $case_number;
			$data2["face_id"] = $insertId;
			$data2["date_created"] = date("Y-m-d H:i:s A");
			$data2["created_by"] = $this->session->userdata("USERID");
			$this->db->insert("face_images",$data2);
			//mkdir($folder);
			$uploadOk = 1;
			$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

			/* Valid Extensions */
			$valid_extensions = array("jpg","jpeg","png");
			/* Check file extension */ 
			if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
			   $uploadOk = 0;
			}

			if($uploadOk == 0){
			   echo 0;
			}else{
			   /* Upload file */

			   if(@move_uploaded_file($_FILES['inputImage']['tmp_name'],$location)){
				   
				  echo 1;
			   }else{
				  echo 0;
			   }
			}
		}
	}

	public function train()
	{
        $output = exec("bash /var/www/html/py/sample.sh");
        echo $output;
	}

	public function tag_fraud()
	{
		$this->db->where("id",$this->input->post("edit_id"));
		$data["is_fraud"] = 1;
		echo $this->db->update("face_classes",$data);
		
	}

	public function untag_fraud()
	{
		$this->db->where("id",$this->input->post("edit_id"));
		$data["is_fraud"] = 0;
		echo $this->db->update("face_classes",$data);
		
	}
	public function identify()
	{
        /* Getting file name */
        $filename = $_FILES['inputImage']['name'];

        /* Location */

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
		$datatime = gettimeofday();
        $location = "/var/www/html/uploads/temp/"."Test".$datatime["sec"].".".$ext;
		$file_name = "Test".$datatime["sec"].".".$ext;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
           $uploadOk = 0;
        }

        if($uploadOk == 0){
           echo 0;
        }else{
           /* Upload file */

           if(@move_uploaded_file($_FILES['inputImage']['tmp_name'],$location)){
			  $output = exec("bash /var/www/html/py/identify.sh  $file_name");
              //echo $output;
			  if($output != "unknown")
			  {
				  $this->db->where("face_id",$output);
				  $result = $this->db->get("face_images");
				  $res["result"] = $result->result();
				  $this->db->where("id",$output);
				  $result2 = $this->db->get("face_classes");
				  $res["is_fraud"] = $result2->row()->is_fraud;
				  echo json_encode($res);
			  }else{
				  echo $output;
			  }
			  
			  unlink($location);
           }else{
              echo 0;
           }
        }
	}
    public function get_face_recognition_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","class_name","t1.date_created","username");  
        $this->dt_model->where  = array("t1.id","class_name","t1.date_created","username");  
        $select_columns = array("id","class_name","date_created","username");  
        $this->dt_model->table = "face_classes as t1 LEFT JOIN user_accounts as t2 ON t2.id = t1.created_by";  
        $this->dt_model->index_column = "id";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by" )
                    {
                        $row[] = $aRow[$col];
                    }
					else if($col == "filename" )
                    {
						
                        $row[] = $btns = '<img style="max-height:100px;" src="'.base_url("uploads/dataset/").$aRow['id'].'/'.$aRow['filename'].'">';;
                    }
					
                    else if($col == "status")
                    {
                        if($aRow[$col] == 0)
                        {
                            $row[] = "Disabled";
                        }
                        else if($aRow[$col] == 1)
                        {
                            $row[] = "Enabled";
                        }
                        else if($aRow[$col] == 2)
                        {
                            $row[] = "Unverified";
                        }
                    }
                    else
                    {
                        $row[] = ucfirst( $aRow[$col] );
                    }
            }
            /*if($aRow['username'] != "portal")
            {
                if($aRow['username'] != $this->session->userdata("USERNM"))
                {  
                    $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
                    <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                    <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['username'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
                    
                }
            }*/
			
            $btns = '<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
                    <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                    <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['id'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
            /*if($aRow['username'] != "portal")
            {
                if($aRow['username'] != $this->session->userdata("USERNM"))
                {  
                    $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>-->
                    <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                    <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow['username'].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>';
                    
                }
            }*/
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }

    
}
