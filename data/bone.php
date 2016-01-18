<?php

require '../vendor/autoload.php';

include 'firebase.php';

$action = $_POST["action"];

if ($action == "save") {
	$bone = $_POST["bone"];
	$crypt = $_POST["crypt"];

	$bin = randomBin(8);

	$data = array(
		'bin' => $bin,
        	'content' => $bone,
		'crypt' => $crypt,
		'ip' => $_SERVER['REMOTE_ADDR'],
		'timestamp' => time()
	);

	$firebase -> set('bones/' . $bin, $data);

	$firebase -> set('status/bones', $firebase -> get('status/bones') + 1);

	echo($bin);
}

function randomBin($length) {
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

    for($i=0; $i < $length; $i++) {
        $bin .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $bin;
}

?>
