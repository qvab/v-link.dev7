<?php
define("ALT_TITLE", "Регистрация");
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
if (!empty($_REQUEST["is_reg"])) {
  if (empty($_POST) || empty($_POST)) {
    $arResult = [
      "error" => true,
      "errorMessage" => "Не все поля заполенны",
      "success" => false
    ];
  } else {
    global $USER;
    $arAuth = $USER->Register($_POST["user_email"], $_POST["user_name"], "", $_POST["user_password"], $_POST["user_password"], $_POST["user_email"]);
    $arResult = [
      "error" => $arAuth["TYPE"] == "ERROR" ? true : false,
      "errorMessage" => $arAuth["MESSAGE"],
      "success" => $arAuth["TYPE"] != "ERROR" ? true : false,
    ];
  }
  echo json_encode($arResult, JSON_UNESCAPED_UNICODE);
} else {
  require_once ROOT_TEMPLATE."/inc/head.php";
  ?>
  <link rel="stylesheet" href="/assets/css/core_rv.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <body class="login-page">
  <main>
    <div class="login-block">
      <h1>Зарегистировать аккаунт</h1>
      <p class="error" style="display: none;" id="error-text"></p>
      <form action="" id="form-ajax-registration" method="POST">
        <input type="hidden" name="is_reg" value="1" />
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="ti-user"></i></span>
            <input type="text" class="form-control" placeholder="Ваше имя" name="user_name">
          </div>
        </div>
        <hr class="hr-xs">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="ti-email"></i></span>
            <input type="text" class="form-control" placeholder="Ваш email" name="user_email">
          </div>
        </div>
        <hr class="hr-xs">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="ti-unlock"></i></span>
            <input type="password" class="form-control" placeholder="Пароль" name="user_password">
          </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Зарегистироваться</button>
      </form>
    </div>
    <div class="login-links">
      <p class="text-center">Уже есть аккаунт? <a class="txt-brand" href="/login">Авторизоваться</a></p>
    </div>
  </main>
  </body>
  <!-- Scripts -->
  <script src="/assets/js/core_rv.js"></script>

  <script>
    RV.auth.registration();
  </script>
  </body>
  </html>
  <?php
}