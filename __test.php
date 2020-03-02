<?php
include_once PATH_TEMP_INC."/head.php";
?>
<body>
<?
$APPLICATION->ShowPanel = true;
$APPLICATION->ShowPanel();
?>
<!-- Start Header Area -->
<link rel="stylesheet" href="/assets/css/core_rv.css"/>
<header class="default-header">
  <div class="menutop-wrap">
    <div class="menu-top container">
      <div class="d-flex justify-content-end align-items-center">


          <?php
          if ($USER->IsAuthorized()) { ?>
            <div class="data-account">
              Вы авторизованны как: <span class="account-name"><?=$USER->GetLogin()?></span> <a class="logout" href="/logout">x</a>
            </div>
        <ul class="list">
            <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Добавить вакансию</a></li>
            <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Добавить резюме</a></li>
        </ul>
          <?php
          } else { ?>
        <ul class="list">
            <li><a target="_blank" href="<?=TEMPLATE?>page.login.php">Авторизация</a></li>
            <li><a target="_blank" href="<?=TEMPLATE?>page.reg.php">Регистрация</a></li>
        </ul>
            <?php
          }
          ?>
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
          <?php require PATH_TEMP_INC."/menu_top.php"; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>