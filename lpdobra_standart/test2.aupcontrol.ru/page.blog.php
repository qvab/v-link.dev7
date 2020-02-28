<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/header_other.php";
?>
<div class="container no-shadow">
  <br />
  <h1 class="text-center">Блог компании</h1>
  <br />
</div>
</header>
<!-- END Site header -->


<!-- Main container -->
<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row item-blocks-connected">

        <div class="col-xs-12">
          <br>
          <h5>Статей всего 1</h5>
          <br>
        </div>

        <!-- Job item -->
        <div class="col-xs-12">
          <a class="item-block" href="job-detail.html">
            <header>
              <img src="<?=TEMPLATE?>assets/img/logo-google.jpg" alt="">
              <div class="hgroup">
                <h4>Тестовая статья</h4>
              </div>
            </header>
          </a>
        </div>
        <!-- END Job item -->

      </div>


      <!-- Page navigation -->
      <nav class="text-center">
        <ul class="pagination">
          <li>
            <a href="#" aria-label="Previous">
              <i class="ti-angle-left"></i>
            </a>
          </li>
          <li><a href="#">1</a></li>
          <li class="active"><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li>
            <a href="#" aria-label="Next">
              <i class="ti-angle-right"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- END Page navigation -->


    </div>
  </section>
</main>
<!-- END Main container -->

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/footer.php";
?>
