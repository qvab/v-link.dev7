<?
define("HIDE_HEADER", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование резюме");
require_once $_SERVER["DOCUMENT_ROOT"]."/account/RVAccount.php";
$RV = new RVAccount();
global $USER;

if (!empty($_POST["update_resume_id"])) {
  $bUpdate = $RV->updateResume();
}


$arSchedule = getGrafic();
$arTypeOFEmp = getTypeWork();
$arPath = getCategories();
$arSections = $arPath["sections"];
$arCategories = $arPath["categories"];


if (!empty($_GET["id"])) {
  $arResume = $RV->getResumeByID($_GET["id"]);
}
?>
<form enctype="multipart/form-data" action="" method="POST">
  <input type="hidden" name="update_resume_id" value="<?=$_GET["id"]?>" />
  <!-- Page header -->
  <header class="page-header">
    <div class="container page-name">
      <h1 class="text-center">Редактирование резюме</h1>
      <p class="lead text-center" style="color: #666;">Для добавление нового резюме, заполните формы ниже</p>
      <a class="btn btn-black" href="/account/">Назад к списку резюме</a>
      <?php if (!empty($bUpdate)) { ?>
        <div class="success-resume" style="
    text-align: center;
    color: #fff;
    background-color: #30AB1E;
    padding: 25px;
    /* max-width: 270px; */
    margin: 0 auto;
    border-radius: 16px;
">Резюме успешно обновленно
        </div>
        <?php
      } elseif (empty($bUpdate) && !empty($_POST)) { ?>
        <div class="success-resume" style="
    text-align: center;
    color: #fff;
    background-color: #ff7e00;
    padding: 25px;
    /* max-width: 270px; */
    margin: 0 auto;
    border-radius: 16px;
">Произошла ошибка при обновление
        </div>
        <?php
      }
      ?>
    </div>
    <?php if (!$USER->IsAuthorized()) { ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-4">Вы не авторизованы!</div>
      </div>
    </div>
  </header>
      <?php
      require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
      exit();
    }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-4">
          <div class="form-group">
            <input type="file" data-default-file="<?=$arResume["DETAIL_PICTURE"]?>"
                   value="<?=$arResume["DETAIL_PICTURE"]?>" name="file" class="dropify">
            <span class="help-block">Заргузите фотографию</span>
          </div>
        </div>

        <div class="col-xs-12 col-sm-8">
          <div class="form-group">
            <input type="text" class="form-control input-lg" placeholder="Ваше имя" name="resume[user][USER_NAME]" value="<?=$arResume["USER_NAME"]?>">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" placeholder="Заголовок резюме, например: Водитель-экспедитор"
                   name="resume[NAME]" value="<?=$arResume["NAME"]?>">
          </div>


          <div class="form-group">
            <label>Выберите специализации</label>
            <select class="form-control selectpicker" name="resume[PROPERTY][CATEGORIES]" data-placeholder="Выберите категорию"
                    multiple>
              <?php
              foreach ($arSections as $idSection => $nameSection) { ?>
                <optgroup label="<?=$nameSection?>">
                  <?php
                  foreach ($arCategories[$idSection] as $idCategory => $nameCategory) { ?>
                    <option <?=in_array($idCategory, $arResume["CATEGORIES"]) ? "selected" : "";?>
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

          <div class="form-group">
            <label>Выберите ваш пол</label>
            <select class="form-control selectpicker" name="resume[PROPERTY][GENDER]" data-placeholder="Выберите пол">
              <option value="70" <?=$arResume["GENDER"] == 70 ? "selected" : ""?>>Мужской</option>
              <option value="71" <?=$arResume["GENDER"] == 71 ? "selected" : ""?>>Женский</option>
            </select>
          </div>

          <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Расскажите о себе"
                        name="resume[DETAIL_TEXT]"><?=$arResume["DETAIL_TEXT"]?></textarea>
          </div>

          <hr class="hr-lg">

          <h6 style="color: #333;">Основная информация</h6>
          <div class="row">

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <? $APPLICATION->IncludeComponent(
                  "bitrix:sale.location.selector.search",
                  "",
                  Array(
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "ID" => $arResume["ID_LOCATION"],
                    "FILTER_BY_SITE" => "N",
                    "INITIALIZE_BY_GLOBAL_EVENT" => "",
                    "INPUT_NAME" => "resume[PROPERTY][ID_LOCATION]",
                    "JS_CALLBACK" => "",
                    "JS_CONTROL_GLOBAL_ID" => "",
                    "PROVIDE_LINK_BY" => "id",
                    "SHOW_DEFAULT_LOCATIONS" => "N",
                    "SUPPRESS_ERRORS" => "N"
                  )
                ); ?>
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                <input type="text" class="form-control" placeholder="Сайт" name="resume[PROPERTY][SITE]">
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                <input type="text" class="form-control" placeholder="Заработная плата/мес" name="resume[PROPERTY][PAYMENT]"
                       value="<?=$arResume["PAYMENT"]?>">
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                <input type="text" class="form-control datetimepicker" placeholder="День рождения"
                       name="resume[PROPERTY][HAPPY_DAY]" value="<?=$arResume["HAPPY_DAY"]?>">
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" placeholder="Номер телефона" name="resume[PROPERTY][PHONE]"
                       value="<?=$arResume["PHONE"]?>">
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" placeholder="Email" name="resume[PROPERTY][EMAIL]"
                       value="<?=$arResume["EMAIL"]?>">
              </div>
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <label>График работы</label>
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                <select class="form-control selectpicker" name="resume[PROPERTY][SCHEDULE][]" data-placeholder="График работы"
                        multiple>
                  <?php
                  foreach ($arSchedule as $idCategory => $nameCategory) { ?>
                    <option <?=in_array($idCategory, $arResume["SCHEDULE"]) ? "selected" : "";?>
                        value="<?=$idCategory?>"><?=$nameCategory["fields"]["NAME"]?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>


            <div class="form-group col-xs-12 col-sm-6">
              <label>Тип занятости</label>
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                <select class="form-control selectpicker" name="resume[PROPERTY][TYPE_OF_EMP][]" data-placeholder="График работы"
                        multiple>
                  <?php
                  foreach ($arTypeOFEmp as $idCategory => $nameCategory) { ?>
                    <option <?=in_array($idCategory, $arResume["TYPE_OF_EMP"]) ? "selected" : "";?>
                        value="<?=$idCategory?>"><?=$nameCategory["fields"]["NAME"]?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>

          </div>

          <hr class="hr-lg">

          <h6 style="color: #333;">Ключевые слова, навыки, специализации</h6>
          <div class="form-group">
            <input type="text" value="<?=$arResume["KEY_WORDS"]?>" data-role="tagsinput" placeholder="Введите название"
                   name="resume[PROPERTY][KEY_WORDS]">
            <span class="help-block">Укажите ключевое слово которое соотвествует вашей специлизации (и нажмите Enter)</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- END Page header -->


  <!-- Main container -->
  <main>

    <?php /*
      <!-- Social media -->
      <section>
        <div class="container">

          <header class="section-header">
            <span>Get connected</span>
            <h2>Social media</h2>
          </header>

          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dribbble"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-pinterest"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-github"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
                  <input type="text" class="form-control" placeholder="Profile URL">
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- Social media -->
*/
    ?>


    <!-- Education -->
    <section class=" bg-alt">
      <div class="container">

        <header class="section-header">
          <h2>Образование</h2>
        </header>
        <div class="row">

          <?php
          foreach ($arResume["EDUCATIONS"] as $idEducation => $arEducation) {
            ?>
            <input type="hidden" name="resume[edit][education][id][]" value="<?=$idEducation?>" />
            <input type="hidden" name="resume[edit][education][index][]" value="" />

            <div class="col-xs-12">
              <div class="item-block">
                <div class="item-form">
                  <button class="btn btn-danger btn-float btn-remove" data-id="<?=$idEducation?>"><i class="ti-close"></i></button>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Степень"
                               name="resume[education][PROPERTY][LEVEL][]" value="<?=$arEducation["prop"]["LEVEL"]["VALUE"]?>">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Специализация"
                               name="resume[education][PROPERTY][SPECIAL][]" value="<?=$arEducation["prop"]["SPECIAL"]["VALUE"]?>">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Название учреждения"
                               name="resume[education][PROPERTY][NAME_EDUCATION][]" value="<?=$arEducation["prop"]["NAME_EDUCATION"]["VALUE"]?>">
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_START][]"
                                 placeholder="01.01.2012" value="<?=date("d.m.Y", strtotime($arEducation["prop"]["DATE_START"]["VALUE"]))?>">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_END][]"
                                 placeholder="01.01.2016" value="<?=date("d.m.Y", strtotime($arEducation["prop"]["DATE_END"]["VALUE"]))?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Краткое описание"
                                  name="resume[education][DETAIL_TEXT][]"><?=$arEducation["fields"]["DETAIL_TEXT"]?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
          <div class="col-xs-12">
            <div class="item-block">
              <div class="item-form">
                <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Степень"
                             name="resume[education][PROPERTY][LEVEL][]">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Специализация"
                             name="resume[education][PROPERTY][SPECIAL][]">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Название учреждения"
                             name="resume[education][PROPERTY][NAME_EDUCATION][]">
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">Дата начала</span>
                        <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_START][]"
                               placeholder="01.01.2012">
                        <span class="input-group-addon">Дата окончания</span>
                        <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_END][]"
                               placeholder="01.01.2016">
                      </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Краткое описание"
                                  name="resume[education][DETAIL_TEXT][]"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-xs-12 duplicateable-content">
            <div class="item-block">
              <div class="item-form">
                <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Степень"
                             name="resume[education][PROPERTY][LEVEL][]">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Специализация"
                             name="resume[education][PROPERTY][SPECIAL][]">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Название учреждения"
                             name="resume[education][PROPERTY][NAME_EDUCATION][]">
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">Дата начала</span>
                        <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_START][]"
                               placeholder="01.01.2012">
                        <span class="input-group-addon">Дата окончания</span>
                        <input type="text" class="form-control datetimepicker" name="resume[education][PROPERTY][DATE_END][]"
                               placeholder="01.01.2016">
                      </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Краткое описание"
                                  name="resume[education][DETAIL_TEXT][]"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 text-center">
            <br>
            <button class="btn btn-primary btn-duplicator">Добавить еще</button>
          </div>


        </div>
      </div>
    </section>
    <!-- END Education -->


    <!-- Work Experience -->
    <section>
      <div class="container">
        <header class="section-header">
          <h2>Предыдущие места работы</h2>
        </header>

        <div class="row">

          <?php

          foreach ($arResume["PREV_WORKS"] as $idPrevWork => $arPrevWork) {
            ?>
            <input type="hidden" name="resume[edit][prev_work][id][]" value="<?=$idPrevWork?>" />
            <input type="hidden" name="resume[edit][prev_work][index][]" value="" />
            <div class="col-xs-12">
              <div class="item-block">
                <div class="item-form">
                  <button class="btn btn-danger btn-float btn-remove delete-prev-work" data-id="<?=$idPrevWork?>
."><i class="ti-close"></i></button>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Название компании"
                               name="resume[works][PROPERTY][NAME_ORG][]"
                               value="<?=$arPrevWork["prop"]["NAME_ORG"]["VALUE"]?>">
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Специальность"
                               name="resume[works][PROPERTY][SPECIAL][]" value="<?=$arPrevWork["prop"]["SPECIAL"]["VALUE"]?>">
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Место расположения"
                               name="resume[works][PROPERTY][LOCATION][]" value="<?=$arPrevWork["prop"]["LOCATION"]["VALUE"]?>">
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2012"
                                 name="resume[works][PROPERTY][DATE_START][]"
                                 value="<?=date("d.m.Y", strtotime($arPrevWork["prop"]["DATE_START"]["VALUE"]))?>">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2020"
                                 name="resume[works][PROPERTY][DATE_END][]"
                                 value="<?=date("d.m.Y", strtotime($arPrevWork["prop"]["DATE_END"]["VALUE"]))?>">
                        </div>
                      </div>

                    </div>

                    <div class="col-xs-12">
                      <div class="form-group">
                        <textarea class="form-control" placeholder="Краткое описание"
                                  name="resume[works][DETAIL_TEXT][]"><?=$arPrevWork["fields"]["DETAIL_TEXT"]?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php

          }

          ?>

          <div class="col-xs-12">
            <div class="item-block">
              <div class="item-form">
                <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Название компании"
                             name="resume[works][PROPERTY][NAME_ORG][]">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Специальность"
                             name="resume[works][PROPERTY][SPECIAL][]">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Место расположения"
                             name="resume[works][PROPERTY][LOCATION][]">
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">Дата начала</span>
                        <input type="text" class="form-control datetimepicker" placeholder="01.01.2012"
                               name="resume[works][PROPERTY][DATE_START][]">
                        <span class="input-group-addon">Дата окончания</span>
                        <input type="text" class="form-control datetimepicker" placeholder="01.01.2020"
                               name="resume[works][PROPERTY][DATE_END][]">
                      </div>
                    </div>

                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Краткое описание"
                                  name="resume[works][DETAIL_TEXT][]"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 duplicateable-content">
            <div class="item-block">
              <div class="item-form">
                <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Название компании"
                             name="resume[works][PROPERTY][NAME_ORG][]">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Специальность"
                             name="resume[works][PROPERTY][SPECIAL][]">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Место расположения"
                             name="resume[works][PROPERTY][LOCATION][]">
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">Дата начала</span>
                        <input type="text" class="form-control datetimepicker" placeholder="01.01.2012"
                               name="resume[works][PROPERTY][DATE_START][]">
                        <span class="input-group-addon">Дата окончания</span>
                        <input type="text" class="form-control datetimepicker" placeholder="01.01.2020"
                               name="resume[works][PROPERTY][DATE_END][]">
                      </div>
                    </div>

                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Краткое описание"
                                  name="resume[works][DETAIL_TEXT][]"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 text-center">
            <br>
            <button class="btn btn-primary btn-duplicator">Добавить еще</button>
          </div>


        </div>

      </div>
    </section>
    <!-- END Work Experience -->

    <?php /*
      <!-- Skills -->
      <section class=" bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Expertise Areas</span>
            <h2>Skills</h2>
          </header>

          <div class="row">

            <div class="col-xs-12">
              <div class="item-block">
                <div class="item-form">

                  <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Skill name, e.g. HTML">
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">

                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Skill proficiency, e.g. 90">
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-xs-12 duplicateable-content">
              <div class="item-block">
                <div class="item-form">

                  <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Skill name, e.g. HTML">
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">

                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Skill proficiency, e.g. 90">
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-xs-12 text-center">
              <br>
              <button class="btn btn-primary btn-duplicator">Add experience</button>
            </div>


          </div>

        </div>
      </section>
      <!-- END Skills -->

*/
    ?>
    <!-- Submit -->
    <section class=" bg-img" style="background-image: url(/assets/img/bg-facts.jpg);">
      <div class="container">
        <header class="section-header">
          <h2>Сохранить резюме</h2>
          <p>Пожалуйста проверьте все данные перед публикацией резюме</p>
        </header>

        <p class="text-center">
          <input type="submit" class="btn btn-success btn-xl btn-round" value="Сохранить резюме"/>
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
