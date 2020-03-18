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
?>
<!-- Resume detail -->
<div class="row"><?php
  foreach ($arResult["ITEMS"] as $arItem) {

    $iCountDay = countDays($arItem["FIELDS"]["DATE_CREATE"]);
    if (empty($iCountDay)) {
      $sCountDayAgo = "Сегодня";
    } elseif ($iCountDay < 5) {
      $sCountDayAgo = $iCountDay." дня назад";
    } else {
      $sCountDayAgo = $iCountDay." дней назад";
    }
    $arData = [
      "COMPANY" => getElementIBlock(IB_COMPANIES, $arItem["PROPERTIES"]["COMPANY"]["VALUE"]),
      "VACANCY" => getElementIBlock(IB_VACANCY, $arItem["PROPERTIES"]["VACANCY"]["VALUE"]),
      "RESUME" => $arItem["PROPERTIES"]["RESUME"]["VALUE"],
      "ID_USER" => $arItem["PROPERTIES"]["ID_USER"]["VALUE"],
      "ID_FEEDBACK" => $arItem["PROPERTIES"]["ID_INVITE"]["VALUE"],
      "DATE" => $sCountDayAgo,
      "MESSAGES" => $arItem["FIELDS"]["DETAIL_TEXT"],
      "ID" => $arItem["FIELDS"]["ID"]
    ];
    ?>
    <div class="col-xs-12">
      <div class="item-block">
        <header>
          <div class="hgroup">

            <h4><a href="/vacancy/<?=$arData["VACANCY"]["fields"]["ID"]?>/"><?=$arData["VACANCY"]["fields"]["NAME"]?></a>
            </h4>
            <h5><?=$arData["COMPANY"]["fields"]["NAME"]?></h5>
          </div>
          <div class="header-meta">
            <span class="date"><i class="fa fa-clock-o"></i> <?=$arData["DATE"]?></span>
            <br/><br/>
            <span>

            </span>
          </div>
        </header>

        <footer>
          <div style="opacity: 1;" class="action-btn" data-global-id-item="<?=$arItem["ID"]?>">
            <a href="/account/user-in/<?=$arData["ID"]?>/" class="btn btn-primary btn-xs">Сообщения +1</a>
          </div>
        </footer>
      </div>
    </div>
    <?php
  }
  ?>
  <!-- END Resume detail -->
</div>
<div class="row pagination-contain">
  <div class="col-xs-12"><?php echo $arResult["NAV_STRING"] ?></div>
</div>