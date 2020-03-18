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
?>

<section class="property-area section-gap relative" id="property">
  <div class="overlay overlay-bg">
  </div>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8 pb-40 header-text">
        <h1>Самые популярные вакансии на сегодня</h1>
      </div>
    </div>
    <div class="row">

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

        $renderImage = CFile::ResizeImageGet($arCompany["PREVIEW_PICTURE"], Array("width" => 200, "height" => 150));
        $arProp = [
          "company" => $arCompany["NAME"],
          "location" => $sNameLocation,
          "payment" => $sPayment,
          "image" => $renderImage["src"]
        ];


        //echo CFile::ShowImage($renderImage['src'], 200, 200, "border=0", "", true);

        ?>

        <div class="col-lg-4">
          <div class="single-property">
            <div class="images" style="max-height: 250px;">
              <div class="img"><img src="<?=$arProp["image"]?>" class="img-fluid mx-auto d-block" alt=""></div>
              <a href="/vacancy/<?=$arItem["ID"]?>/"><span>Подробнее</span></a>
            </div>
            <div class="desc">
              <div class="top d-flex justify-content-between">
                <h4><a href="/vacancy/<?=$arItem["ID"]?>/"><?=$arItem["NAME"]?></a></h4>
              </div>
              <div class="top d-flex justify-content-between">
                <h4><?=$arProp["payment"]?> руб</h4>
              </div>
              <div class="middle">
                <div class="d-flex justify-content-start">
                  <p>
                    Регион: <?=$arProp["location"]?>
                  </p>
                </div>
                <div class="d-flex justify-content-start">
                  <p>
                    Организация: <span class="gr"><?=$arProp["company"]?></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>
