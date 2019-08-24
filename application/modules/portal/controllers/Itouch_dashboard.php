<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itouch_dashboard extends CI_Controller {
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

	public function access_log_per_month(){
		
		$conn = mysqli_connect('localhost','tgt25','globebusiness32','gbts');
		$year = $_POST['year'];
		
		for($i = 1; $i <= 12; $i++ ){

			$sql = "SELECT COUNT(sdate) as log_out_count from access_log where year(sdate)='$year' AND month(sdate) = $i";

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0){
				$rows = mysqli_fetch_assoc($result);
				$log_out[] = $rows;	
			}
			else{
				$log_out[] = 0;
			}

		}

		for($i = 1; $i <= 12; $i++ ){

			$sql = "SELECT COUNT(sdate) as log_in_count from access_log where year(sdate)='$year' AND month(sdate) = $i";

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0){
				$rows = mysqli_fetch_assoc($result);
				$log_in[] = $rows;	
			}
			else{
				$log_in[] = 0;
			}

		}

		for($i = 1; $i <= 12; $i++ ){

			$sql = "SELECT COUNT(sdate) as query_count from searches where year(sdate)='$year' AND month(sdate) = $i";

			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0){
				$rows = mysqli_fetch_assoc($result);
				$query_count[] = $rows;	
			}
			else{
				$query_count[] = 0;
			}

		}

			$data = array('log_out_count' => $log_out, 'log_in_count' => $log_in, 'query_count' => $query_count);

			echo(json_encode($data));

	}
	
	public function monthly_logs(){
				
		$conn = mysqli_connect('localhost','tgt25','globebusiness32','gbts');
				
		$year = $_POST['year'];
		$month = $_POST['month'];
		$day = $_POST['day'] + 1;
		// Converting month to number format
		if ($month == 'January') {
			$month = '01';
		}
		else if ($month == 'February') {
			$month = '02';
		}
		else if ($month == 'March') {
			$month = '03';
		}
		else if ($month == 'April') {
			$month = '04';
		}
		else if ($month == 'May') {
			$month = '05';
		}
		else if ($month == 'June') {
			$month = '06';
		}
		else if ($month == 'July') {
			$month = '07';
		}
		else if ($month == 'August') {
			$month = '08';
		}
		else if ($month == 'September') {
			$month = '09';
		}
		else if ($month == 'October') {
			$month = '10';
		}
		else if ($month == 'November') {
			$month = '11';
		}
		else if ($month == 'December') {
			$month = '12';
		}


		//---
		//-- Geting the ticket number
		for($i = 1; $i <= $day; $i++ ){

		$sql = "SELECT COUNT(sdate) as date from searches where month(sdate)= '$month' AND year(sdate)= '$year' AND day(sdate) = $i";

		$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0){
				$rows = mysqli_fetch_assoc($result);
				$ticket_search[] = $rows;	
			}
			else{
				$ticket_search[] = 0;
			}
		}


		//--getting the active user
		$sql = "SELECT DISTINCT username from access_log where month(sdate)= '$month' AND year(sdate)= '$year'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			while ( $rows = mysqli_fetch_assoc($result)) {
				$active_user[] = $rows;	
			}
		$count = count($active_user);
			
		}
		else{
		$count = 0;
		}

		//--getting the users per day
		for($i = 1; $i <= $day; $i++ ){

		$sql = "SELECT DISTINCT COUNT(username) as username from access_log where month(sdate)= '$month' AND year(sdate)= '$year' AND day(sdate) = $i";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_fetch_assoc($result);
			$user_per_day[] = $rows;	
		}
		else{
			$user_per_day[] = 0;
		}
		}
		//--getting the average user per day
		$sql = "SELECT COUNT(username) as username from access_log where month(sdate)= '$month' AND year(sdate)= '$year'";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_fetch_assoc($result);
			$average_user = $rows;
		}
		else{
			$average_user = 0;
		}

		//--getting the average ticket search
		$sql = "SELECT COUNT(id) as ticket from searches where month(sdate)= '$month' AND year(sdate)= '$year'";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_fetch_assoc($result);
			$average_ticket = $rows;
		}
		else{
			$average_ticket = 0;
		}

		//--storing all the values into an associative array
		$data = array('ticket_search' => $ticket_search,'active_user' => $count,'user_per_day' => $user_per_day, 'average_user' => $average_user, 'average_ticket' => $average_ticket);

		 echo(json_encode($data));

	}
}
