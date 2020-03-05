<?php
define("IS_DOBRO_HOME", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

  <!-- start banner Area -->
  <section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row fullscreen align-items-center justify-content-center" style="height: 600px !important;">
        <div class="banner-content col-lg-12 col-md-12">
          <h1 class="text-uppercase">Профессильнальный сайт работы</h1>
          <div class="search-field">
            <form class="search-form" action="/vacancy" method="get">
              <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-center toggle-wrap">
                  <div class="row">
                    <div class="col">
                      <h4 class="search-title">Что хотите найти?</h4>
                    </div>
                    <div class="col">
                      <div class="onoffswitch3 d-block mx-auto">
                        <input type="checkbox" name="search[type]" class="onoffswitch3-checkbox"
                               id="myonoffswitch3" checked>
                        <label class="onoffswitch3-label" for="myonoffswitch3">
                          <span class="onoffswitch3-inner">
                            <span class="onoffswitch3-active">
                              <span class="onoffswitch3-switch">Вакансии</span>
                              <span class="lnr lnr-arrow-right"></span>
                            </span>
                            <span class="onoffswitch3-inactive">
                              <span class="lnr lnr-arrow-left"></span>
                              <span class="onoffswitch3-switch">Резюме</span>
                            </span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-xs-6">
                  <input type="text" name="search[key]" id="search-key" placeholder="Введите включевые слова профессии" class="input-group form-control" />
                  <input type="hidden" name="search[typekey]" value="" />
                  <div id="result-search-key"></div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-6">
                  <? $APPLICATION->IncludeComponent(
                    "bitrix:sale.location.selector.search",
                    "",
                    Array(
                      "CACHE_TIME" => "36000000",
                      "CACHE_TYPE" => "A",
                      "FILTER_BY_SITE" => "N",
                      "INITIALIZE_BY_GLOBAL_EVENT" => "",
                      "INPUT_NAME" => "region",
                      "JS_CALLBACK" => "",
                      "JS_CONTROL_GLOBAL_ID" => "",
                      "PROVIDE_LINK_BY" => "id",
                      "SHOW_DEFAULT_LOCATIONS" => "N",
                      "SUPPRESS_ERRORS" => "N"
                    )
                  ); ?>
                </div>

                <div class="col-lg-8 range-wrap">
                  <p style="text-align: center;">Зарабатная плата (руб\мес.):</p>
                  <input type="text" id="range" value="" name="search[payment]"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                  <button class="primary-btn mt-50" style="height: 45px;">Поиск<span
                      class="lnr lnr-arrow-right"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End banner Area -->

  <!-- Start service Area -->
<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/area/index_block_advantages.php"
  )
);?>
  <!-- End service Area -->

  <!-- Start property Area -->
<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/area/index_popular_vacancy.php"
  )
);?>
  <!-- End property Area -->

  <!-- Start city Area -->
  <section class="city-area section-gap">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8 pb-40 header-text">
          <h1 style="text-align: center;">Последнее в блоге</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 mb-10">
          <div class="content">
            <a href="#" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image img-fluid d-block mx-auto" src="img/p1.jpg" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Тестовая статья</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-10">
          <div class="content">
            <a href="#" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image img-fluid d-block mx-auto" src="img/p2.jpg" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Тестовая статья</h3>
              </div>
            </a>
          </div>
          <div class="row city-bottom">
            <div class="col-lg-6 col-md-6 mt-30">
              <div class="content">
                <a href="#" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="img/p3.jpg" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">Тестовая статья</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-30">
              <div class="content">
                <a href="#" target="_blank">
                  <div class="content-overlay"></div>
                  <img class="content-image img-fluid d-block mx-auto" src="img/p4.jpg" alt="">
                  <div class="content-details fadeIn-bottom">
                    <h3 class="content-title">Тестовая статья</h3>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End city Area -->

  <!-- Start About Area -->
  <section class="about-area">
    <div class="container-fluid">
      <div class="row d-flex justify-content-end align-items-center">
        <div class="col-lg-6 about-left">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/include/area/index_block_text_for_photo.php"
            )
          );?>
        <div class="col-lg-6 about-right no-padding">
          <img class="img-fluid" src="img/about-img.jpg" alt="">
        </div>
      </div>
    </div>
  </section>
  <!-- End About Area -->


<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/area/index_block_contacts_footer.php"
  )
);?>



<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>

<script src="lpdobra_standart/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="lpdobra_standart/js/vendor/bootstrap.min.js"></script>
<script src="lpdobra_standart/js/jquery.ajaxchimp.min.js"></script>
<script src="lpdobra_standart/js/jquery.nice-select.min.js"></script>
<script src="lpdobra_standart/js/jquery.sticky.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="lpdobra_standart/js/jquery.magnific-popup.min.js"></script>
<script src="lpdobra_standart/js/main.js"></script>
<script src="/assets/js/ion.rangeSlider.js"></script>
<script src="/assets/js/core_rv.js"></script>
<script>
  RV.searchKey("#search-key", "#result-search-key");
</script>