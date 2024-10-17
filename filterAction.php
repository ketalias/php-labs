<?php
if (array_key_exists('country', $_GET) && !empty($_GET['country']) && 
array_key_exists('minAge', $_GET) && !empty($_GET['minAge'])) {

$country = $_GET['country'];
$minAge = (int)$_GET['minAge']; 

$participants = filterParticipants($participants, $country, $minAge);
}