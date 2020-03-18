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


$locationId = $arResult["PROPERTIES"]["ID_LOCATION"]["VALUE"];
$sNameLocation = '';
$arSelectLocation = CSaleLocation::GetByID($locationId);

$sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
if ($arSelectLocation["REGION_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
} elseif ($arSelectLocation["CITY_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
}


$arProp = [
  "user" => CUser::GetByID($arResult["PROPERTIES"]["ID_USER"]["VALUE"])->arResult[0]["NAME"],
  "location" => $sNameLocation,
  "payment" => $arResult["PROPERTIES"]["PAYMENT"]["VALUE"],
  "image" => !empty($arResult["DETAIL_PICTURE"]["SRC"]) ? $arResult["DETAIL_PICTURE"]["SRC"] : "/img/not-avatar.png",
  "email" => $arResult["PROPERTIES"]["EMAIL"]["VALUE"],
  "key_words" => $arResult["PROPERTIES"]["KEY_WORDS"]["VALUE"],
  "phone" => $arResult["PROPERTIES"]["PHONE"]["VALUE"],
  "age" => getFullYears($arResult["PROPERTIES"]["HAPPY_DAY"]["VALUE"]),
  "educations_id" => $arResult["PROPERTIES"]["EDUCATIONS"]["VALUE"],
  "prev_works_id" => $arResult["PROPERTIES"]["PREV_WORKS"]["VALUE"],
  "site" => !empty($arResult["PROPERTIES"]["SITE"]["VALUE"]) ? $arResult["PROPERTIES"]["SITE"]["VALUE"] : "Не заполнено",
];
$arKeyWords = $arSchedule = $arPrevWorks = [];
if (!empty($arProp["key_words"])) {
  $arKeyWords = getKeywordsByIds($arProp["key_words"]);
}

if (!empty($arProp["educations_id"])) {
  // Получаем список образований
  $arSchedule = getSchedule($arProp["educations_id"]);
}

if (!empty($arProp["prev_works_id"])) {
  // Получаем список предыдущих мест работы
  $arPrevWorks = getTypeOfEmp($arProp["prev_works_id"]);
}


?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      <img src="<?=$arProp["image"]?>" alt="">
    </div>

    <div class="col-xs-12 col-sm-8 header-detail">
      <div class="hgroup">
        <h1><?=$arResult["NAME"]?></h1>
        <h3><?=$arProp["user"]?></h3>
      </div>
      <hr>
      <p class="lead"><?=$arResult["DETAIL_TEXT"]?></p>

      <ul class="details cols-2">
        <li>
          <i class="fa fa-map-marker"></i>
          <span><?=$arProp["location"]?></span>
        </li>

        <li>
          <i class="fa fa-globe"></i>
          <a href="#"><?=$arProp["site"]?></a>
        </li>

        <li>
          <i class="fa fa-money"></i>
          <span><?=number_format($arProp["payment"], 0, ".", " ")?> руб. / мес.</span>
        </li>

        <li>
          <i class="fa fa-birthday-cake"></i>
          <span><?=$arProp["age"]?> лет</span>
        </li>
<?php /*
        <li>
          <i class="fa fa-phone"></i>
          <span><?=$arProp["phone"]?></span>
        </li>

        <li>
          <i class="fa fa-envelope"></i>
          <a href="#"><?=$arProp["email"]?></a>
        </li>
 */ ?>
      </ul>

      <div class="tag-list">
        <?php foreach ($arKeyWords as $sName) {
          echo "<span>".$sName."</span>";
        } ?>
      </div>
    </div>
  </div>

  <div class="button-group">
    <div class="action-buttons">
      <a class="btn btn-success" data-id-user="<?=$arResult["PROPERTIES"]["ID_USER"]["VALUE"]?>" data-id-resume="<?=$arResult["ID"]?>" href="#get-contact">Получить контакт</a>
    </div>
  </div>
</div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>


  <!-- Education -->
  <section>
    <div class="container">

      <header class="section-header">
        <h2>Образование</h2>
      </header>

      <div class="row">
        <?php
        foreach ($arSchedule as $arItem) { ?>
          <div class="col-xs-12">
            <div class="item-block">
              <header>
                <div class="hgroup">
                  <h4><?=$arItem["prop"]["LEVEL"]["VALUE"]?>
                    <small><?=$arItem["prop"]["SPECIAL"]["VALUE"]?></small>
                  </h4>
                  <h5><?=$arItem["prop"]["NAME_EDUCATION"]["VALUE"]?></h5>
                </div>
                <h6 class="time"><?=date("Y", strtotime($arItem["prop"]["DATE_START"]["VALUE"]))?>
                  - <?=date("Y", strtotime($arItem["prop"]["DATE_END"]["VALUE"]))?></h6>
              </header>
              <div class="item-body">
                <p><?=$arItem["fields"]["DETAIL_TEXT"]?></p>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>

    </div>
  </section>
  <!-- END Education -->


  <!-- Work Experience -->
  <section class="bg-alt">
    <div class="container">
      <header class="section-header">
        <h2>Последнее места работы</h2>
      </header>

      <div class="row">
        <?php foreach ($arPrevWorks as $arWork) {?>
          <!-- Work item -->
          <div class="col-xs-12">
            <div class="item-block">
              <header>
                <div class="hgroup">
                  <h4><?=$arWork["prop"]["NAME_ORG"]["VALUE"]?></h4>
                  <h5><?=$arWork["prop"]["SPECIAL"]["VALUE"]?></h5>
                </div>
                <h6 class="time"><?=date("d.m.Y", strtotime($arWork["prop"]["DATE_START"]["VALUE"]))?> - <?=date("d.m.Y", strtotime($arWork["prop"]["DATE_END"]["VALUE"]))?></h6>
              </header>
              <div class="item-body">
                <p><?=$arWork["fields"]["DETAIL_TEXT"]?></p>
              </div>
            </div>
          </div>
          <!-- END Work item -->
          <?php
        }
        ?>

      </div>

    </div>
  </section>
  <!-- END Work Experience -->
</main>
