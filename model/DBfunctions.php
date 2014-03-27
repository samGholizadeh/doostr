<?php
	include_once 'database.php';
	
	function online($user_id){
		global $db;
		$query = "UPDATE profiles SET online = 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_hashedpw($email){
		global $db;
		$query = "SELECT password FROM members WHERE email = :email";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$value = $statement->fetch();
		return $value['password'];
	}
	
	function validatelogin($email, $pw){
		global $db;
		$hashedpw = get_hashedpw($email);
		if(crypt($pw, $hashedpw) == $hashedpw){
			$query = "SELECT user_id, username FROM members WHERE email = :email AND password = :pw";
			$statement = $db->prepare($query);
			$statement->bindValue(':email', $email);
			$statement->bindValue(':pw', $hashedpw);
			$statement->execute();
			$valid = $statement->fetch();
			$statement->closeCursor();
			return $valid;
		} else {
			return false;
		}
	}
	
	function add_user($username, $pw, $email, $ip){
		global $db;
		$Salt = generate_salt();
		$Algo = '6';
		$Rounds = '5000';
		$CryptSalt = '$' . $Algo . '$rounds=' . $Rounds . '$' . $Salt; 
		$hashedpw = crypt($pw, $CryptSalt);
		$query = "INSERT INTO members(username, password, email, ip) VALUES(:username, :hashedpw, :email, :ip)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':hashedpw', $hashedpw);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':ip', $ip);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM members";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function generate_salt() {
		$dummy = array_merge(range('0', '9'));
		mt_srand((double)microtime()*1000000);
		for ($i = 1; $i <= (count($dummy)*2); $i++)
		{	
			$swap = mt_rand(0,count($dummy)-1);
			$tmp = $dummy[$swap];
			$dummy[$swap] = $dummy[0];
			$dummy[0] = $tmp;
		}
		return sha1(substr(implode('',$dummy),0,9));
	}
	
	function DoubleSaltedHash($pw, $salt) {
		return sha1($salt.sha1($salt.sha1($pw)));
	}
	
	function checkUsername($username){
		global $db;
		$query = "SELECT * FROM members WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		return $statement->rowCount();
	}
	
	function checkEmail($email){
		global $db;
		$query = "SELECT * FROM members WHERE email = :email";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		return $statement->rowCount();
	}
	
	function insertStatement($statement){
		global $db;
		$statement = $db->prepare($statement);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	}
	
	function insertUser($username, $text, $skype, $country, $city, $lastname, $name){
		global $db;
		$query = "INSERT INTO profiles(username, text, skype, country, city, name, lastname)
			VALUES(:username, :text, :skype, :country, :city, :lastname, :name)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':text', $text);
		$statement->bindValue(':skype', $skype);
		$statement->bindValue(':country', $country);
		$statement->bindValue(':city', $city);
		$statement->bindValue(':lastname', $lastname);
		$statement->bindValue(':name', $name);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function execStatement($statement){
		global $db;
		$statement = $db->prepare($statement);
		$result = $statement->execute();
		return $result;
	}
	
	function fetch($statement){
		global $db;
		$statement = $db->prepare($statement);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function get_current_ip() {
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER) === true) {
				foreach (explode(',', $_SERVER[$key]) as $ip) {
					if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
						return $ip;
					}
				}
			}
		}
	}
	
	function get_stored_ip($username){
		global $db;
		$query = "SELECT ip FROM members WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_ip($ip, $user_id){
		global $db;
		$query = "UPDATE members SET ip = :value WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':value', $ip);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}

	function sanitizeString($str){
		$str = stripslashes($str);
		$str = htmlentities($str);
		$str = strip_tags($str);
		return $str;
	}
	
	function offline($user_id){
		$time = date("Y-m-d H:i:s");
		global $db;
		$query = "UPDATE profiles SET online = 0, timestamp = :time WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':time', $time);
		$statement->execute();
		$statement->closeCursor();
	}
?>