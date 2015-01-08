<?php
defined('_JEXEC') or die('Access denied');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_compregister/css/mod_compregister.css');
$doc->addScript('modules/mod_compregister/js/mod_compregister.js');
JHTML::_('behavior.formvalidation');
?>
<form class="form-validate" id="compregister" name="compregister" method="POST" >
	<h3 class="compreg">Adres MAC</h3>
	<div class="regbox">
		<input class="required validate-mac" type="text" id="macaddress" name="macaddress" />
	</div>
	<div class="fixed">
		<label for="fixed" id="fixedlabel">Wymagany stały adres IP :</label>
		<input type="checkbox" id="fixed" name="fixed" value="yes"/>
	</div>

	<h3 class="compreg">Dane osoby odpowiedzialnej za komputer</h3>
		<div class="regbox">
			<label for="firstname">Imię* :</label>
			<input class="validate-username" type="text" id="firstname" name="firstname" />
		</div>
		<div class="regbox">
			<label for="lastname">Nazwisko* :</label>
			<input class="validate-username" type="text" id="firstname" name="lastname" />
		</div>
		<div class="regbox">
			<label for="room">Numer pokoju* :</label>
			<input class="mandatory" type="text" id="room" name="room" />
		</div>
		<div class="regbox">
			<label for="email">Email id* :</label>
			<input class="validate-username" type="text" id="email" name="email" />@ippt.pan.pl
		</div>
	<label for="comment">Jeżeli zaznaczyłeś "Wymagany stały adress IP", podaj uzasadnienie. Możesz także wpisać inne uwagi.</label>
	<textarea id="uwagi" name="comment" placeholder="Tu wpisz uzasadnienie lub inne uwagi..."></textarea>
	<h3 class="compreg"></h3>

	<?php echo JHtml::_('form.token'); ?>
	<input type="submit" class="validate" id="btn_send" name="btn_send" value="Wyślij" />
</form>