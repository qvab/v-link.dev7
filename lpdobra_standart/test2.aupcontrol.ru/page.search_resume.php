<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/header_other.php";
?>



<div class="container page-name">
  <h1 class="text-center white">Поиск резюме</h1>
</div>



<div class="container">
  <form action="#">

    <div class="row">
      <div class="form-group col-xs-12 col-sm-4">
        <input type="text" class="form-control" placeholder="Ключевые слова, названия специализации">
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <input type="text" class="form-control" placeholder="Регион">
      </div>

      <div class="form-group col-xs-12 col-sm-4">
        <select class="form-control selectpicker" multiple>
          <option selected>Все категории</option>
          <option>Тестовая категория 1</option>
          <option>Тестовая категория 2</option>
        </select>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Уровень зарплаты (руб)</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="rate1" name="rate" checked>
            <label for="rate1">Любая зарплата</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate2" name="rate">
            <label for="rate2">до 10 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate3" name="rate">
            <label for="rate3">10 000 - 30 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate4" name="rate">
            <label for="rate4">30 000 - 100 000</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="rate5" name="rate">
            <label for="rate5">100 000 - 300 000</label>
          </div>
        </div>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Уровень образования</h6>
        <div class="checkall-group">
          <div class="checkbox">
            <input type="checkbox" id="degree1" name="degree" checked>
            <label for="degree1">Любое</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree2" name="degree">
            <label for="degree2">Среднее</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree3" name="degree">
            <label for="degree3">Средне-специальное</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree4" name="degree">
            <label for="degree4">Высшее</label>
          </div>

          <div class="checkbox">
            <input type="checkbox" id="degree5" name="degree">
            <label for="degree5">Несколько высших</label>
          </div>
        </div>
      </div>


      <div class="form-group col-xs-12 col-sm-4">
        <h6>Сортировка</h6>
        <div class="radio">
          <input type="radio" name="sortby" id="sortby1" value="option1" checked>
          <label for="sortby1">По реливатности</label>
        </div>

        <div class="radio">
          <input type="radio" name="sortby" id="sortby2" value="option2">
          <label for="sortby2">Сначала новыеt</label>
        </div>

        <div class="radio">
          <input type="radio" name="sortby" id="sortby3" value="option3">
          <label for="sortby3">Сначала старые</label>
        </div>


      </div>


    </div>

    <div class="button-group">
      <div class="action-buttons">
        <button class="btn btn-primary">Поиск</button>
      </div>
    </div>

  </form>

</div>


</header>


<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <br>
          <h5>Найдено <strong>1</strong> резюме</h5>
        </div>
      </div>

      <div class="row">
        <!-- Resume detail -->
        <div class="col-sm-12 col-md-6">
          <a class="item-block" href="<?=TEMPLATE?>page.detail_resume.php">
            <header>
              <img class="resume-avatar" src="<?=TEMPLATE_T?>assets/img/avatar-1.jpg" alt="">
              <div class="hgroup">
                <h4>Михаил Мишанин</h4>
                <h5>Веб-разработчик</h5>
              </div>
            </header>

            <div class="item-body">
              <p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от
                всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой
                друг, так упоен ощущением покоя, </p>

              <div class="tag-list">
                <span>HTML</span>
                <span>CSS</span>
                <span>JavaScript</span>
              </div>
            </div>

            <footer>
              <ul class="details cols-2">
                <li>
                  <i class="fa fa-map-marker"></i>
                  <span>Россия, Самара</span>
                </li>

                <li>
                  <i class="fa fa-money"></i>
                  <span>150 000 руб. / мес.</span>
                </li>
              </ul>
            </footer>
          </a>
        </div>
        <!-- END Resume detail -->
      </div>
    </div>
  </section>
</main>



<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/footer.php";
?>
