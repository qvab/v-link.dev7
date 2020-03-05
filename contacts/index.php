<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

  <div class="container no-shadow">
    <br />
    <h1 class="text-center">Контакты</h1>
    <br />
  </div>
  </header>
  <!-- END Site header -->


  <!-- Main container -->
  <main>
    <div class="container">

      <div id="contact-map" style="height: 500px; background: url(<?=TEMPLATE?>/img/map.jpg) no-repeat center center;"></div>

      <br><br>

      <div class="row">
        <div class="col-sm-12 col-md-8">
          <h4>Обратная связь</h4><br />
          <form>
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Ваше имя">
            </div>
            <div class="form-group">
              <input type="email" class="form-control input-lg" placeholder="E-mail">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" placeholder="Сообщение"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
          </form>
        </div>

        <?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/area/contacts_text_info.php"
          )
        );?>
      </div>
      <br />
    </div>
  </main>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>