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
	    $pattern1='/^([0-9a-fA-F]{2}[-]){5}([0-9a-fA-F]{2})$/';
	    $pattern2='/^([0-9a-fA-F]{2}[:]){5}([0-9a-fA-F]{2})$/';
	    if(preg_match($pattern1,$input) == 1) {
	        $chars = explode('-', $input);
	    } else if(preg_match($pattern2,$input) == 1) {
	        $chars = explode(':', $input);
	    } else {                                //$pattern =  '/^[0-9a-fA-F]{12}$/'
	        $chars = str_split($input, 2);
	    }
	    $result = implode(':', $chars);
	    return strtolower($result);
	}

	public static function clearPL($input) {
		$pl = array('ą','ć','ę','ł','ń','ó','ś','ź','ż','Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż');
		$nopl = array('a','c','e','l','n','o','s','z','z','A','C','E','L','N','O','S','Z','Z');
		return str_replace($pl, $nopl, $input);
	}

	function noPL($tekst) {
		$tabela = Array(
		//WIN
		"\xb9" => "a", "\xa5" => "A", "\xe6" => "c", "\xc6" => "C",
		"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
		"\xf3" => "o", "\xd3" => "O", "\x9c" => "s", "\x8c" => "S",
		"\x9f" => "z", "\xaf" => "Z", "\xbf" => "z", "\xac" => "Z",
		"\xf1" => "n", "\xd1" => "N",
		//UTF
		"\xc4\x85" => "a", "\xc4\x84" => "A", "\xc4\x87" => "c", "\xc4\x86" => "C",
		"\xc4\x99" => "e", "\xc4\x98" => "E", "\xc5\x82" => "l", "\xc5\x81" => "L",
		"\xc3\xb3" => "o", "\xc3\x93" => "O", "\xc5\x9b" => "s", "\xc5\x9a" => "S",
		"\xc5\xbc" => "z", "\xc5\xbb" => "Z", "\xc5\xba" => "z", "\xc5\xb9" => "Z",
		"\xc5\x84" => "n", "\xc5\x83" => "N",
		//ISO
		"\xb1" => "a", "\xa1" => "A", "\xe6" => "c", "\xc6" => "C",
		"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
		"\xf3" => "o", "\xd3" => "O", "\xb6" => "s", "\xa6" => "S",
		"\xbc" => "z", "\xac" => "Z", "\xbf" => "z", "\xaf" => "Z",
		"\xf1" => "n", "\xd1" => "N");
		return strtr($tekst,$tabela);
	}

	public static function sendEmailNotification($computer,$params) {
		$mailer=JFactory::getMailer();
		$config=JFactory::getConfig();
		$sender=array($params->get('sender_email'),$params->get('sender_name'));
		$mailer->setSender($sender);
		$mailer->addRecipient($params->get('receiver_email'));
		$mailer->setSubject('Nowy formularz rejestracji komputera.');
		
		$body='<h3>Przysłano nowy formularz rejestracji:</h3><br />';
		$body.='Data rejestracji:    '.date('Y-m-d H:i:s').'<br />';
		$body.='Adres MAC:           '.$computer->macaddress.'<br />';
		//$body.='Stały IP:            '.$computer->fixedIP.'<br />';
		$body.='Użytkownik:          '.$computer->lastname.' '.$computer->firstname.'<br />';
		$body.='Email użytkownika:   '.$computer->email.'@ippt.pan.pl<br />';
		$body.='Miejsce podłączenia: pokój '.$computer->room.'<br />';
		$body.='Uwagi:               '.$computer->comment.'<br />';
		$body.='<br />';
		$body.='<h3>Wpis do <em>dhcp.conf:</em></h3><br />';
		$body.='<br />';
		$body.='# '.date('Y/m/d') . '; '.ModCompRegister::noPL($computer->firstname).' '.ModCompRegister::noPL($computer->lastname).'; p.'.$computer->room.';<br />';
		$body.='host '.'komp'.date('YmdHis').' { hardware ethernet '.$computer->macaddress;
		$body.='; }';
		$body.='<br />';

		$mailer->setBody($body);
		$mailer->isHTML(true);
		$mailer->send();
	}
}
?>