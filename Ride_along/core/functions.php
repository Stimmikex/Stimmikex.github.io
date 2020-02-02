<?php
class Users {
	public $table_name = 'users';

	private $db = null;
	
	function __construct($con) {
		$this->db = $con;
	}
	
	function checkUser($oauth_provider, $oauth_uid, $fname, $lname, $email, $gender, $locale, $picture) {
		$prev_query = $this->db->prepare("SELECT * FROM ".$this->table_name." WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") or die(mysql_error($this->db));
		$prev_query->execute();

		if($prev_query->rowCount() > 0) {
			$update = $this->db->prepare("UPDATE $this->table_name SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."', fname = '".$fname."', lname = '".$lname."', email = '".$email."', gender = '".$gender."', locale = '".$locale."', picture = '".$picture."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'");
			$update->execute();
			$update = null;
		} else {
			$insert = $this->db->prepare("INSERT INTO $this->table_name SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."', fname = '".$fname."', lname = '".$lname."', email = '".$email."', gender = '".$gender."', locale = '".$locale."', picture = '".$picture."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'");
			$insert->execute();
			$insert = null;
		}

		$prev_query = null;
		
		$query = $this->db->prepare("SELECT * FROM $this->table_name WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'");
		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);

		return $result;
	}
}
?>