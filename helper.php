<?php
defined('_JEXEC') or die('Access denied');
class Computer {
	private $macaddress; //id
	private $firstname;
	private $lastname;
	private $email;
	private $room;
	private $fixedIP;
	private $comment;

	public function getMACaddress() {
		return $this->macaddress;
	}
	public function getFirstname(){
		return $this->firstname;
	}
	public function getLastname(){
		return $this->lastname;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getRoom(){
		return $this->room;
	}
	public function getFixedIP(){
		return $this->fixedIP;
	}
	public function getComment(){
		return $this->comment;
	}
	public function setMACaddress($mac) {
		$this->macaddress = $this->convertToMAC($mac);	
	}
	public function setFirstname($firstname) {
		$this->firstname=$firstname;
	}
	public function setLastname($lastname) {
		$this->lastname=$lastname;
	}
	public function setEmail($email) {
		$this->email=$email;
	}
	public function setRoom($room) {
		$this->room=$room;
	}
	public function setFixedIP($fixedIP) {
		$this->fixedIP=$fixedIP;
	}
	public function setComment($comment) {
		$this->comment=$comment;
	}
	private function convertToMAC($input) {
		$pattern="/^([0-9a-fA-F]{2}[:-]){5}([0-9a-fA-F]{2})$/";
		if(preg_match($pattern,$input) == 1) {
			$chars = explode("-", $input);
		} else { //$pattern =  "/^[0-9a-fA-F]{12}$/"
			$chars = str_split($input, 2);
		}
		$result = implode(":", $chars);
		return strtolower($result);
	}
}

class ModCompRegister {
	public static function saveData(Computer $computer, $params) {
		$db=JFactory::getDBO();
		$query="INSERT INTO `#__comp_register`(
				`macaddress`,
				`firstname`,
				`lastname`,
				`email`,
				`room`,
				`fixedip`,
				`comment`
				) 
				VALUES ('"
				.$computer->getMACaddress()		."', '"
				.$computer->getFirstname()		."', '"
				.$computer->getLastname()		."', '"
				.$computer->getEmail()			."', '"
				.$computer->getRoom()			."', '"
				.$computer->getFixedIP()		."', '"
				.$computer->getComment()		."')"
		;

		$db->setQuery($query);
		if($db->query()) {
			//self::sendEmailNotification($username,$useremail,$compname,$params);
			return true;
		}else{
			return false;
		}
	}

	public static function sendEmailNotification($computer,$params) {
		$mailer=JFactory::getMailer();
		//$config=JFactory::getConfig();
		$sender=array($params->get('sender_email'),$params->get('sender_name'));
		$mailer->setSender($sender);
		$mailer->addRecipient($params->get('receiver_email'));
		$mailer->setSubject("New Contact Form Submitted");
		$body="<h3>A new computer reqistration form was sent.</h3><br />";
		$body.="MAC: ".$computer->getMACaddress()."<br>";
		$body.="Fixed IP: ".$computer->getFixedIP()."<br>";
		$body.="<span style=\"color:red;\">Username</span>:" 
			.$computer->getLastname()." ".$computer->getFirstname()."<br>";
		$body.="User Email: ".$computer->getEmail()."<br>";
		$mailer->setBody($body);
		$mailer->isHTML(true);
		$mailer->send();
	}
}


?>