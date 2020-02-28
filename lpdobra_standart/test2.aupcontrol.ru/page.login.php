<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/head.php";
?>

<?php

//global $USER;
//if (!is_object($USER)) $USER = new CUser;
//$arAuthResult = $USER->Login("admin", "123456", "Y");

//var_dump($arAuthResult);
//$APPLICATION->arAuthResult = $arAuthResult;

?>

<body class="login-page">
<main>
  <div class="login-block">
    <h1>Войти в аккаунт</h1>
    <form action="#">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" placeholder="Email">
        </div>
      </div>

      <hr class="hr-xs">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" placeholder="Пароль">
        </div>
      </div>
      <button class="btn btn-primary btn-block" type="submit">Войти</button>
    </form>
  </div>

  <div class="login-links">
    <a class="pull-left" href="user-forget-pass.html">Забыли пароль?</a>
    <a class="pull-right" href="user-register.html">Зарегистрироваться</a>
  </div>
</main>


<!-- Scripts -->
<script src="<?=TEMPLATE_T?>assets/js/app.min.js"></script>
<script src="<?=TEMPLATE_T?>assets/js/custom.js"></script>

</body>
</html>
