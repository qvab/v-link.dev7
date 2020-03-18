<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule("sale");
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arData = [
  "COMPANY" => getElementIBlock(IB_COMPANIES, $arResult["PROPERTIES"]["COMPANY"]["VALUE"]),
  "VACANCY" => getElementIBlock(IB_VACANCY, $arResult["PROPERTIES"]["VACANCY"]["VALUE"]),
  "RESUME" => getElementIBlock(IB_RESUME, $arResult["PROPERTIES"]["RESUME"]["VALUE"]),
  "ID_USER" => $arResult["PROPERTIES"]["ID_USER"]["VALUE"],
  "ID_FEEDBACK" => $arResult["PROPERTIES"]["ID_INVITE"]["VALUE"],
  "MESSAGES" => $arResult["FIELDS"]["DETAIL_TEXT"],
  "ID" => $arResult["FIELDS"]["ID"]
];

readMessages($arData["ID"]);

if (isset($_GET["add-message"])) {
  $res = insertMessage(
    $arData{'ID'},
    "user",
    "user",
    [
      "id" => $USER->GetID(),
      "name" => $USER->GetFirstname()
    ],
    [
      "id" => $arData["COMPANY"]["fields"]["ID"],
      "name" => $arData["COMPANY"]["fields"]["NAME"]
    ],
    $_POST["message"]["text"]);

  if (!empty($res)) {
    header("Location: ".parse_url($_SERVER["REQUEST_URI"])["path"]);
  }
}
$arMessages = [];
if (!empty($arData["MESSAGES"])) {
  $arMessages = json_decode(htmlspecialchars_decode($arData["MESSAGES"]), true);
}
?>

<div class="container">
  <div class="header-detail">
    <div class="item-block">
      <header>
        <div class="hgroup">
          <h4><a
                href="/vacancy/<?=$arData["VACANCY"]["fields"]["ID"]?>/"><?=$arData["VACANCY"]["fields"]["NAME"]?></a>
          </h4>
          <h5><?=$arData["COMPANY"]["fields"]["NAME"]?> </h5>
        </div>
        <div class="header-meta">
          <h4><a href="/resume/<?=$arData["RESUME"]["fields"]["ID"]?>/"><?=$arData["RESUME"]["fields"]["NAME"]?></a>
          </h4>
          <h5>Ваше резюме</h5>
        </div>
      </header>
    </div>
    <br/>
    <div class="message">
      <?php

      foreach ($arMessages as $arMes) { ?>
        <div class="alert alert-grey" style="margin-left: 45px;">
          <b style="font-weight: bold;"><?=$arMes["from_name"]?></b>
          <p><?=$arMes["text"]?></p>
        </div>

        <?php
      }
      ?>
    </div>
    <div class="item-block">
      <header>
        <form action="?add-message" method="POST">
          <textarea class="form-control" rows="3" name="message[text]" placeholder="Текст сообщения"></textarea>
          <br/>
          <button class="btn btn-primary">Отправить сообщение</button>
        </form>
      </header>
    </div>

  </div>
</div>
</header>