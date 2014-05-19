<?php
require_once("Rest.inc.php");
require("Pusher.php");

class API extends REST
{
	// This is the API, 2 possibilities: show the app list or show a specific app by id.
	// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

	const DB_SERVER = "mysql.side.buzz";
	const DB_USER = "sidebuzz_dbuser";
	const DB_PASSWORD = "S1d3Buzz";
	const DB = "sidebuzzdb";
	
	const PUSHER_KEY = "8db2fa907ed05e0b68f6";
	const PUSHER_SECRET = "def43b3e6ca7269a526d";
	const PUSHER_APP_ID = "75277";

	private $db = NULL;

	public function __construct()
	{
		parent::__construct();// Init parent contructor
		$this->dbConnect();// Initiate Database connection
	}

	//Database connection
	private function dbConnect()
	{
		$this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
		if($this->db)
		mysql_select_db(self::DB,$this->db);
	}
	
	private function get_current_push_by_eventid($eventId)
	{
		$sql = mysql_query("SELECT e.CurrentPushID, ep.URL FROM Event e INNER JOIN EventPush ep ON e.CurrentPushID = ep.EventPushID WHERE e.EventID = ".$eventId, $this->db);
		
		if(mysql_num_rows($sql) > 0)
		{
			$result = array();
			while($rlt = mysql_fetch_array($sql,MYSQL_ASSOC))
			{
				$result[] = $rlt;
			}
			
			return $result;
		}
		//$this->response('',204); // If no records "No Content" status
		$result = array();
		
		return $result;
	}
	
	private function set_current_push($eventId, $eventPushId)
	{	
		$URL = "";
		
		$sql = mysql_query("UPDATE Event SET CurrentPushID=".$eventPushId." WHERE EventID=".$eventId, $this->db);
		$sql = mysql_query("SELECT e.CurrentPushID, ep.URL FROM Event e INNER JOIN EventPush ep ON e.CurrentPushID = ep.EventPushID WHERE e.EventID = ".$eventId, $this->db);
		
		$URL = mysql_result($sql,0,"URL");
		
		$pusher = new Pusher(self::PUSHER_KEY, self::PUSHER_SECRET, self::PUSHER_APP_ID);
		$pusher->trigger('my-channel', 'my-event', array('URL' => $URL) );
		
		return;
	}

	private function get_app_by_id($id)
	{
	  $app_info = array();

	  // normally this info would be pulled from a database.
	  // build JSON array.
	  switch ($id){
		case 1:
		  $app_info = array("app_name" => "Web Demo", "app_price" => "Free", "app_version" => "2.0"); 
		  break;
		case 2:
		  $app_info = array("app_name" => "Audio Countdown", "app_price" => "Free", "app_version" => "1.1");
		  break;
		case 3:
		  $app_info = array("app_name" => "The Tab Key", "app_price" => "Free", "app_version" => "1.2");
		  break;
		case 4:
		  $app_info = array("app_name" => "Music Sleep Timer", "app_price" => "Free", "app_version" => "1.9");
		  break;
	  }

	  return $app_info;
	}

	private function get_app_list()
	{
	  //normally this info would be pulled from a database.
	  //build JSON array
	  $app_list = array(array("id" => 1, "name" => "Web Demo"), array("id" => 2, "name" => "Audio Countdown"), array("id" => 3, "name" => "The Tab Key"), array("id" => 4, "name" => "Music Sleep Timer")); 

	  return $app_list;
	}

	public function processApi() {
	
		$possible_url = array("get_app_list", "get_app", "get_current_push_by_eventid", "set_current_push");

		$value = "An error has occurred";

		if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
		{
		  switch ($_GET["action"])
			{
			  case "get_current_push_by_eventid":
				if (isset($_GET["id"]))
					$value = $this->get_current_push_by_eventid($_GET["id"]);
				else
				  $value = "Missing argument";
				break;
			  case "set_current_push":
				if (isset($_GET["eventid"]) && (isset($_GET["eventpushid"])))
					$value = $this->set_current_push($_GET["eventid"], $_GET["eventpushid"]);
				else
				  $value = "Missing argument";
			  case "get_app_list":
				$value = $this->get_app_list();
				break;
			  case "get_app":
				if (isset($_GET["id"]))
				  $value = $this->get_app_by_id($_GET["id"]);
				else
				  $value = "Missing argument";
				break;
			}
		}
		
		//return JSON array
		exit(json_encode($value));
	}
}

$api = new API;
$api->processApi();
?>