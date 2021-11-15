<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = new mysqli("localhost", "root", "mijnkreft", "modtools");

$modtools['base'] = "https://mods.dyna.host";
$modtools["welcome"] = "Any changes made can be traced back. Report bugs and errors to ItsMeRomian or Kazoo.";

$hotel['users'] = "Dyna";
$hotel['name'] = "DynaHotel";
$hotel['base'] = "https://hotel.dyna.host";
$hotel['guildbadges'] = $hotel['base'] . "/swf/guildbadges/generated/";
$hotel['theme'] = "https://hotel.dyna.host/templates/DynaHotel";
