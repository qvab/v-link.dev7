<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/account/RVAccount.php";
$RV = new RVAccount();
$response = [];
switch ($_REQUEST["action"]) {

  case "hide_item":
    $response = $RV->hideItem($_GET["id"]);
    break;

  case "show_item":
    $response = $RV->showItem($_GET["id"]);
    break;
  case "delete_item" :
    $response = $RV->deleteItem($_GET["id"]);
    break;

}

echo json_encode($response, JSON_UNESCAPED_UNICODE);