<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";

$obIblock = new CIBlockElement;
$arMessage = [];

if (!$USER->IsAuthorized()) {
  $arMessage["error"] = "Вы не авторизованны";
} else {
  $arCompany = getCurrentCompany();
  $arFields = [
    "PROPERTY_VALUES" => [
      "COMPANY" => $arCompany["fields"]["ID"],
      "ID_USER" => $USER->GetID(),
      "RESUME" => $_POST["response"]["resume"],
      "VACANCY" => $_POST["response"]["vacancy"],
    ],
    "NAME" => "От ".$USER->GetLogin()." для компании ".$arCompany["fields"]["NAME"],
    "DETAIL_TEXT" => $_POST["job"]["description"],
    "ACTIVE" => "Y",
    "IBLOCK_ID" => 45,
  ];
  $el = $obIblock->Add($arFields);
  if (!empty($el)) {
    $arMessage["success"] = showBlockMessage("Отклик успешно отправлено", "success", true);
  } else {
    $arMessage["error"] = showBlockMessage("При отправке сообщения произошла ошибка", "error", true);
  }
}

echo json_encode($arMessage, JSON_UNESCAPED_UNICODE);