<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/header_other.php";
?>


<div class="container">

  <div class="row">
    <div class="form-group col-xs-12 col-sm-6">
      <input type="text" class="form-control input-lg" placeholder="Job title, e.g. Front-end developer">
    </div>

    <div class="form-group col-xs-12 col-sm-6">
      <select class="form-control selectpicker">
        <option>Select a company</option>
        <option>Google</option>
        <option>Microsoft</option>
        <option>Apple</option>
        <option>Facebook</option>
      </select>
      <a class="help-block" href="company-add.html">Add new company</a>
    </div>

    <div class="form-group col-xs-12">
      <textarea class="form-control" rows="3" placeholder="Short description"></textarea>
    </div>

    <div class="form-group col-xs-12">
      <input type="text" class="form-control" placeholder="Application URL">
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
        <input type="text" class="form-control" placeholder="Location, e.g. Melon Park, CA">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
        <select class="form-control selectpicker">
          <option>Full time</option>
          <option>Part time</option>
          <option>Internship</option>
          <option>Freelance</option>
          <option>Remote</option>
        </select>
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
        <input type="text" class="form-control" placeholder="Salary">
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
        <input type="text" class="form-control" placeholder="Working hours, e.g. 40">
        <span class="input-group-addon">hours / week</span>
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-flask"></i></span>
        <input type="text" class="form-control" placeholder="Experience, e.g. 5">
        <span class="input-group-addon">Years</span>
      </div>
    </div>

    <div class="form-group col-xs-12 col-sm-6 col-md-4">
      <div class="input-group input-group-sm">
        <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
        <select class="form-control selectpicker" multiple>
          <option>Postdoc</option>
          <option>Ph.D.</option>
          <option>Master</option>
          <option selected>Bachelor</option>
        </select>
      </div>
    </div>


  </div>

  <div class="button-group">
    <div class="action-buttons">
      <div class="upload-button">
        <button class="btn btn-block btn-primary">Choose a cover image</button>
        <input id="cover_img_file" type="file">
      </div>
    </div>
  </div>

</div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>


  <!-- Job detail -->
  <section>
    <div class="container">

      <header class="section-header">
        <span>Description</span>
        <h2>Job detail</h2>
        <p>Write about your company, job description, skills required, benefits, etc.</p>
      </header>

      <textarea class="summernote-editor"></textarea>

    </div>
  </section>
  <!-- END Job detail -->


  <!-- Submit -->
  <section class="bg-alt">
    <div class="container">
      <header class="section-header">
        <span>Are you done?</span>
        <h2>Submit Job</h2>
        <p>Please review your information once more and press the below button to put your job online.</p>
      </header>

      <p class="text-center"><button class="btn btn-success btn-xl btn-round">Submit your job</button></p>

    </div>
  </section>
  <!-- END Submit -->


</main>
<!-- END Main container -->


<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/inc/footer.php";
?>
