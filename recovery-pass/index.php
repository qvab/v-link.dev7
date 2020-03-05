<?php
define("ALT_TITLE", "Восстановление пароля");
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
require_once ROOT_TEMPLATE."/inc/head.php";

$APPLICATION->IncludeComponent(
  "bitrix:main.auth.forgotpasswd",
  "rosvakant",
  Array(
    "AUTH_AUTH_URL" => "/login/",
    "AUTH_REGISTER_URL" => "/reg/"
  )
);

