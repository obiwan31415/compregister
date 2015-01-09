<?php
defined('_JEXEC') or die('Access denied');
require(dirname(__FILE__).DS.'helper.php');
if(isset($_POST['btn_send'])) {
	$jinput = JFactory::getApplication()->input;
	$computer = new Computer();
	$computer->setFixedIP($jinput->get('fixed','','STRING'));
	if(!isset($_POST['fixed'])) {
		$computer->setFixedIP("no");
	}
	$computer->setMACaddress($jinput->get('macaddress','','STRING'));
	$computer->setFirstname($jinput->get('firstname','','STRING'));
	$computer->setLastname($jinput->get('lastname','','STRING'));
	$computer->setEmail($jinput->get('email','','STRING'));
	$computer->setRoom($jinput->get('room','','STRING'));
	$computer->setComment($jinput->get('comment','','STRING'));
	if(ModCompRegister::findMAC($computer->getMACaddress())) {
		echo '<h3 style="color:red;">BŁĄD! Taki adres MAC został wcześniej zarejestrowany.</h3>';
	}else{
		if(ModCompRegister::saveData($computer,$params)){
			//ModCompRegister::sendEmailNotification($computer,$params);
			echo '<h3 style="color:#1A6E1B;">Dane komputera zapisane</h3><br />';
			echo '<p style="color:#1A6E1B;">Oczekuj na maila z potwierdzeniem rejestracji.</p>';
		}else{
			echo '<h3 style="color:red;">BŁĄD! Spróbuj ponownie.</h3>';
		}
	}
} else {
	require(JModuleHelper::getLayoutPath('mod_compregister'));
}
?> 
