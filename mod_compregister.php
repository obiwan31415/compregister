<?php
defined('_JEXEC') or die('Access denied');
require(dirname(__FILE__).DS.'helper.php');
$formpage=JURI::current();
if(isset($_POST['btn_send'])) {
	$jinput = JFactory::getApplication()->input;
	$computer = new Computer();
	//$computer->setFixedIP($jinput->get('fixed','','STRING'));
	/*if(!isset($_POST['fixed'])) {
		$computer->setFixedIP("no");
	}*/
	$computer->macaddress = ModCompRegister::convertToMAC($jinput->get('macaddress','','STRING'));
	$computer->firstname = $jinput->get('firstname','','STRING');
	$computer->lastname = $jinput->get('lastname','','STRING');
	$computer->email = $jinput->get('email','','STRING');
	$computer->room = $jinput->get('room','','STRING');
	$computer->comment = $jinput->get('comment','','STRING');

	if(ModCompRegister::findMAC($computer->getMACaddress())) {
		echo '<h3 style="color:red;">BŁĄD! Taki adres MAC został wcześniej zarejestrowany.</h3>';
		echo '<a href="'.$formpage.'">Powrót do formularza</a>';
	}else{
		if(ModCompRegister::saveData($computer,$params)){
			ModCompRegister::sendEmailNotification($computer,$params);
			echo '<h3 style="color:#1A6E1B;">Dane komputera zapisane</h3><br />';
			echo '<p style="color:#1A6E1B;">Oczekuj maila z potwierdzeniem rejestracji.</p>';
		}else{
			echo '<h3 style="color:red;">BŁĄD! Spróbuj ponownie.</h3>';
		}
	}
} else {
	require(JModuleHelper::getLayoutPath('mod_compregister'));
}
?> 
