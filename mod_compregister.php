<?php
defined('_JEXEC') or die('Access denied');
require(dirname(__FILE__).DS.'helper.php');
if(isset($_POST['btn_send'])) {
	$jinput = JFactory::getApplication()->input;
	$computer = new Computer();
	$computer->setMACaddress($jinput->get('macaddress','','STRING'));
	$computer->setCompName($jinput->get('compname','','STRING'));
	$computer->setWorkgroup($jinput->get('workgroup','','STRING'));
	$computer->setWallSocket($jinput->get('wallsocket','','STRING'));
	$computer->setPrimarySystem($jinput->get('primarysystem','','STRING'));
	$computer->setSecondarySystem($jinput->get('secondarysystem','','STRING'));
	$computer->setComments($jinput->get('comment','','STRING'));
	$computer->setFirstname($jinput->get('firstname','','STRING'));
	$computer->setLastname($jinput->get('lastname','','STRING'));
	$computer->setEmail($jinput->get('email','','STRING'));
	$computer->setRoom($jinput->get('room','','STRING'));
	$computer->setPhone($jinput->get('phone','','STRING'));
	if(ModCompRegister::saveData($computer,$params)){
		echo '<h3>Dane komputera zapisane</h3>';
	}else{
		echo '<h3>BŁĄD! Spróbuj ponownie.</h3>';
	}
} else {
	require(JModuleHelper::getLayoutPath('mod_compregister'));
}
?> 
