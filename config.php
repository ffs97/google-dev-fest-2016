<?php
error_reporting(E_ERROR);

$DB_USER = 'root';
$DB_PASSWORD = 'fatFighter_1997';
$DB_NAME = 'PiCandy';
$DB_HOST = 'localhost';

$SITE_KEY = 'fa4fec9ced6c0340cf7daa48cf19b57e12403ead';

$dbc = @mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME) or die("<h3>Cannot Connect to Database</h3>");