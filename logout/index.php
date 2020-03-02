<?php
define("ALT_TITLE", "Авторизация");
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/include/constants.php";

global $USER;
if (!is_object($USER)) {
  $USER = new CUser;
}

$USER->Logout();
header("Location: /");
