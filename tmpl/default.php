<?php
defined('_JEXEC') or die('Access denied');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_compregister/css/mod_compregister.css');
//$doc->addScript('modules/mod_compregister/js/mod_compregister.js');
JHTML::_('behavior.formvalidation');
?>
<form class="form-validate" id="compregister" name="compregister" method="POST" >
	<h3 class="compreg">Adres MAC</h3>
	<div class="macbox">
		<input class="required validate-mac regbox" type="text" id="macaddress" name="macaddress" />
	</div>
	<h3 class="compreg">Dane osoby rejestrującej komputer lub urządzenie</h3>
		<div class="regbox">
			<label for="firstname">Imię* :</label>
			<input class="required validate-username regbox" type="text" id="firstname" name="firstname" />
		</div>
		<div class="regbox">
			<label for="lastname">Nazwisko* :</label>
			<input class="required validate-username regbox" type="text" id="lastname" name="lastname" />
		</div>
		<div class="regbox">
			<label for="room">Numer pokoju* :</label>
			<input class="required regboxshort" type="text" id="room" name="room" />
		</div>
		<div class="regbox">
			<label for="email">Email id* :</label>
			<input class="required validate-myemail regboxshort" type="text" id="myemail" name="email" />@ippt.pan.pl
		</div>
	<label for="comment" id="labelcomment">UWAGI:</label>
	<textarea id="uwagi" name="comment" placeholder="Tu wpisz swoje uwagi."></textarea>
	<h3 class="compreg"></h3>

	<?php echo JHtml::_('form.token'); ?>
	<input type="submit" class="validate" id="btn_send" name="btn_send" value="Wyślij" />
</form>
