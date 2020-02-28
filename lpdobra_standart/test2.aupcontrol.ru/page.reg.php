<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/head.php";
?>

<body class="login-page">

<main>

  <div class="login-block">
    <h1>Зарегистировать аккаунт</h1>
    <form action="#">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input type="text" class="form-control" placeholder="Ваше имя">
        </div>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" placeholder="Ваш email">
        </div>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-unlock"></i></span>
          <input type="password" class="form-control" placeholder="Пароль">
        </div>
      </div>

      <button class="btn btn-primary btn-block" type="submit">Зарегистироваться</button>
    </form>
  </div>

  <div class="login-links">
    <p class="text-center">Уже есть аккаунт? <a class="txt-brand" href="<?=TEMPLATE?>/page.login.php">Авторизоваться</a></p>
  </div>

</main>


<!-- Scripts -->
<script src="<?=TEMPLATE_T?>assets/js/app.min.js"></script>
<script src="<?=TEMPLATE_T?>assets/js/custom.js"></script>

</body>
</html>