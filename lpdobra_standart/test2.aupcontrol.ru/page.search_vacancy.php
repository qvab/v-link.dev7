<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/header_other.php";
?>



<div class="container page-name">
  <h1 class="text-center white">Поиск вакансий</h1>
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



<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/footer.php";
?>
