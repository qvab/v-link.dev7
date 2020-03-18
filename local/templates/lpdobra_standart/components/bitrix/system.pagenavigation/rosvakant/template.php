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

if (!$arResult["NavShowAlways"]) {
  if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
    return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div style="text-align: center;">
  <div style="display: inline-block;">
    <ul class="pagination">
      <? if ($arResult["NavPageNomer"] > 1) { ?>
        <li>
          <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"] - 1)?>"
             aria-label="Previous">
            <i class="ti-angle-left"></i>
          </a>
        </li>
      <? }

      while ($arResult["nStartPage"] <= $arResult["nEndPage"]) { ?>

        <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) { ?>
          <li class="active"><a href="#"><?=$arResult["nStartPage"]?></a></li>
        <? } else { ?>
          <li><a
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
          </li>
        <? } ?>
        <? $arResult["nStartPage"]++ ?>
      <? } ?>

      <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
        <li>
          <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"] + 1)?>">
            <i class="ti-angle-right"></i>
          </a>
        </li>
      <? } ?>
    </ul>
  </div>
</div>