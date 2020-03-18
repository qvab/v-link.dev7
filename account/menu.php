<?php

$arURL = parse_url($_SERVER["REQUEST_URI"]);
$arURL = explode("/", $arURL["path"]);
foreach ($arURL as $k => $sURL) {
  if (empty($sURL)) {
    unset($arURL[$k]);
  }
}

$arButtons = [
  "btn-black",
  "btn-black",
  "btn-black",
  "btn-black",
  "btn-black",
  "btn-black"
];

switch (end($arURL)) {
  case "account":
    $arButtons[0] = "btn-primary";
    break;
  case "vacancy":
    $arButtons[3] = "btn-primary";
    break;
  case "user-in":
    $arButtons[2] = "btn-primary";
    break;
  case "user-feedback":
    $arButtons[1] = "btn-primary";
    break;
  case "work-in":
    $arButtons[2] = "btn-primary";
    break;
  case "work-feedback":
    $arButtons[1] = "btn-primary";
    break;
}


?>
<div class="col-sm-12 col-md-3">
  <h6 style="color: #666;">Меню соискателя</h6>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <a class="btn btn-block <?=$arButtons[0]?>" href="/account/">Мои резюме</a>
      <a class="btn btn-block <?=$arButtons[1]?>" href="/account/user-feedback/">Отклики</a>
      <a class="btn btn-block <?=$arButtons[2]?>" href="/account/user-in/">Приглашения</a>
    </div>
  </div>
  <br/>
  <h6 style="color: #666;">Меню работодателя</h6>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <a class="btn btn-block <?=$arButtons[3]?>" href="/account/vacancy/">Вакансии</a>
      <a class="btn btn-block <?=$arButtons[5]?>" href="/account/work-feedback/">Предложения</a>
      <a class="btn btn-block <?=$arButtons[4]?>" href="/account/work-in/">Запросы</a>
    </div>
  </div>
</div>