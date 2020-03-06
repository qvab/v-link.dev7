<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании"); ?>
  <div class="container no-shadow">
    <br>
    <h1 class="text-center">Управление аккаунтом</h1>
    <br>
  </div>
  </header>
  <main>
  <div class="container">
    <?php if (!$USER->IsAuthorized()) {
      echo "Вы не авторизованы!";
    } else { ?>
    <div class="row">
      <div class="col-sm-12 col-md-3">
        <h6 style="color: #666;">Меню соискателя</h6>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <a class="btn btn-block btn-black" href="#">Мои резюме</a>
            <a class="btn btn-block btn-black" href="#">Отклики</a>
            <a class="btn btn-block btn-primary" href="#">Приглашения</a>
          </div>
        </div><br />
        <h6 style="color: #666;">Меню работодателя</h6>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <a class="btn btn-block btn-black" href="#">Вакансии</a>
            <a class="btn btn-block btn-black" href="#">Отклики</a>
            <a class="btn btn-block btn-black" href="#">Приглашения</a>
          </div>
        </div>
      </div>
    <div class="col-sm-12 col-md-9">

      <div class="row">

        <div class="col-xs-12 text-right">
          <br>
          <a class="btn btn-primary" href="/add-resume/">Добавить резюме</a>
        </div>


        <!-- Resume item -->
        <div class="col-xs-12">
          <div class="item-block">
            <header>
              <a href="resume-detail.html"><img class="resume-avatar" src="assets/img/avatar.jpg" alt=""></a>
              <div class="hgroup">
                <h4><a href="resume-detail.html">John Doe</a></h4>
                <h5>Front-end developer</h5>
              </div>
              <div class="header-meta">
                <span class="location">Menlo park, CA</span>
                <span class="rate">$55 per hour</span>
              </div>
            </header>

            <footer>
              <p class="status"><strong>Updated on:</strong> March 10, 2016</p>

              <div class="action-btn">
                <a class="btn btn-xs btn-gray" href="#">Отключить</a>
                <a class="btn btn-xs btn-gray" href="#">Редактировать</a>
                <a class="btn btn-xs btn-danger" href="#">Удалить</a>
              </div>
            </footer>
          </div>
        </div>
        <!-- END Resume item -->


        <!-- Resume item -->
        <div class="col-xs-12">
          <div class="item-block">
            <header>
              <a href="resume-detail.html"><img class="resume-avatar" src="assets/img/avatar.jpg" alt=""></a>
              <div class="hgroup">
                <h4><a href="resume-detail.html">John Doe</a></h4>
                <h5>Full stack developer</h5>
              </div>
              <div class="header-meta">
                <span class="location">Menlo park, CA</span>
                <span class="rate">$85 per hour</span>
              </div>
            </header>

            <footer>
              <p class="status"><strong>Updated on:</strong> March 03, 2016</p>

              <div class="action-btn">
                <a class="btn btn-xs btn-gray" href="#">Отключить</a>
                <a class="btn btn-xs btn-gray" href="#">Редактировать</a>
                <a class="btn btn-xs btn-danger" href="#">Удалить</a>
              </div>
            </footer>
          </div>
        </div>
        <!-- END Resume item -->
      </div>




    </div>
    </div>
  </div>
  <?php
  }
  ?>
  <br>
  </main><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>