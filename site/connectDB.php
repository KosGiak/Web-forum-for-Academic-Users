<?php
	$conf['db']['db_Host'] = 'mysql7.000webhost.com';
	$conf['db']['db_Login'] = 'a7976231_icsdDB';
	$conf['db']['db_PWord'] = 'S5csgpv';
	$conf['db']['db_Name'] = 'a7976231_webpro';
	$conf['db']['db_Port'] = '3306';

	$linkDB = mysqli_connect($conf['db']['db_Host'], $conf['db']['db_Login'], $conf['db']['db_PWord'], $conf['db']['db_Name'], $conf['db']['db_Port']);
	mysqli_query($linkDB, 'SET NAMES utf8');
	//session_start();
	if (!$linkDB) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
?>