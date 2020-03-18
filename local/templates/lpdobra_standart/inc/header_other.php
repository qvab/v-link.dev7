<?php
include_once PATH_TEMP_INC . "/head.php";
?>
<?
if ($USER->IsAdmin()) {
$APPLICATION->ShowPanel = true;
$APPLICATION->ShowPanel();
}
?>
  <body>
  <link rel="stylesheet" href="/assets/css/core_rv.css"/>
  <div class="menutop-wrap">
    <div class="menu-top container">
      <div class="d-flex justify-content-end align-items-center">


        <?php
        if ($USER->IsAuthorized()) { ?>
          <div class="data-account">
            Вы авторизованны как: <span class="account-name"><?= $USER->GetLogin() ?></span> <a class="logout"
                                                                                                href="/logout">x</a>
          </div>
          <ul class="list">
		  <li><a href="/account">Управление</a></li>
            <li><a href="/add-vacancy">Добавить вакансию</a></li>
            <li><a href="/add-resume">Добавить резюме</a></li>
          </ul>
          <?php
        } else { ?>
          <ul class="list">
            <li><a target="_blank" href="/login">Авторизация</a></li>
            <li><a target="_blank" href="/reg">Регистрация</a></li>
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
      <a class="navbar-brand" href="/">
        <img src="<?= TEMPLATE ?>img/logo.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <?php require PATH_TEMP_INC . "/menu_top.php"; ?>
        </ul>
      </div>
    </div>
  </nav>
<?php if (!defined("HIDE_HEADER") || empty(HIDE_HEADER)) { ?>
<header class="page-header bg-img" style="background-image: url(<?= TEMPLATE ?>img/header-bg.jpg);">
  <?php
}
?>