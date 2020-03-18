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


$locationId = $arResult["PROPERTIES"]["CITY"]["VALUE"];
$sNameLocation = '';
$arSelectLocation = CSaleLocation::GetByID($locationId);

$sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
if ($arSelectLocation["REGION_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
} elseif ($arSelectLocation["CITY_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
}



$obCompany = CIBlockElement::GetByID($arResult["PROPERTIES"]["COMPANY"]["VALUE"]);
$resCompany = $obCompany->GetNextElement();
$arCompany = $resCompany->GetFields();
$sPathImage = "";
if (!empty($arCompany["PREVIEW_PICTURE"]) || !empty($arCompany["DETAIL_PICTURE"])) {
  $sPathImage = !empty($arCompany["PREVIEW_PICTURE"]) ? CFile::GetPath($arCompany["PREVIEW_PICTURE"]) : CFile::GetPath($arCompany["DETAIL_PICTURE"]);
} else {
  $sPathImage = "/assets/img/logo-default.png";
}



$iCountDay = countDays($arResult["DATE_CREATE"]);
if (empty($iCountDay)) {
  $sCountDayAgo = "Сегодня";
} elseif ($iCountDay < 5) {
  $sCountDayAgo = $iCountDay." дня назад";
} else {
  $sCountDayAgo = $iCountDay." дней назад";
}

$sPayment = "Не указана";
$sTypeWork = $sGrafic = "Не указан";

if (
  !empty($arResult["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
  && !empty($arResult["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
) {
  $sPayment = finance($arResult["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])." - ".finance($arResult["PROPERTIES"]["MAX_PAYMENT"]["VALUE"]);
} elseif (
  !empty($arResult["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
  && empty($arResult["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
) {
  $sPayment = "До ".finance($arResult["PROPERTIES"]["MAX_PAYMENT"]["VALUE"]);
} elseif (
  empty($arResult["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
  && !empty($arResult["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
) {
  $sPayment = "От ".finance($arResult["PROPERTIES"]["MIN_PAYMENT"]["VALUE"]);
}

$arTypeWork = getTypeWork($arResult["PROPERTIES"]["TYPE_OF_EMP"]["VALUE"]);
$arGrafic = getGrafic($arResult["PROPERTIES"]["SCHEDULE"]["VALUE"]);

if (!empty($arTypeWork)) {
  $arTypeWorkList = [];
  foreach ($arTypeWork as $item) {
    $arTypeWorkList[] = $item["fields"]["NAME"];
  }
  $sTypeWork = implode(", ", $arTypeWorkList);
}

if (!empty($arGrafic)) {
  $arGraficList = [];
  foreach ($arGrafic as $item) {
    $arGraficList[] = $item["fields"]["NAME"];
  }
  $sGrafic = implode(", ", $arGraficList);
}
$arCategories = [];
if (!empty($arResult["PROPERTIES"]["CATEGORIES"]["VALUE"])) {
  $arCategories = getCategories($arResult["PROPERTIES"]["CATEGORIES"]["VALUE"])["all_categories"];
}

$arProp = [
  "company" => $arCompany["NAME"],
  "location" => $sNameLocation,
  "payment" => $sPayment,
  "image" => $sPathImage,
  "key_words" => $arResult["PROPERTIES"]["KEY_WORDS"]["VALUE"],
  "phone" => $arResult["PROPERTIES"]["PHONE"]["VALUE"],
  "educations_id" => $arResult["PROPERTIES"]["CATEGORIES"]["VALUE"],
  "created" => $sCountDayAgo,
  "type_work" => $sTypeWork,
  "grafic" => $sGrafic,
];
$arKeyWords = $arSchedule = $arPrevWorks = [];
if (!empty($arProp["key_words"])) {
  $arKeyWords = getKeywordsByIds($arProp["key_words"]);
}



?>

<div class="container">
  <input type="hidden" id="id-vacancy" value="<?=$arResult["ID"]?>" />
  <div class="header-detail">
    <img class="logo" src="<?=$arProp["image"]?>" alt="">
    <div class="hgroup">
      <h1><?=$arResult["NAME"]?></h1>
      <h3><?=$arProp["company"]?></h3>
    </div>
    <time><?=$arProp["created"]?></time>
    <hr>
    <p class="lead"><?=$arResult["PREVIEW_TEXT"]?></p>

    <ul class="details cols-3">
      <li>
        <i class="fa fa-map-marker"></i>
        <span><?=$arProp["location"]?></span>
      </li>
      <li>
        <i class="fa fa-briefcase"></i>
        <span><?=$arProp["type_work"]?></span>
      </li>
      <li>
        <i class="fa fa-clock-o"></i>
        <span><?=$arProp["grafic"]?></span>
      </li>
      <li>
        <i class="fa fa-check-square-o"></i>
        <span><?=implode(", ", $arCategories)?></span>
      </li>
      <li>
        <i class="fa fa-money"></i>
        <span><?=$arProp["payment"]?> руб / месяц</span>
      </li>

      <li>
        <div class="bootstrap-tagsinput">
          <?php foreach ($arKeyWords as $sName) { ?>
            <span class="tag label label-info"><?=$sName?></span>
            <?php
          } ?>
        </div>
      </li>
    </ul>

    <div class="button-group">
      <div class="action-buttons">
        <a class="btn btn-success" data-id-company="<?=$arResult["PROPERTIES"]["COMPANY"]["VALUE"]?>" data-id-vacancy="<?=$arResult["ID"]?>" href="#app-vacancy">Откликнуться на вакансию</a>
      </div>
    </div>

  </div>
</div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>

  <!-- Job detail -->
  <section>
    <div class="container">
      <?=$arResult["DETAIL_TEXT"]?>
    </div>
  </section>
  <!-- END Job detail -->

</main>
<!-- END Main container -->


<!-- END Page header -->


