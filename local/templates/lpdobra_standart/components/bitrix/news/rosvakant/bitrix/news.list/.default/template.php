<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
  <h1 class="text-center white">Поиск резюме</h1>
</div>
<?php require_once ROOT."/include/search_form.php"; ?>
</header>

<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <br>
          <h5>Найдено <strong></strong> резюме</h5>
        </div>
      </div>
      

      <div class="row">
        <!-- Resume detail -->
        <?php

        foreach ($arResult["ITEMS"] as $arItem) {

          $locationId = $arItem["PROPERTIES"]["ID_LOCATION"]["VALUE"];
          $sNameLocation = '';
          $arSelectLocation = CSaleLocation::GetByID($locationId);

          $sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
          if ($arSelectLocation["REGION_ID"] == $locationId) {
            $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
          } elseif ($arSelectLocation["CITY_ID"] == $locationId) {
            $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
          }

          $arProp = [
            "user" => CUser::GetByID($arItem["PROPERTIES"]["ID_USER"]["VALUE"])->arResult[0]["NAME"],
            "location" => $sNameLocation,
            "payment" => $arItem["PROPERTIES"]["PAYMENT"]["VALUE"],
            "image" => !empty($arItem["PREVIEW_PICTURE"]["SRC"]) ? $arItem["PREVIEW_PICTURE"]["SRC"] : "/img/not-avatar.png"
          ];
          ?>
          <div class="col-sm-12 col-md-6">
            <a class="item-block" href="/resume/<?=$arItem["ID"]?>/">
              <header>
                <img class="resume-avatar" src="<?=$arProp["image"]?>" alt="">
                <div class="hgroup">
                  <h4><?=$arItem["NAME"]?></h4>
                  <h5><?=$arProp["user"]?></h5>
                </div>
              </header>

              <div class="item-body">
                <p><?=$arItem["DETAIL_TEXT"]?></p>
              </div>

              <footer>
                <ul class="details cols-2">
                  <li>
                    <i class="fa fa-map-marker"></i>
                    <span><?=$arProp["location"]?></span>
                  </li>

                  <li>
                    <i class="fa fa-money"></i>
                    <span><?=number_format($arProp["payment"], 0, ".", " ")?> руб. / мес.</span>
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
        <div class="col-xs-12"><?php  echo $arResult["NAV_STRING"] ?></div>
      </div>
    </div>
  </section>
</main>


