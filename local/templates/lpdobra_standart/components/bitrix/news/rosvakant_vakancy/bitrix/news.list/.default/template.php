<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
CModule::IncludeModule("sale");

$arRes = getCategories();
$arSchedule = getGrafic();
$arTypeOFEmp = getTypeWork();
$arSections = $arRes["sections"];
$arCategories = $arRes["categories"];
?>

<div class="container page-name">
  <h1 class="text-center white">Поиск вакансий</h1>
</div>

<?php require_once ROOT."/include/search_form.php"; ?>
</header>

<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <br>
          <h5>Найденные <strong></strong> вакансий</h5>
        </div>
      </div>


      <div class="row">
        <!-- Resume detail -->
        <?php

        foreach ($arResult["ITEMS"] as $arItem) {


          $obCompany = CIBlockElement::GetByID($arItem["PROPERTIES"]["COMPANY"]["VALUE"]);
          $resCompany = $obCompany->GetNextElement();
          $arCompany = $resCompany->GetFields();
          $sPathImage = "";
          if (!empty($arCompany["PREVIEW_PICTURE"]) || !empty($arCompany["DETAIL_PICTURE"])) {
            $sPathImage = !empty($arCompany["PREVIEW_PICTURE"]) ? CFile::GetPath($arCompany["PREVIEW_PICTURE"]) : CFile::GetPath($arCompany["DETAIL_PICTURE"]);
          } else {
            $sPathImage = "/assets/img/logo-default.png";
          }

          $locationId = $arItem["PROPERTIES"]["CITY"]["VALUE"];
          $sNameLocation = '';
          $arSelectLocation = CSaleLocation::GetByID($locationId);

          $sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
          if ($arSelectLocation["REGION_ID"] == $locationId) {
            $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
          } elseif ($arSelectLocation["CITY_ID"] == $locationId) {
            $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
          }


          $sPayment = "Не указана";
          if (
            !empty($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
            && !empty($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
          ) {
            $sPayment = finance($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])." - ".finance($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"]);
          } elseif (
            !empty($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
            && empty($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
          ) {
            $sPayment = "До ".finance($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"]);
          } elseif (
            empty($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
            && !empty($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
          ) {
            $sPayment = "От ".finance($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"]);
          }


          $arProp = [
            "company" => $arCompany["NAME"],
            "location" => $sNameLocation,
            "payment" => $sPayment,
            "image" => $sPathImage
          ];
          ?>
          <div class="col-sm-12 col-md-6">
            <a class="item-block" href="/vacancy/<?=$arItem["ID"]?>/">
              <header>
                <img class="resume-avatar" src="<?=$arProp["image"]?>" alt="">
                <div class="hgroup">
                  <h4 title="<?=$arItem["NAME"]?>"><?=strlen($arItem["NAME"]) < 33 ? $arItem["NAME"] : substr($arItem["NAME"], 0, 32)."..."?></h4>
                  <h5><?=$arProp["company"]?></h5>
                </div>
              </header>

              <div class="item-body">
                <p><?=$arItem["PREVIEW_TEXT"]?></p>
              </div>

              <footer>
                <ul class="details cols-2">
                  <li>
                    <i class="fa fa-map-marker"></i>
                    <span><?=$arProp["location"]?></span>
                  </li>

                  <li>
                    <i class="fa fa-money"></i>
                    <span><?=$arProp["payment"]?> руб. / мес.</span>
                  </li>
                </ul>
              </footer>
            </a>
          </div>
          <?php
        }
        ?>
        <!-- END Resume detail -->
      </div>
      <div class="row pagination-contain">
        <div class="col-xs-12"><?php echo $arResult["NAV_STRING"] ?></div>
      </div>
    </div>
  </section>
</main>