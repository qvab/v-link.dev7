<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once $_SERVER["DOCUMENT_ROOT"]."/account/RVAccount.php";
$RV = new RVAccount();
$arResume = $RV->resumeGetList();
$APPLICATION->SetTitle("Управление аккаунтом");
?>
<div class="container no-shadow">
  <br>
  <h1 class="text-center">Ваши отклики</h1>
  <br>
</div>
</header>
<main>
  <div class="container">
    <?php if (!$USER->IsAuthorized()) {
      showBlockMessage("Вы не авторизованы!", "error");
    } else { ?>
    <div class="row">
      <?php require_once $_SERVER["DOCUMENT_ROOT"]."/account/menu.php"; ?>
      <div class="col-sm-12 col-md-9">
          <?php
          $arrFilter = [
            "PROPERTY" => [
                "USER_ID" => $USER->GetID()
            ]
          ];

          ?>

          <!-- component --> <?$APPLICATION->IncludeComponent(
            "bitrix:news",
            "rosvakant_feedback",
            Array(
              "ADD_ELEMENT_CHAIN" => "N",
              "ADD_SECTIONS_CHAIN" => "Y",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "BROWSER_TITLE" => "NAME",
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
              "DETAIL_PROPERTY_CODE" => array("", "VACANCY", "COMPANY", "RESUME", "ID_USER", "", "", "", "", "", "", "", "", "", "", ""),
              "DETAIL_SET_CANONICAL_URL" => "N",
              "DISPLAY_BOTTOM_PAGER" => "Y",
              "DISPLAY_DATE" => "Y",
              "DISPLAY_NAME" => "Y",
              "DISPLAY_PICTURE" => "Y",
              "DISPLAY_PREVIEW_TEXT" => "Y",
              "DISPLAY_TOP_PAGER" => "N",
              "FILTER_FIELD_CODE" => array("ID", "CODE", "XML_ID", "NAME", "TAGS", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE", "DATE_ACTIVE_FROM", "ACTIVE_FROM", "DATE_ACTIVE_TO", "ACTIVE_TO", "SHOW_COUNTER", "SHOW_COUNTER_START", "IBLOCK_TYPE_ID", "IBLOCK_ID", "IBLOCK_CODE", "IBLOCK_NAME", "IBLOCK_EXTERNAL_ID", "DATE_CREATE", "CREATED_BY", "CREATED_USER_NAME", "TIMESTAMP_X", "MODIFIED_BY", "USER_NAME", ""),
              "FILTER_NAME" => "arrFilter",
              "FILTER_PROPERTY_CODE" => array("", "VACANCY", "COMPANY", "RESUME", "ID_USER", "", "", "", "", "", "", "", "", "", "", "", "", ""),
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "45",
              "IBLOCK_TYPE" => "rv_company",
              "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
              "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
              "LIST_FIELD_CODE" => array("ID", "CODE", "XML_ID", "NAME", "TAGS", "SORT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT", "DETAIL_PICTURE", "DATE_ACTIVE_FROM", "ACTIVE_FROM", "DATE_ACTIVE_TO", "ACTIVE_TO", "SHOW_COUNTER", "SHOW_COUNTER_START", "IBLOCK_TYPE_ID", "IBLOCK_ID", "IBLOCK_CODE", "IBLOCK_NAME", "IBLOCK_EXTERNAL_ID", "DATE_CREATE", "CREATED_BY", "CREATED_USER_NAME", "TIMESTAMP_X", "MODIFIED_BY", "USER_NAME", ""),
              "LIST_PROPERTY_CODE" => array("", "VACANCY", "COMPANY", "RESUME", "ID_USER", "", "", "", "", "", "", "", "", "", "", ""),
              "MESSAGE_404" => "",
              "META_DESCRIPTION" => "-",
              "META_KEYWORDS" => "-",
              "NEWS_COUNT" => "10",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => "rosvakant",
              "PAGER_TITLE" => "Новости",
              "PREVIEW_TRUNCATE_LEN" => "",
              "SEF_FOLDER" => "/account/user-feedback/",
              "SEF_MODE" => "Y",
              "SEF_URL_TEMPLATES" => Array(
                "detail" => "#ELEMENT_ID#/",
                "news" => "",
                "section" => ""
              ),
              "SET_LAST_MODIFIED" => "Y",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "Y",
              "SHOW_404" => "N",
              "SORT_BY1" => "TIMESTAMP_X",
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
          );?> <!-- component -->
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <br>
  <script src="/account/account.js"></script>
</main><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
