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

<div class="container page-name">
  <h1 class="text-center white">Поиск вакансий</h1>
</div>
<div class="container">
  <form action="#">

    <div class="row">
      <div class="form-group col-xs-12 col-sm-4">
        <input type="text" class="form-control" placeholder="Ключевые слова, названия специализации">
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <input type="text" class="form-control" placeholder="Регион">
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <select class="form-control selectpicker" multiple>
          <option selected>Все категории</option>
          <option>Тестовая категория 1</option>
          <option>Тестовая категория 2</option>
        </select>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Уровень зарплаты (руб)</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="rate1" name="rate" checked>
            <label for="rate1">Любая зарплата</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate2" name="rate">
            <label for="rate2">до 10 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate3" name="rate">
            <label for="rate3">10 000 - 30 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate4" name="rate">
            <label for="rate4">30 000 - 100 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate5" name="rate">
            <label for="rate5">100 000 - 300 000</label>
          </div>
        </div>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Уровень образования</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="degree1" name="degree" checked>
            <label for="degree1">Любое</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree2" name="degree">
            <label for="degree2">Среднее</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree3" name="degree">
            <label for="degree3">Средне-специальное</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree4" name="degree">
            <label for="degree4">Высшее</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree5" name="degree">
            <label for="degree5">Несколько высших</label>
          </div>
        </div>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Сортировка</h6>
        <div class="radio">
          <input type="radio" name="sortby" id="sortby1" value="option1" checked>
          <label for="sortby1">По реливатности</label>
        </div>

        <div class="radio">
          <input type="radio" name="sortby" id="sortby2" value="option2">
          <label for="sortby2">Сначала новые</label>
        </div>

        <div class="radio">
          <input type="radio" name="sortby" id="sortby3" value="option3">
          <label for="sortby3">Сначала старые</label>
        </div>


      </div>


    </div>

    <div class="button-group">
      <div class="action-buttons">
        <button class="btn btn-primary">Поиск</button>
      </div>
    </div>

  </form>

</div>

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
          $arCompany = $obCompany->GetNext();
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
          }
          elseif (
            empty($arItem["PROPERTIES"]["MAX_PAYMENT"]["VALUE"])
            && !empty($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"])
          ) {
            $sPayment = "От ".finance($arItem["PROPERTIES"]["MIN_PAYMENT"]["VALUE"]);
          }


          $arProp = [
            "company" => $arCompany["NAME"],
            "location" => $sNameLocation,
            "payment" => $sPayment,
            "image" => !empty($arItem["PREVIEW_PICTURE"]["SRC"]) ? $arItem["PREVIEW_PICTURE"]["SRC"] : "/img/not-avatar.png"
          ];
          ?>
          <div class="col-sm-12 col-md-6">
            <a class="item-block" href="/vacancy/<?=$arItem["ID"]?>/">
              <header>
                <img class="resume-avatar" src="<?=$arProp["image"]?>" alt="">
                <div class="hgroup">
                  <h4><?=$arItem["NAME"]?></h4>
                  <h5><?=$arProp["company"]?></h5>
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


