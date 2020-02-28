<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/head.php";
?>
<body>
<!-- Start Header Area -->
<header class="default-header">
  <div class="menutop-wrap">
    <div class="menu-top container">
      <div class="d-flex justify-content-end align-items-center">
        <ul class="list">
          <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Добавить вакансию</a></li>
          <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Добавить резюме</a></li>
          <li><a target="_blank" href="<?=TEMPLATE?>page.login.php">Авторизация</a></li>
          <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Регистрация</a></li>
        </ul>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="<?=TEMPLATE?>">
        <img src="<?=TEMPLATE?>img/logo.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <?php require $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/menu_top.php"; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>