<?php

class Icd_ticket_model extends CI_Model {
    
        public $id;
        public $title;
        public $description;
        public $content;
        public $cover_image;
        public $status;
        public $author;
        public $email_address;
        public $last_name;
        public $first_name;
        public $middle_name;
        public $contact_number;
        public $event_place;
        public $event_date;
        public $event_time;
        public $age;
        public $price;
        public $present;
        public $guest_email_address;

        public function insert_invitations()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_created"] = date("Y-m-d H:i:s A");
                $data["cover_image"] = $this->cover_image;
                $data["status"] = $this->status;
                $data["author"] = $this->author;
                $data["created_by"] =  $this->session->userdata("USERID");
                $data["content_type"] =  "invitations";
                
                $data["email_address"] = $this->email_address;
                $data["last_name"] = $this->last_name;
                $data["first_name"] = $this->first_name;
                $data["middle_name"] = $this->middle_name;
                $data["contact_number"] = $this->contact_number;
                $data["event_place"] = $this->event_place;
                $data["event_date"] = $this->event_date;
                $data["event_time"] = $this->event_time;
                $data["age"] = $this->age;
                $data["present"] = $this->present;
                $data["price"] = $this->price;
                $data["guest_email_address"] = $this->guest_email_address;
                
                echo $result = $this->db->insert('invitations', $data);
                unset($data["content"]);
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);

                $email_queue["message"] = $this->content;
                $email_queue["subject"] = $this->title;
                $email_queue["invitation_id"] =  $insertId ;
                $email_queue["status"] =  0 ;
                $email_list = explode(",",rtrim($this->guest_email_address,","));
                foreach($email_list as $emailing)
                {
                        $email_queue["email_address"] = $emailing;
                        $this->db->insert("email_queue",$email_queue);
                        
                }
                $email_queues = $this->db->where("invitation_id",$insertId)->order_by("ID","ASC")->get("email_queue")->result();
              
                foreach($email_queues as $email_queue)
                {
                    $to = $email_queue->email_address;
                    $body = $email_queue->message;
                    $body = urlencode($this->load->view("main/email_content_view","",true));
                    $subject = $email_queue->subject;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,base_url("emailer/send_email.php"));
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,"to=$to&body=$body&subject=$subject&attachment=");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                    $server_output = curl_exec ($ch);
            
                    curl_close ($ch);
                    $this->db->where("id",$email_queue->id);
                    $data2["status"] = "1";
                    $this->db->update("email_queue",$data2);
                }
                $this->logs->log = "Created Invitations - ID:". $insertId .", Invitations Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "invitations";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }

        public function update_invitations()
        {
                $data["title"] = $this->title ; 
                $data["description"] = $this->description;
                $data["content"] = $this->content;
                $data["date_modified"] = date("Y-m-d H:i:s A");
                $data["author"] = $this->author;
                $data["email_address"] = $this->email_address;
                $data["last_name"] = $this->last_name;
                $data["first_name"] = $this->first_name;
                $data["middle_name"] = $this->middle_name;
                $data["contact_number"] = $this->contact_number;
                $data["event_place"] = $this->event_place;
                $data["event_date"] = $this->event_date;
                $data["event_time"] = $this->event_time;
                $data["age"] = $this->age;
                $data["present"] = $this->present;
                $data["price"] = $this->price;
                $data["guest_email_address"] = $this->guest_email_address;
                if($this->cover_image != null)
                {
                     $data["cover_image"] = $this->cover_image;
                }
                $data["status"] = $this->status;
                $data["modified_by"] =  $this->session->userdata("USERID");
                $this->db->where("id",$this->id);
                echo $result = $this->db->update('invitations', $data);
                
                $data["id"] = $this->id;
                $data = json_encode($data);
                $this->logs->log = "Updated Invitations - ID:". $this->id .", Invitations Title: ".$this->title ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "invitations";

                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();

        }

}

?>