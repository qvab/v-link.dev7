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
foreach ($arResult["ITEMS"] as $arItem) { ?>

  <div class="col-lg-4">
    <div class="single-property">
      <div class="images">
        <img src="img/s1.jpg" class="img-fluid mx-auto d-block" alt=""> <a href="<?=TEMPLATE?>page.detail_vacancy.php">Подробнее</a>
      </div>
      <div class="desc">
        <div class="top d-flex justify-content-between">
          <h4><a href="/vacancy/<?=$arItem["ID"]?>/"><?=$arItem["NAME"]?></a></h4>
        </div>
        <div class="top d-flex justify-content-between">
          <h4>30000 - 40000 руб</h4>
        </div>
        <div class="middle">
          <div class="d-flex justify-content-start">
            <p>
              Регион: Самарская обл.
            </p>
          </div>
          <div class="d-flex justify-content-start">
            <p>
              Организация: <span class="gr">citilink</span>
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
