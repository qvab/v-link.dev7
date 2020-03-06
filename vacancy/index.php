<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск вакансий");

$sTypePageList = "vacancy";
$arrFilter = [
  "PROPERTY" => []
];
if (!empty($_GET["search"])) {
  if (!empty($_GET["search"]["payment"])) {

    if (!empty($p)) {
      $arrFilter[] = [
        "LOGIC" => "OR",
        [
          "LOGIC" => "AND",
          ">PROPERTY_MIN_PAYMENT" => 0,
          ">=PROPERTY_MIN_PAYMENT" => $p[0],
          "<=PROPERTY_MIN_PAYMENT" => $p[1],
        ],
        [
          "LOGIC" => "AND",
          ">PROPERTY_MAX_PAYMENT" => 0,
          ">=PROPERTY_MAX_PAYMENT" => $p[0],
          "<=PROPERTY_MAX_PAYMENT" => $p[1],
        ],
      ];
    }

    if ($_GET["search"]["type_of_emp"][0] != "on") {
      $arrFilter["PROPERTY"]["TYPE_OF_EMP"] = $_GET["search"]["type_of_emp"];
    }

    if ($_GET["search"]["schedule"][0] != "on") {
      $arrFilter["PROPERTY"]["SCHEDULE"] = $_GET["search"]["schedule"];
    }

    if (!empty($_GET["search"]["categories"][0])) {
      $arrFilter["PROPERTY"]["CATEGORIES"] = $_GET["search"]["categories"];
    }

    if (!empty($_GET["search"]["region"])) {
      $arrFilter["PROPERTY"]["CITY"] = $_GET["search"]["region"];
    }

  }


  if (!empty($_GET["search"]["key"])) {
    if ($_GET["search"]["typekey"] == "key") {
      $arKeyWords = searchKeyWord($_GET["search"]["key"], false, true);
      $arrFilter["PROPERTY"]["KEY_WORDS"] = $arKeyWords;
    } elseif ($_GET["search"]["typekey"] == "vacancy") {
      $arrFilter["NAME"] = $_GET["search"]["key"];
    } else {
      $arAllKey = [];
      $arAllKeyForName = [];
      $arKeysSearch = explode(",", $_GET["search"]["key"]);
      if (count($arKeysSearch) > 0) {
        foreach ($arKeysSearch as $idKey => $sKey) {
          $arKey = explode(" ", $sKey);
          if (count($arKey) > 1) {
            foreach ($arKey as $towKey) {
              if (!empty($towKey)) {
                $arAllKey[] = $towKey;
                $arAllKeyForName[] = $towKey."%";
              }
            }
          } else {
            if (!empty($arKey[0])) {
              $arAllKey[] = $arKey[0];
              $arAllKeyForName[] = $arKey[0]."%";
            }
          }
        }
      }
      $arKeyWords = searchKeyWord($arAllKey, false, true);
      if (!empty($arKeyWords)) {
        $arrFilter[] = [
          "LOGIC" => "OR",
          "PROPERTY_KEY_WORDS" => $arKeyWords,
          "NAME" => $arAllKeyForName,
        ];

      } else {
        $arrFilter["NAME"] = $arAllKeyForName;
      }

    }
  }

}

?>
<? $APPLICATION->IncludeComponent(
  "bitrix:news",
  "rosvakant_vakancy",
  Array(
    "ADD_ELEMENT_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "Y",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "BROWSER_TITLE" => "-",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "CHECK_DATES" => "Y",
    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
    "DETAIL_DISPLAY_TOP_PAGER" => "N",
    "DETAIL_FIELD_CODE" => array("ID", "CODE", "XML_ID", "NAME", "TAGS", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE", "DATE_ACTIVE_FROM", "ACTIVE_FROM", "DATE_ACTIVE_TO", "ACTIVE_TO", "SHOW_COUNTER", "SHOW_COUNTER_START", "IBLOCK_TYPE_ID", "IBLOCK_ID", "IBLOCK_CODE", "IBLOCK_NAME", "IBLOCK_EXTERNAL_ID", "DATE_CREATE", "CREATED_BY", "CREATED_USER_NAME", "TIMESTAMP_X", "MODIFIED_BY", "USER_NAME", ""),
    "DETAIL_PAGER_SHOW_ALL" => "Y",
    "DETAIL_PAGER_TEMPLATE" => "",
    "DETAIL_PAGER_TITLE" => "Страница",
    "DETAIL_PROPERTY_CODE" => array("SCHEDULE", "CATEGORIES", "KEY_WORDS", "COMPANY", "PHONE", "MAX_PAYMENT", "MIN_PAYMENT", "CITY", "TYPE_OF_EMP", ""),
    "DETAIL_SET_CANONICAL_URL" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "FILTER_FIELD_CODE" => array("", "NAME", ""),
    "FILTER_NAME" => "arrFilter",
    "FILTER_PROPERTY_CODE" => array("", "SCHEDULE", "CATEGORIES", "KEY_WORDS", "COMPANY", "PHONE", "MAX_PAYMENT", "MIN_PAYMENT", "CITY", "TYPE_OF_EMP", ""),
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "IBLOCK_ID" => "34",
    "IBLOCK_TYPE" => "rv_company",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
    "LIST_FIELD_CODE" => array("ID", "CODE", "XML_ID", "NAME", "TAGS", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE", "DATE_ACTIVE_FROM", "ACTIVE_FROM", "DATE_ACTIVE_TO", "ACTIVE_TO", "SHOW_COUNTER", "SHOW_COUNTER_START", "IBLOCK_TYPE_ID", "IBLOCK_ID", "IBLOCK_CODE", "IBLOCK_NAME", "IBLOCK_EXTERNAL_ID", "DATE_CREATE", "CREATED_BY", "CREATED_USER_NAME", "TIMESTAMP_X", "MODIFIED_BY", "USER_NAME", ""),
    "LIST_PROPERTY_CODE" => array("SCHEDULE", "CATEGORIES", "KEY_WORDS", "COMPANY", "PHONE", "MAX_PAYMENT", "MIN_PAYMENT", "CITY", "TYPE_OF_EMP", ""),
    "MESSAGE_404" => "",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "NEWS_COUNT" => "20",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => "rosvakant",
    "PAGER_TITLE" => "Новости",
    "PREVIEW_TRUNCATE_LEN" => "",
    "SEF_FOLDER" => "/vacancy/",
    "SEF_MODE" => "Y",
    "SEF_URL_TEMPLATES" => Array(
      "detail" => "#ELEMENT_ID#/",
      "news" => "",
      "section" => ""
    ),
    "SET_LAST_MODIFIED" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "Y",
    "SHOW_404" => "N",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_BY2" => "SORT",
    "SORT_ORDER1" => "DESC",
    "SORT_ORDER2" => "ASC",
    "STRICT_SECTION_CHECK" => "N",
    "USE_CATEGORIES" => "N",
    "USE_FILTER" => "Y",
    "USE_PERMISSIONS" => "N",
    "USE_RATING" => "N",
    "USE_REVIEW" => "N",
    "USE_RSS" => "N",
    "USE_SEARCH" => "N",
    "USE_SHARE" => "N"
  )
); ?>
  <div class="pop-contact">
    <div class="contain">
      <h1>Получить данные контакта</h1>
      <div class="content"></div>
    </div><div class="helper"></div>
  </div>
  <script src="/assets/js/core_rv.js"></script>
  <script>
    RV.getVacancy();
  </script>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>