<?
define("HIDE_HEADER", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О компании"); ?>
<?php
global $USER;

vd($_POST, true);


class Resume
{

  private
    $arKeywords = [],
    $arErrors = [],
    $arEducation = [],
    $obUser,
    $req;

  function __construct($USER)
  {
    $this->req = $_POST["resume"];
    $this->obUser = $USER;
  }


  public function init()
  {
    $this->addEducation();
  }

  /**
   * Добавляем резюме
   */
  private function addResume()
  {


  }

  /**
   * Добавляем предыдущием места работы
   */
  private function addPrevWorks()
  {


  }


  /**
   * Добавляем образование
   */
  private function addEducation()
  {
    if (!empty($this->req["education"])) {
      foreach ($this->req["education"]["level"] as $k => $educationLevel) {
        if (!empty($educationLevel)) {
          $this->arEducation[$k] = [
            "NAME" => $this->obUser->GetLogin() . " " . $this->req["education"]["name"][$k],
            "PROPERTY_VALUES" => [
              "ID_USER" => $this->obUser->GetID(),
              "LEVEL" => $this->req["education"]["level"][$k],
              "SPECIAL" => $this->req["education"]["special"][$k],
              "DATE_START" => $this->req["education"]["date_start"][$k],
              "DATE_END" => $this->req["education"]["date_end"][$k],
            ],
            "DESCRIPTION" => $this->req["education"]["description"][$k]
          ];
        }
      }
    } else {
      echo "education null";
    }

  }

  /**
   * Добавляем ключевые слова
   */
  private function addKeyWords()
  {


  }

  /**
   * Загрузка файла аватара
   */
  private function uploadFile()
  {

    vd($_FILES, true);
  }

  /**
   * Поиск ключевых слов уже присутствующих в базе
   */
  private function getKeyWords()
  {
    if (!empty($_POST["keywords"])) {
      $this->arKeywords = explode(",", $_POST["keywords"]);
    }
    $res = CIBlockElement::GetList(
      [],
      [
        "IBLOCK_ID" => 40,
        "NAME" => $this->arKeywords
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "IBLOCK_SECTION_ID", "NAME"]
    );
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      $arCategories[$arFields["IBLOCK_SECTION_ID"]][$arFields["ID"]] = $arFields["NAME"];
    }
  }
}


$obResume = new Resume($USER);
$obResume->init();

/********************** добавление резюме **********************/


$arCategories = [];
$arSections = [];

$arSelect = ["ID", "IBLOCK_SECTION_ID", "NAME"];
$arFilter = ["IBLOCK_ID" => 41];
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 999), $arSelect);
while ($ob = $res->GetNextElement()) {
  $arFields = $ob->GetFields();
  $arCategories[$arFields["IBLOCK_SECTION_ID"]][$arFields["ID"]] = $arFields["NAME"];
}

$res = CIBlockSection::GetList(
  [],
  ["IBLOCK_ID" => 41],
  false,
  ["ID", "NAME"],
  ["nPageSize" => 999]
);
while ($section = $res->GetNextElement()) {
  $arFields = $section->GetFields();
  $arSections[$arFields["ID"]] = $arFields["NAME"];
}
?>
  <form enctype="multipart/form-data" action="" method="POST">

    <!-- Page header -->
    <header class="page-header">
      <div class="container page-name">
        <h1 class="text-center">Добавить новое резюме</h1>
        <p class="lead text-center" style="color: #666;">Для добавление нового резюме, заполните формы ниже</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <div class="form-group">
              <input type="file" name="resume[file]" class="dropify" data-default-file="/assets/img/avatar.jpg">
              <span class="help-block">Заргузите фотографию</span>
            </div>
          </div>

          <div class="col-xs-12 col-sm-8">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Ваше имя" name="resume[user_name]">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" placeholder="Заголовок резюме, например: Водитель-экспедитор"
                     name="resume[title]">
            </div>


            <div class="form-group">
              <select class="form-control selectpicker" name="resume[category]" multiple>
                <option selected disabled>Выберите категорию</option>
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


            <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Расскажите о себе"
                        name="resume[description]"></textarea>
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
                      /* "CODE" => "0000028023",
                       "ID" => "1",*/
                      "FILTER_BY_SITE" => "N",
                      "INITIALIZE_BY_GLOBAL_EVENT" => "",
                      "INPUT_NAME" => "resume[citi]",
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
                  <input type="text" class="form-control" placeholder="Сайт" name="resume[site]">
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" class="form-control" placeholder="Заработная плата/мес" name="resume[finance]">
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                  <input type="text" class="form-control datetimepicker" placeholder="День рождения"
                         name="resume[happy_day]">
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" placeholder="Номер телефона" name="resume[phone_number]">
                </div>
              </div>

              <div class="form-group col-xs-12 col-sm-6">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" class="form-control" placeholder="Email" name="resume[email]">
                </div>
              </div>

            </div>

            <hr class="hr-lg">

            <h6 style="color: #333;">Ключевые слова, навыки, специализации</h6>
            <div class="form-group">
              <input type="text" value="" data-role="tagsinput" placeholder="Введите название" name="resume[keywords]">
              <span
                  class="help-block">Укажите ключевое слово которое соотвествует вашей специлизации (и нажмите Enter)</span>
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
            <div class="col-xs-12">
              <div class="item-block">
                <div class="item-form">
                  <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Степень" name="resume[education][level][]">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Специализация"
                               name="resume[education][special][]">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Название учреждения"
                               name="resume[education][name][]">
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][date_start][]"
                                 placeholder="01.01.2012">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][date_end][]"
                                 placeholder="01.01.2016">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Краткое описание"
                                  name="resume[education][description][]"></textarea>
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
                        <input type="text" class="form-control" placeholder="Степень" name="resume[education][level][]">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Специализация"
                               name="resume[education][special][]">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Название учреждения"
                               name="resume[education][name][]">
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][date_start][]"
                                 placeholder="01.01.2012">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" name="resume[education][date_end][]"
                                 placeholder="01.01.2016">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Краткое описание"
                                  name="resume[education][description][]"></textarea>
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

            <div class="col-xs-12">
              <div class="item-block">
                <div class="item-form">
                  <button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Название компании"
                               name="resume[works][name_company][]">
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Место расположения"
                               name="resume[works][location][]">
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2012"
                                 name="resume[works][date_start][]">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2020"
                                 name="resume[works][date_end][]">
                        </div>
                      </div>

                    </div>

                    <div class="col-xs-12">
                      <div class="form-group">
                        <textarea class="form-control" placeholder="Краткое описание"
                                  name="resume[works][description][]"></textarea>
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
                               name="resume[works][name_company][]">
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Место расположениеr"
                               name="resume[works][location][]">
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">Дата начала</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2012"
                                 name="resume[works][date_start][]">
                          <span class="input-group-addon">Дата окончания</span>
                          <input type="text" class="form-control datetimepicker" placeholder="01.01.2020"
                                 name="resume[works][date_end][]">
                        </div>
                      </div>

                    </div>

                    <div class="col-xs-12">
                      <div class="form-group">
                        <textarea class="form-control" placeholder="Краткое описание"
                                  name="resume[works][description][]"></textarea>
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
            <h2>Отправить резюме</h2>
            <p>Пожалуйста проверьте все данные перед публикацией резюме</p>
          </header>

          <p class="text-center">
            <input type="submit" class="btn btn-success btn-xl btn-round" value="Отправить"/>
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

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>