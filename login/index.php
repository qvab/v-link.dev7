<?php
define("ALT_TITLE", "Авторизация");
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
if (!empty($_REQUEST["is_login"])) {

  if (empty($_POST) || empty($_POST)) {
    $arResult = [
      "error" => true,
      "errorMessage" => "Не все поля заполенны",
      "success" => false
    ];
  } else {
    global $USER;
    if (!is_object($USER)) $USER = new CUser;
    $arAuth = $USER->Login($_POST["login"], $_POST["pass"], "Y");
    $APPLICATION->arAuthResult = $arAuth;
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
  <script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
  <body class="login-page">
  <main>
    <div class="login-block">
      <h1>Войти в аккаунт</h1>
      <p class="error" style="display: none;" id="error-text"></p>
      <form action="" method="POST" id="form-ajax-login">
        <input type="hidden" name="is_login" value="1"/>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="ti-email"></i></span>
            <input type="text" name="login" class="form-control" placeholder="Логин" required />
          </div>
        </div>

        <hr class="hr-xs">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="ti-unlock"></i></span>
            <input type="password" name="pass" class="form-control" placeholder="Пароль" required />
          </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Войти</button>
      </form>
    </div>

    <div class="login-links">
      <a class="pull-left" href="/recovery-pass/">Забыли пароль?</a>
      <a class="pull-right" href="/reg">Зарегистрироваться</a>
    </div>
  </main>


  <!-- Scripts -->
  <script src="/assets/js/core_rv.js"></script>

  <script>
    RV.auth.logIn();
  </script>

  </body>
  </html>

  <?php
}