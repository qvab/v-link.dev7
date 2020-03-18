<?
define("HIDE_HEADER", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование резюме");
require_once $_SERVER["DOCUMENT_ROOT"]."/account/RVAccount.php";
global $USER;


$RV = new RVAccount();
$arCompany = getCurrentCompany();

if (!empty($_POST) && !empty($_POST["save_company"])) {
  $res = $RV->saveCompany();
}

if (!empty($_POST) && !empty($_POST["save_vacancy"])) {
  $bUpdate = $RV->updateVacancy();
}




$arSchedule = getGrafic();
$arTypeOFEmp = getTypeWork();
$arPath = getCategories();
$arSections = $arPath["sections"];
$arCategories = $arPath["categories"];


if (!empty($_GET["id"])) {
  $arVacancy = $RV->getVacancyByID($_GET["id"]);
}
?>
<header class="page-header">
  <div class="container page-name">
    <h1 class="text-center">Редактировать вакансию</h1>
    <p class="lead text-center" style="color: #666;">Настройки компании для всех вакансий являеться глобальной</p>
    <a class="btn btn-black" href="/account/vacancy/">Назад к списку вакансий</a>
  </div>
</header>

<form id="form-ajax-add-vacancy" method="POST" action="" enctype="multipart/form-data">
  <input type="hidden" name="update_vacancy_id" value="<?=$_GET["id"]?>" />
  <input type="hidden" name="vacancy[PROPERTY][COMPANY]" value="<?=$arCompany["fields"]["ID"]?>" />

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h6 style="text-align: center; color: #666;">Настроки компании</h6>
        <?php
        if (isset($_GET["success_company"])) {
          showBlockMessage("Настроки компании успешно сохранены");
        } elseif (isset($_GET["error_company"])) {
          showBlockMessage("В процессе добавление компании возникли ошибки", "error");
        }

        if (isset($_GET["success_vacancy"])) {
          showBlockMessage("Вакансия успешно обновлена");
        } elseif (isset($_GET["success_vacancy"])) {
          showBlockMessage("В процессе обновления вакансии возникли ошибки", "error");
        }

        if (!$USER->IsAuthorized()) {
        showBlockMessage("Ошибка авторизации", "error");
        ?><br/></div>
    </div>
  </div>
</form>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
exit();
}
if (empty($arVacancy) || empty($_GET["id"])) {
  showBlockMessage("Вакансии с таким идинтификатор не найдено", "error");

  ?><br/></div>
  </div>
  </div>
  </form>
  <?php
  require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
  exit();
}


?>


<br/>
<div class="row">
  <div class="col-xs-12 col-sm-4 col-lg-2">
    <div class="form-group">
      <input name="company[file]" type="file" class="dropify" data-default-file="<?php
      if (!empty($arCompany["fields"]["PREVIEW_PICTURE"])) {
        echo CFile::GetPath($arCompany["fields"]["PREVIEW_PICTURE"]);
      } else {
        echo "/assets/img/logo-default.png";
      } ?>">
      <span class="help-block">Логотип компании</span>
    </div>
  </div>


  <div class="col-xs-12 col-sm-8 col-lg-10">
    <div class="form-group">
      <input type="text" name="company[name]" class="form-control input-lg" placeholder="Название компании"
             value="<?=$arCompany["fields"]["NAME"]?>" required>
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
        <input type="text" name="company[site]" class="form-control" placeholder="Сайт компании"
               value="<?=$arCompany["property"]["SITE"]["VALUE"]?>">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
        <input type="text" name="company[year]" class="form-control" placeholder="Год основания компании"
               value="<?=$arCompany["property"]["YEAR"]["VALUE"]?>">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        <input type="text" name="company[phone_1]" class="form-control" placeholder="Номер телефона"
               value="<?=$arCompany["property"]["PHONE_1"]["VALUE"]?>">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        <input type="text" name="company[phone_2]" class="form-control" placeholder="Дополнительный Номер телефона"
               value="<?=$arCompany["property"]["PHONE_2"]["VALUE"]?>">
      </div>
    </div>


    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
        <input type="text" name="company[email]" class="form-control" placeholder="Email"
               value="<?=$arCompany["property"]["EMAIL"]["VALUE"]?>">
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

<h6 style="text-align: center; color: #666;">Редактировать вакансию</h6>
<div class="row">
  <div class="form-group col-xs-12 col-sm-6">
    <label>Название вакансии</label>
    <input type="text" name="vacancy[NAME]" class="form-control input-lg" placeholder="Заголовок вакансии"
           value="<?=$arVacancy["NAME"]?>">
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
    <select class="form-control selectpicker" name="vacancy[PROPERTY][CATEGORIES][]"
            data-placeholder="Выберите категорию"
            multiple>
      <?php
      foreach ($arSections as $idSection => $nameSection) { ?>
        <optgroup label="<?=$nameSection?>">
          <?php
          foreach ($arCategories[$idSection] as $idCategory => $nameCategory) { ?>
            <option <?=in_array($idCategory, $arVacancy["PROPERTY"]["CATEGORIES"]) ? "selected" : "";?>
                value="<?=$idCategory?>"><?=$nameCategory?></option>
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
    <textarea class="form-control" name="vacancy[PREVIEW_TEXT]" rows="3"
              placeholder="Описание вакансии"><?=$arVacancy["PREVIEW_TEXT"]?></textarea>
  </div>

  <hr class="hr-lg">

  <div class="form-group col-xs-12 col-sm-12 col-md-12">
    <label>Ключевые слова</label>
    <input type="text" data-role="tagsinput" placeholder="Введите название" name="vacancy[PROPERTY][KEY_WORDS]"
           value="<?=$arVacancy["PROPERTY"]["KEY_WORDS"]?>">
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
          "ID" => $arVacancy["PROPERTY"]["CITY"],
          "FILTER_BY_SITE" => "N",
          "INITIALIZE_BY_GLOBAL_EVENT" => "",
          "INPUT_NAME" => "vacancy[PROPERTY][CITY]",
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
      <select class="form-control selectpicker" name="vacancy[PROPERTY][SCHEDULE][]" data-placeholder="График работы"
              multiple>
        <?php
        foreach ($arSchedule as $idCategory => $nameCategory) { ?>
          <option <?=in_array($idCategory, $arVacancy["PROPERTY"]["SCHEDULE"]) ? "selected" : "";?>
              value="<?=$idCategory?>"><?=$nameCategory["fields"]["NAME"]?></option>
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
      <select class="form-control selectpicker" name="vacancy[PROPERTY][TYPE_OF_EMP][]" data-placeholder="График работы"
              multiple>
        <?php
        foreach ($arTypeOFEmp as $idCategory => $nameCategory) { ?>
          <option <?=in_array($idCategory, $arVacancy["PROPERTY"]["TYPE_OF_EMP"]) ? "selected" : "";?>
              value="<?=$idCategory?>"><?=$nameCategory["fields"]["NAME"]?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group col-xs-12 col-sm-6 col-md-4">
    <div class="input-group input-group-sm">
      <span class="input-group-addon"><i class="fa fa-money"></i></span>
      <input type="text" name="vacancy[PROPERTY][MIN_PAYMENT]" class="form-control" placeholder="Минимальная зарплата"
             value="<?=$arVacancy["PROPERTY"]["MIN_PAYMENT"]?>">
    </div>
  </div>

  <div class="form-group col-xs-12 col-sm-6 col-md-4">
    <div class="input-group input-group-sm">
      <span class="input-group-addon"><i class="fa fa-money"></i></span>
      <input type="text" name="vacancy[PROPERTY][MAX_PAYMENT]" class="form-control" placeholder="Максимальная зарплата"
             value="<?=$arVacancy["PROPERTY"]["MAX_PAYMENT"]?>">
    </div>
  </div>

  <div class="form-group col-xs-12 col-sm-6 col-md-4">
    <div class="input-group input-group-sm">
      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
      <input type="text" name="vacancy[PROPERTY][PHONE]" class="form-control" placeholder="Контактный телефон"  value="<?=$arVacancy["PROPERTY"]["PHONE"]?>">
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
            "CONTENT" => $arVacancy["DETAIL_TEXT"],
            "HEIGHT" => "300px",
            "ID" => "",
            "INPUT_ID" => "",
            "INPUT_NAME" => "vacancy[DETAIL_TEXT]",
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
        <h2>Обновить вакансию</h2>
        <p>Пожалуйста проверьте все данные перед обновлением</p>
      </header>

      <p class="text-center">
        <input type="submit" name="save_vacancy" class="btn btn-success btn-xl btn-round" value="Обновить"/>
      </p>

    </div>
  </section>
  <!-- END Submit -->


</main>
<!-- END Main container -->
</form>


<script src="/assets/js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" href="/assets/js/jquery.datetimepicker.min.css"/>
<script>
  $('.datetimepicker').datetimepicker({
    timepicker: false,
    format: 'd.m.Y',
    formatDate: 'd.m.Y'
  });
  $.datetimepicker.setLocale('ru');
</script>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
