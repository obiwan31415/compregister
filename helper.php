<?php
defined('_JEXEC') or die('Access denied');
//require(dirname(__FILE__).DS.'object.php');
class Computer {
	private $macaddress; //id
	private $compname;
	private $workgroup;
	private $wallsocket=" ";
	private $primarysystem=" ";
	private $secondarysystem=" ";
	private $comments=" "; //max 400

	private $firstname=" ";
	private $lastname=" ";
	private $email=" ";
	private $room=" ";
	private $phone=" ";

	public function getMACaddress() {
		return $this->macaddress;
	}
	public function getCompname() {
		return $this->compname;
	}
	public function getWorkgroup() {
		return $this->workgroup;
	}
	public function getWallSocket(){
		return $this->wallsocket;
	}
	public function getPrimarySystem(){
		return $this->primarysystem;
	}
	public function getSecondarySystem(){
		return $this->secondarysystem;
	}
	public function getComments(){
		return $this->comments;
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
	public function getPhone(){
		return $this->phone;
	}
	public function getFullName() {
		return $this->firstname.' '.$this->lastname;
	}
	public function setMACaddress($param) {
		$this->macaddress = $param;
	}
	public function setCompname($param) {
		$this->compname = $param;
	}
	public function setWorkgroup($param) {
		$this->workgroup = $param;
	}
	public function setWallSocket($wallsocket) {
		$this->wallsocket=$wallsocket;
	}
	public function setPrimarySystem($primarysystem) {
		$this->primarysystem=$primarysystem;
	}
	public function setSecondarySystem($secondarysystem) {
		$this->secondarysystem=$secondarysystem;
	}
	public function setComments($comments) {
		$this->comments=$comments;
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
	public function setPhone($phone) {
		$this->phone=$phone;
	}
}

class ModCompRegister {
	public static function saveData(Computer $computer, $params) {
		$db=JFactory::getDBO();
		$query="INSERT INTO `#__comp_register`(
				`macaddress`,
				`compname`,
				`workgroup`,
				`wallsocket`,
				`primarysystem`,
				`secondarysystem`,
				`comments`,
				`firstname`,
				`lastname`,
				`email`,
				`room`,
				`phone`
				) 
				VALUES ('"
				.$computer->getMACaddress()		."', '"
				.$computer->getCompname()		."', '"
				.$computer->getWorkgroup()		."', '"
				.$computer->getWallSocket()		."', '"
				.$computer->getPrimarySystem()	."', '"
				.$computer->getSecondarySystem()	."', '"
				.$computer->getComments()		."', '"
				.$computer->getFirstname()		."', '"
				.$computer->getLastname()		."', '"
				.$computer->getEmail()		."', '"
				.$computer->getRoom()		."', '"
				.$computer->getPhone()		."')"
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
		$body.="<span style=\"color:red;\">Username</span>: $username<br>";
		$body.="User Email: $useremail<br>";
		$body.="Comp Name: $compname<br>";
		$mailer->setBody($body);
		$mailer->isHTML(true);
		$mailer->send();
	}
}
?>