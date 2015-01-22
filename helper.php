<?php
defined('_JEXEC') or die('Access denied');
class Computer {
	public $macaddress; //id
	public $firstname;
	public $lastname;
	public $email;
	public $room;
	public $fixedIP;
	public $comment;
}

class ModCompRegister {
	public static function saveData($computer) {
		$result = JFactory::getDbo()->insertObject('#__comp_register', $computer);	
		return $result;
	}

	public static function findMAC($mac) {
		$db=JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('COUNT(*)')
			->from($db->quoteName('#__comp_register'))
			->where($db->quoteName('macaddress') . "=" . '"'.$mac.'"');
		$db->setQuery($query);
		$count = $db->loadResult();
		if($count==0) {
			return false;
		} else {
			return true;
		}
	}

	public static function convertToMAC($input) {
	    $pattern1="/^([0-9a-fA-F]{2}[-]){5}([0-9a-fA-F]{2})$/";
	    $pattern2="/^([0-9a-fA-F]{2}[:]){5}([0-9a-fA-F]{2})$/";
	    if(preg_match($pattern1,$input) == 1) {
	        $chars = explode("-", $input);
	    } else if(preg_match($pattern2,$input) == 1) {
	        $chars = explode(":", $input);
	    } else {                                //$pattern =  "/^[0-9a-fA-F]{12}$/"
	        $chars = str_split($input, 2);
	    }
	    $result = implode(":", $chars);
	    return strtolower($result);
	}

	public static function sendEmailNotification($computer,$params) {
		$mailer=JFactory::getMailer();
		$config=JFactory::getConfig();
		$sender=array($params->get('sender_email'),$params->get('sender_name'));
		$mailer->setSender($sender);
		$mailer->addRecipient($params->get('receiver_email'));
		$mailer->setSubject("Nowy formularz rejestracji komputera.");
		
		$body="<h3>Przysłano nowy formularz rejestracji:</h3><br />";
		$body.="Czas rejestracji: ".date("Y-m-d H:i:s")."<br />";
		$body.="Adres MAC: ".$computer->getMACaddress()."<br />";
		$body.="Stały IP: ".$computer->getFixedIP()."<br />";
		$body.="Użytkownik: ".$computer->getLastname()." ".$computer->getFirstname()."<br />";
		$body.="Email użytkownika: ".$computer->getEmail()."@ippt.pan.pl<br />";
		$body.="Miejsce podłączenia: pokój ".$computer->getRoom()."<br />";
		$body.="Uwagi: ".$computer->getComment()."<br />";
		$body.="<br />";
		$body.="<h3>Wpis do <em>dhcp.conf:</em></h3><br />";
		$body.="<br />";
		$body.="# ".date("d.m.Y")."; ".$computer->getFirstname()." ".$computer->getLastname()
			."; p".$computer->getRoom()."<br />";
		$body.="host "."komp".date("YmdHis")." { hardware ethernet ".$computer->getMACaddress();
		/*if($computer->getFixedIP() == "yes") {
			$body.="; fixed-address 0.0.0.0";
		}*/
		$body.="; }";
		$body.="<br />";

		$mailer->setBody($body);
		$mailer->isHTML(true);
		$mailer->send();
	}
}


?>