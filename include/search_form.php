<?php

$arPayment = [];
if (!empty($_GET["search"]["payment"])) {
  $arPayment = explode(";", $_GET["search"]["payment"]);
}
$sPath = parse_url($_SERVER["REQUEST_URI"])["path"];
if ($sPath == "/vacancy/") {
  $sTypeListPage = "vacancy";
} else {
  $sTypeListPage = "resume";
}

$arListFilter = [
  "min_payment" => !empty($arPayment[0]) ? $arPayment[0] : 0,
  "max_payment" => !empty($arPayment[1]) ? $arPayment[1] : 50000,
  "region" => !empty($_GET["search"]["region"]) ? $_GET["search"]["region"] : false,
  "schedule" => !empty($_GET["search"]["schedule"]) ? $_GET["search"]["schedule"] : [],
  "type_of_emp" => !empty($_GET["search"]["type_of_emp"]) ? $_GET["search"]["type_of_emp"] : [],
  "categories" => !empty($_GET["search"]["categories"]) ? $_GET["search"]["categories"] : [],
  "key" => !empty($_GET["search"]["key"]) ? $_GET["search"]["key"] : "",
  "typekey" => !empty($_GET["search"]["typekey"]) ? $_GET["search"]["typekey"] : "",
];

?><div class="container">
  <form action="" method="GET">
    <div class="row">
      <div class="form-group col-xs-12 col-sm-4">
        <h6>Название и ключевые слова</h6>
        <input type="text" name="search[key]" id="search-key" placeholder="Ключевые слова, названия специализации" class="input-group form-control" autocomplete="off" value="<?=$arListFilter["key"]?>"/>
        <input type="hidden" id="search-typekey" name="search[typekey]" value="<?=$arListFilter["typekey"]?>" />
        <div id="result-search-key"></div>
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <h6>Месторасположение</h6>
        <? $APPLICATION->IncludeComponent(
          "bitrix:sale.location.selector.search",
          "",
          Array(
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "FILTER_BY_SITE" => "N",
            "INITIALIZE_BY_GLOBAL_EVENT" => "",
            "INPUT_NAME" => "search[region]",
            "JS_CALLBACK" => "",
            "JS_CONTROL_GLOBAL_ID" => "",
            "PROVIDE_LINK_BY" => "id",
            "SHOW_DEFAULT_LOCATIONS" => "N",
            "SUPPRESS_ERRORS" => "N"
          )
        );
        ?>
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <h6>Выберите специализации</h6>
        <select class="form-control selectpicker" name="search[categories][]" data-placeholder="Выберите категорию"
                multiple>
          <?php
          foreach ($arSections as $idSection => $nameSection) { ?>
            <optgroup label="<?= $nameSection ?>">
              <?php
              foreach ($arCategories[$idSection] as $idCategory => $nameCategory) {
                if (!in_array($idCategory, $arListFilter["categories"])) { ?>
                  <option value="<?=$idCategory?>"><?=$nameCategory?></option>
                  <?php
                } else { ?>
                  <option selected value="<?=$idCategory?>"><?=$nameCategory?></option>
                  <?php
                }
              }
              ?>
            </optgroup>
            <?php
          }
          ?>
        </select>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Уровень зарплаты (руб)</h6>
        <input type="text" id="range" value="" name="search[payment]"/>
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <h6>Тип занятости</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="type_of_emp" name="search[type_of_emp][]"  <?=empty( $arListFilter["type_of_emp"]) ? "checked" : ""?>>
            <label for="type_of_emp-<?=$idType?>">Любое</label>
          </div>
          <?php foreach ($arTypeOFEmp as $idType => $arType) { ?>
            <div class="checkbox">
              <input type="checkbox" id="type_of_emp-<?=$idType?>" name="search[type_of_emp][]" value="<?=$arType["fields"]["ID"]?>" <?=in_array($idType, $arListFilter["type_of_emp"]) ? "checked" : ""?>>
              <label for="type_of_emp-<?=$idType?>"><?=$arType["fields"]["NAME"]?></label>
            </div>
            <?php
          }
          ?>
        </div>
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <h6>График работы</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="schedule" name="search[schedule][]" <?=empty( $arListFilter["type_of_emp"]) ? "checked" : ""?>>
            <label for="schedule">Любое</label>
          </div>
          <?php foreach ($arSchedule as $idType => $arType) { ?>
            <div class="checkbox">
              <input type="checkbox" id="schedule-<?=$idType?>" name="search[schedule][]" value="<?=$arType["fields"]["ID"]?>" <?=in_array($idType, $arListFilter["schedule"]) ? "checked" : ""?>>
              <label for="schedule-<?=$idType?>"><?=$arType["fields"]["NAME"]?></label>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>

    <div class="button-group">
      <?php if (!empty($_GET["search"])) {?>
        <div class="action-buttons">
          <a href="/<?=$sTypeListPage?>/" class="btn btn-black">Сбросить фильтр</a>
        </div>
        <?php
      }
      ?>
      <div class="action-buttons">
        <button class="btn btn-primary">Поиск</button>
      </div>

    </div>

  </form>

</div>
<script src="/assets/js/core_rv.js"></script>
<script>
  RV.searchKey("#search-key", "#result-search-key", "#search-typekey", "resume");
</script>
<script src="/assets/js/ion.rangeSlider.js"></script>
<script>
  $("#range").ionRangeSlider({
    hide_min_max: true,
    keyboard: true,
    min: 0,
    max: 300000,
    from: <?=$arListFilter["min_payment"]?>,
    to: <?=$arListFilter["max_payment"]?>,
    type: 'double',
    step: 1000,
    prefix: "",
    grid: true
  });
</script>