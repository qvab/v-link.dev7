<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
if ($_GET["type_search"] == "resume") {
  $res = searchKeyWord($_GET["key"], "resume");
} else {
  $res = searchKeyWord($_GET["key"]);
}
if (!empty($res)) {
  echo json_encode($res, JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(["none" => true], JSON_UNESCAPED_UNICODE);
}