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
?>

<div class="container no-shadow">
  <br />
  <h1 class="text-center white"><?=$arResult["NAME"]?></h1>
  <br />
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


