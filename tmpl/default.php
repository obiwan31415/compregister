<?php
defined('_JEXEC') or die('Access denied');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_compregister/css/mod_compregister.css');
$doc->addScript(JURI::root().'/modules/mod_compregister/js/mod_compregister.js');
?>
<!-- <img src="<?php echo JURI::root();?>modules/mod_compregister/images/login.jpg" height="" width="100%"> -->
<form id="compregister" name="compregister" method="POST">
	<!-- <div class="mainregbox"> -->
		<h3 class="compreg">Dane osoby odpowiedzialnej za komputer</h3>
		
			<div class="regbox">
				<label for="firstname">Imię* :</label>
				<input class="mandatory" type="text" id="firstname" name="firstname" />
			</div>
			<div class="regbox">
				<label for="lastname">Nazwisko* :</label>
				<input class="mandatory" type="text" id="firstname" name="lastname" />
			</div>
			<div class="regbox">
				<label for="email">Email* :</label>
				<input class="mandatory" type="text" id="email" name="email" />
			</div>
			<div class="regbox">
				<label for="room">Numer pokoju* :</label>
				<input class="mandatory" type="text" id="room" name="room" />
			</div>
			<div class="regbox">
				<label for="phone">Telefon wewnętrzny* :</label>
				<input class="mandatory" type="text" id="phone" name="phone" />
			</div>
	<!-- </div> -->

	<!-- <div class="mainregbox"> -->
		<h3 class="compreg">Dane komputera</h3>
		<div class="regbox">
			<label for="macaddress">MAC address* :</label>
			<input class="mandatory" type="text" id="macaddress" name="macaddress" />
		</div>
		<div class="regbox">
			<label for="compname">Nazwa komputera* :</label>
			<input class="mandatory" type="text" id="compname" name="compname" />
		</div>
		<div class="regbox">
			<label for="workgroup">Grupa robocza:</label>
			<input type="text" id="workgroup" name="workgroup" placeholder="nieobowiązkowe"/>
		</div>
		<div class="regbox">
			<label for="wallsocket">Gniazdko sieciowe* :</label>
			<input class="mandatory" type="text" id="wallsocket" name="wallsocket" />
		</div>
		<div class="regbox">
			<label for="primarysystem">Podstawowy system operacyjny* :</label>
			<select class="mandatory" name="primarysystem" id="primarysystem">
				<option disabled selected ></option>
				<option value="winxp">Windows XP lub starszy</option>
				<option value="win7">Windows 7</option>
				<option value="win8">Windows 8/8.1</option>
				<option value="linux">Linux</option>
			</select>
		</div>
	<!-- </div> -->

	<label for="comment">Uwagi:</label>
	<textarea id="comment" name="comment" placeholder="Tu wpisz swoje uwagi."></textarea>
	<?php echo JHtml::_('form.token'); ?>
	<input id="send" type="submit" id="btn_send" name="btn_send" value="Wyślij" />
</form>