<!-- Site footer -->
<footer class="site-footer">

  <!-- Top section -->
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-md-4">
        <h6>Меню</h6>
        <ul class="footer-links">
          <?php require PATH_TEMP_INC."/menu_top.php"; ?>
        </ul>
      </div>
      <div class="col-xs-6 col-md-8">
        <h6>Популярные специализации</h6>
        <ul class="footer-links">
<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/area/footer_popular_categories.php"
  )
);?>
        </ul>
      </div>
    </div>
    <hr>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="social-icons">
<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/include/area/footer_social.php"
  )
);?>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script src="/assets/js/app.min.js"></script>
<script src="<?=TEMPLATE_T?>assets/js/custom.js"></script>