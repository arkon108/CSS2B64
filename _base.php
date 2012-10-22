<?php

ini_set('max_execution_time', 300);

session_start();

$baseurl = explode('/', $_SERVER['SCRIPT_FILENAME']);
$baseurl = '/'.$baseurl[count($baseurl)-2];

