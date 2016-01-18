<?php

require 'vendor/autoload.php';

include 'data/firebase.php';

$bin = $_GET['bin'];

if (($bin != '') && ($bin != '/')) {
	$bone = json_decode($firebase -> get('bones/' . str_replace("raw/", "", $bin)));
}

if (strrpos($bin, "raw/") > 0) {
	echo $bone -> content;
}
else {

?>
<html>
	<head>
		<title>bonebin: type and encrypt anything!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Type and share your data securely.">
		<meta name="keywords" content="pastebin, paste bin, pastebin, paste, bin, private pastebin, private text, security, anonymous pastebin, encrypt text">

		<link rel="stylesheet" type="text/css" href="./stylesheets/default.css"/>
		<link rel="stylesheet" type="text/css" href="./stylesheets/animate.css"/>

		<script type="text/javascript" src="./javascripts/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="./javascripts/sjcl.js"></script>
		<script type="text/javascript" src="./javascripts/default.js"></script>
	</head>
	<body>
		<div class="bonebin animated bounceInDown">
			<span>bonebin</span>
		</div>

		<div class="pointer">
			<span>></span>
		</div>

		<div class="text">
			<textarea id="bone" autofocus><?php echo $bone -> content; ?></textarea>
		</div>

		<div class="modal" <?php if ($bone -> crypt != "true") { echo 'style="display:none;"'; } ?>></div>

		<?php if ($bone -> crypt == "true") { ?>
		<div class="password">
			<center>
				<input type="password" placehold="Type password to decrypt." id="decrypt-password" />
				<button onclick="decrypt();">Decrypt</button>
			</center>
			<br clear="all" />
		</div>
		<?php } ?>

		<div id="password-modal-crypt" class="password" style="display:none;">
                        <center>
                                <input type="password" placeholder="Type password to encrypt." id="crypt-password" />
                                <button onclick="crypt();">Crypt</button>
                        </center>
                        <br clear="all" />
                </div>

		<div class="options animated bounceInUp">
			<div class="save" onclick="save();">
				SAVE
			</div>

			<div class="crypt" onclick="openCrypt();">
				CRYPT (AES-256)
			</div>
			<?php if (($bin != '') && ($bin != '/')) { ?>
			<div class="raw" onclick="raw('<?php echo $bin ?>');">
				RAW
			</div>
			<?php } ?>
		</div>

		<br clear="all" />

		<div class="footer">
			<p><a href="http://en.wikipedia.org/wiki/Advanced_Encryption_Standard" target="_blank">AES-256</a> encryption is achieved using <a href="https://crypto.stanford.edu/sjcl/" target="_blank">SJCL</a></p>
			<p>&copy; 2016 - <?php echo $firebase -> get('status/bones'); ?> bones.</p>
		</div>
	</body>
</html>
<?php

}

?>
