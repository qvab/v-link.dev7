<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск резюме");
?>
<?php /*
  <div class="container page-name">
    <h1 class="text-center white">Поиск резюме</h1>
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
            <h5>Найдено <strong>1</strong> резюме</h5>
          </div>
        </div>

        <div class="row">
          <!-- Resume detail -->
          <div class="col-sm-12 col-md-6">
            <a class="item-block" href="<?=TEMPLATE?>page.detail_resume.php">
              <header>
                <img class="resume-avatar" src="<?=TEMPLATE_T?>assets/img/avatar-1.jpg" alt="">
                <div class="hgroup">
                  <h4>Михаил Мишанин</h4>
                  <h5>Веб-разработчик</h5>
                </div>
              </header>

              <div class="item-body">
                <p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от
                  всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой
                  друг, так упоен ощущением покоя, </p>

                <div class="tag-list">
                  <span>HTML</span>
                  <span>CSS</span>
                  <span>JavaScript</span>
                </div>
              </div>

              <footer>
                <ul class="details cols-2">
                  <li>
                    <i class="fa fa-map-marker"></i>
                    <span>Россия, Самара</span>
                  </li>

                  <li>
                    <i class="fa fa-money"></i>
                    <span>150 000 руб. / мес.</span>
                  </li>
                </ul>
              </footer>
            </a>
          </div>
          <!-- END Resume detail -->
        </div>
      </div>
    </section>
  </main>
*/ ?>
<?$APPLICATION->IncludeComponent(
  "bitrix:news",
  "rosvakant",
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
    "DETAIL_FIELD_CODE" => array("ID","CODE","XML_ID","NAME","TAGS","SORT","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM","ACTIVE_FROM","DATE_ACTIVE_TO","ACTIVE_TO","SHOW_COUNTER","SHOW_COUNTER_START","IBLOCK_TYPE_ID","IBLOCK_ID","IBLOCK_CODE","IBLOCK_NAME","IBLOCK_EXTERNAL_ID","DATE_CREATE","CREATED_BY","CREATED_USER_NAME","TIMESTAMP_X","MODIFIED_BY","USER_NAME",""),
    "DETAIL_PAGER_SHOW_ALL" => "Y",
    "DETAIL_PAGER_TEMPLATE" => "",
    "DETAIL_PAGER_TITLE" => "Страница",
    "DETAIL_PROPERTY_CODE" => array("EMAIL","ID_LOCATION","HAPPY_DAY","PAYMENT","CATEGORIES","KEY_WORDS","PHONE","EDUCATIONS","GENDER","PREV_WORKS","ID_USER",""),
    "DETAIL_SET_CANONICAL_URL" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "IBLOCK_ID" => "35",
    "IBLOCK_TYPE" => "rv_company",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
    "LIST_FIELD_CODE" => array("ID","CODE","XML_ID","NAME","TAGS","SORT","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM","ACTIVE_FROM","DATE_ACTIVE_TO","ACTIVE_TO","SHOW_COUNTER","SHOW_COUNTER_START","IBLOCK_TYPE_ID","IBLOCK_ID","IBLOCK_CODE","IBLOCK_NAME","IBLOCK_EXTERNAL_ID","DATE_CREATE","CREATED_BY","CREATED_USER_NAME","TIMESTAMP_X","MODIFIED_BY","USER_NAME",""),
    "LIST_PROPERTY_CODE" => array("EMAIL","ID_LOCATION","HAPPY_DAY","PAYMENT","CATEGORIES","KEY_WORDS","PHONE","EDUCATIONS","GENDER","PREV_WORKS","ID_USER",""),
    "MESSAGE_404" => "",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "NEWS_COUNT" => "20",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Новости",
    "PREVIEW_TRUNCATE_LEN" => "",
    "SEF_FOLDER" => "/resume/",
    "SEF_MODE" => "Y",
    "SEF_URL_TEMPLATES" => Array("detail"=>"#ELEMENT_ID#/","news"=>"","section"=>""),
    "SET_LAST_MODIFIED" => "Y",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "Y",
    "SHOW_404" => "N",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_BY2" => "SORT",
    "SORT_ORDER1" => "DESC",
    "SORT_ORDER2" => "ASC",
    "STRICT_SECTION_CHECK" => "N",
    "USE_CATEGORIES" => "N",
    "USE_FILTER" => "N",
    "USE_PERMISSIONS" => "N",
    "USE_RATING" => "N",
    "USE_REVIEW" => "N",
    "USE_RSS" => "N",
    "USE_SEARCH" => "N",
    "USE_SHARE" => "N"
  )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>