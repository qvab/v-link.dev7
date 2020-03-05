<?
define("HIDE_HEADER", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавление вакансии");

$arCompany = getCurrentCompany();
$obVacancy = new Vacancy();

if (!empty($_POST) && !empty($_POST["save_company"])) {
  $res = $obVacancy->saveCompany();
}

if (!empty($_POST) && !empty($_POST["save_vacancy"])) {
  $res = $obVacancy->addVacancy();
}


?>
  <header class="page-header">
    <div class="container page-name">
      <h1 class="text-center">Добавить вакансию</h1>
      <p class="lead text-center" style="color: #666;">Для добавление новой вакансии, заполните формы ниже</p>
    </div>
  </header>

<form id="form-ajax-add-vacancy" method="POST" action="" enctype="multipart/form-data">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h6 style="text-align: center; color: #666;">Настроки компании</h6>
        <?php
        if (isset($_GET["success_company"])) {
          showBlockMessage("Настроки компании успешно сохранены");
        } elseif (isset($_GET["error_company"])) {
          showBlockMessage("В процессе добавление компании возникли ошибки");
        }

        if (isset($_GET["success_vacancy"])) {
          showBlockMessage("Вакансия успешно добавлена");
        } elseif (isset($_GET["success_vacancy"])) {
          showBlockMessage("В процессе добавление вакансии возникли ошибки");
        }
        ?><br />
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-lg-2">
            <div class="form-group">
              <input name="company[file]" type="file" class="dropify" data-default-file="<?php
              if (!empty($arCompany["fields"]["PREVIEW_PICTURE"])){
                echo CFile::GetPath($arCompany["fields"]["PREVIEW_PICTURE"]);
              } else {
                echo "/assets/img/logo-default.png";
              } ?>">
              <span class="help-block">Логотип компании</span>
            </div>
          </div>

          <div class="col-xs-12 col-sm-8 col-lg-10">
            <div class="form-group">
              <input type="text" name="company[name]" class="form-control input-lg" placeholder="Название компании" value="<?=$arCompany["fields"]["NAME"]?>" required>
            </div>
            <div class="form-group">
              <label>Описание компании</label>
              <div style="border: 1px #ccc solid;">
                <? $APPLICATION->IncludeComponent(
                  "bitrix:fileman.light_editor",
                  "",
                  Array(
                    "CONTENT" => $arCompany["fields"]["DETAIL_TEXT"],
                    "HEIGHT" => "300px",
                    "ID" => "",
                    "INPUT_ID" => "",
                    "INPUT_NAME" => "company[description]",
                    "JS_OBJ_NAME" => "",
                    "RESIZABLE" => "N",
                    "USE_FILE_DIALOGS" => "N",
                    "VIDEO_ALLOW_VIDEO" => "Y",
                    "VIDEO_BUFFER" => "20",
                    "VIDEO_LOGO" => "",
                    "VIDEO_MAX_HEIGHT" => "480",
                    "VIDEO_MAX_WIDTH" => "640",
                    "VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
                    "VIDEO_WINDOWLESS" => "Y",
                    "VIDEO_WMODE" => "transparent",
                    "WIDTH" => "100%"
                  )
                ); ?>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-xs-12">
        <h6 style="text-align: center; color: #666;">Основная информация о компании</h6>
        <div class="row">

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <? $APPLICATION->IncludeComponent(
                "bitrix:sale.location.selector.search",
                "",
                Array(
                  "ID" => $arCompany["property"]["REGION_COMPANY"]["VALUE"],
                  "CACHE_TIME" => "36000000",
                  "CACHE_TYPE" => "A",
                  "FILTER_BY_SITE" => "N",
                  "INITIALIZE_BY_GLOBAL_EVENT" => "",
                  "INPUT_NAME" => "company[citi]",
                  "JS_CALLBACK" => "",
                  "JS_CONTROL_GLOBAL_ID" => "",
                  "PROVIDE_LINK_BY" => "id",
                  "SHOW_DEFAULT_LOCATIONS" => "N",
                  "SUPPRESS_ERRORS" => "N"
                )
              ); ?>
            </div>
          </div>


          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-globe"></i></span>
              <input type="text" name="company[site]" class="form-control" placeholder="Сайт компании" value="<?=$arCompany["property"]["SITE"]["VALUE"]?>">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
              <input type="text" name="company[year]" class="form-control" placeholder="Год основания компании" value="<?=$arCompany["property"]["YEAR"]["VALUE"]?>">
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" name="company[phone_1]" class="form-control" placeholder="Номер телефона" value="<?=$arCompany["property"]["PHONE_1"]["VALUE"]?>" required>
            </div>
          </div>

          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" name="company[phone_2]" class="form-control" placeholder="Дополнительный Номер телефона" value="<?=$arCompany["property"]["PHONE_2"]["VALUE"]?>">
            </div>
          </div>


          <div class="form-group col-xs-12 col-sm-6 col-md-4">
            <div class="input-group input-group-sm">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="text" name="company[email]" class="form-control" placeholder="Email" value="<?=$arCompany["property"]["EMAIL"]["VALUE"]?>">
            </div>
          </div>

        </div>
        <div class="form-group">
          <div class="action-buttons" style="text-align: right;">
            <div class="upload-button">
              <button class="btn btn-block btn-primary" name="save_company" value="1">Сохранить компанию</button>
            </div>
          </div>
        </div>
      </div>
    </div>

      <h6 style="text-align: center; color: #666;">Добавить вакансию</h6>
    <div class="row">
      <div class="form-group col-xs-12 col-sm-6">
        <label>Название вакансии</label>
        <input type="text" name="vacancy[name]" class="form-control input-lg" placeholder="Заголовок вакансии">
      </div>
      <?php
      $arRes = getCategories();
      $arSchedule = getGrafic();
      $arTypeOFEmp = getTypeWork();

      $arSections = $arRes["sections"];
      $arCategories = $arRes["categories"];
      ?>
      <div class="form-group col-xs-12 col-sm-6">
        <label>Выберите специализации</label>
        <select class="form-control selectpicker" name="vacancy[categories][]" data-placeholder="Выберите категорию"
                multiple>
          <?php
          foreach ($arSections as $idSection => $nameSection) { ?>
            <optgroup label="<?= $nameSection ?>">
              <?php
              foreach ($arCategories[$idSection] as $idCategory => $nameCategory) { ?>
                <option value="<?= $idCategory ?>"><?= $nameCategory ?></option>
                <?php
              }
              ?>
            </optgroup>
            <?php
          }
          ?>
        </select>
      </div>

      <div class="form-group col-xs-12">
        <label>Краткое описание вакансии</label>
        <textarea class="form-control" name="vacancy[preview_text]" rows="3" placeholder="Описание вакансии"></textarea>
      </div>

      <hr class="hr-lg">

      <div class="form-group col-xs-12 col-sm-12 col-md-12">
        <label>Ключевые слова</label>
        <input type="text" value="" data-role="tagsinput" placeholder="Введите название" name="vacancy[keywords]">
        <span class="help-block">Укажите ключевое слово которое соотвествует специлизации (и нажмите Enter)</span>
      </div>

      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <label>Введите ваш город</label>
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
          <? $APPLICATION->IncludeComponent(
            "bitrix:sale.location.selector.search",
            "",
            Array(
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "FILTER_BY_SITE" => "N",
              "INITIALIZE_BY_GLOBAL_EVENT" => "",
              "INPUT_NAME" => "vacancy[city]",
              "JS_CALLBACK" => "",
              "JS_CONTROL_GLOBAL_ID" => "",
              "PROVIDE_LINK_BY" => "id",
              "SHOW_DEFAULT_LOCATIONS" => "N",
              "SUPPRESS_ERRORS" => "N"
            )
          ); ?>
        </div>
      </div>

      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <label>График работы</label>
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
          <select class="form-control selectpicker" name="vacancy[schedule][]" data-placeholder="График работы" multiple>
            <?php
            foreach ($arSchedule as $idCategory => $nameCategory) { ?>
              <option value="<?= $idCategory ?>"><?= $nameCategory["fields"]["NAME"] ?></option>
              <?php
            }
            ?>
          </select>
        </div>
      </div>


      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <label>Тип занятости</label>
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
          <select class="form-control selectpicker" name="vacancy[type_of_emp][]" data-placeholder="График работы" multiple>
            <?php
            foreach ($arTypeOFEmp as $idCategory => $nameCategory) { ?>
              <option value="<?= $idCategory ?>"><?= $nameCategory["fields"]["NAME"] ?></option>
              <?php
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
          <input type="text" name="vacancy[min_payment]" class="form-control" placeholder="Минимальная зарплата">
        </div>
      </div>

      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
          <input type="text" name="vacancy[max_payment]" class="form-control" placeholder="Максимальная зарплата">
        </div>
      </div>

      <div class="form-group col-xs-12 col-sm-6 col-md-4">
        <div class="input-group input-group-sm">
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
          <input type="text" name="vacancy[phone]" class="form-control" placeholder="Контактный телефон" required>
        </div>
      </div>


    </div>
  </div>


  <!-- Main container -->
  <main>


    <!-- Job detail -->
    <section>
      <div class="container">

        <header class="section-header">
          <h2>Детальное описание вакансии</h2>
        </header>
        <div style="border: 1px #ccc solid;">
          <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            Array(
              "CONTENT" => "",
              "HEIGHT" => "300px",
              "ID" => "",
              "INPUT_ID" => "",
              "INPUT_NAME" => "vacancy[description]",
              "JS_OBJ_NAME" => "",
              "RESIZABLE" => "N",
              "USE_FILE_DIALOGS" => "N",
              "VIDEO_ALLOW_VIDEO" => "Y",
              "VIDEO_BUFFER" => "20",
              "VIDEO_LOGO" => "",
              "VIDEO_MAX_HEIGHT" => "480",
              "VIDEO_MAX_WIDTH" => "640",
              "VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
              "VIDEO_WINDOWLESS" => "Y",
              "VIDEO_WMODE" => "transparent",
              "WIDTH" => "100%"
            )
          ); ?>
        </div>
      </div>
    </section>
    <!-- END Job detail -->


    <!-- Submit -->
    <section class=" bg-img" style="background-image: url(/assets/img/bg-facts.jpg);">
      <div class="container">
        <header class="section-header">
          <h2>Создать вакансию</h2>
          <p>Пожалуйста проверьте все данные перед публикацией</p>
        </header>

        <p class="text-center">
          <input type="submit" name="save_vacancy" class="btn btn-success btn-xl btn-round" value="Отправить"/>
        </p>

      </div>
    </section>
    <!-- END Submit -->


  </main>
  <!-- END Main container -->
</form>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
