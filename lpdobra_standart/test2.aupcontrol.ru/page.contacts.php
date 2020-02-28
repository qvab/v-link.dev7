<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/header_other.php";
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

        <div class="col-sm-12 col-md-4">
          <h4>Информация</h4><br />
          <div class="highlighted-block">
            <dl class="icon-holder">
              <dt><i class="fa fa-map-marker"></i></dt>
              <dd>3652 Seventh Avenue, Los Angeles, CA</dd>

              <dt><i class="fa fa-phone"></i></dt>
              <dd>(+1) 987 654 3210</dd>

              <dt><i class="fa fa-fax"></i></dt>
              <dd>(+1) 123 456 7890</dd>

              <dt><i class="fa fa-envelope"></i></dt>
              <dd>hi@yoursite.com</dd>
            </dl>
          </div>
          <br>
          <ul class="social-icons size-sm text-center">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
      <br />
    </div>
</main>



<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/footer.php";
?>
