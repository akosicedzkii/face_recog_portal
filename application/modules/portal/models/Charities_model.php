<?php

class Charities_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $cover_image;
        public $status;
        public $author;

        public function insert_charities()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["cover_image"] = $this->cover_image;
                $data["status"] = $this->status;
                $data["author"] = $this->author;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["content_type"] =  "charities";
                echo $result = $this->db->insert('charities', $data);
                unset($data["content"]);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->logs->log = "Created Charities - ID:". $insertId .", Charities Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "charities";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_charities()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["author"] = $this->author;
                if($this->cover_image != null)
                {
                     $data["cover_image"] = $this->cover_image;
                }
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('charities', $data);
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Charities - ID:". $this->id .", Charities Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "charities";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>