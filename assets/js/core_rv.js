var obRV = function () {
  var self = this;


  /**
   * Класс для работы с авторизаций/регистрацией
   */
  this.auth = {
    /**
     * Метод авторизации
     */
    logIn: function () {
      $("#form-ajax-login").submit(function () {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: location.pathname,
          data: $(this).serialize(),
          success: function (res) {
            if (res.error) {
              $("#error-text")
                .html(res.errorMessage)
                .show();
            } else {
              location.replace("/");
            }
          }
        });
        return false;
      });
    },
    /**
     * Метод регистрации
     */
    registration: function () {
      $("#form-ajax-registration").submit(function () {
        return false;
      });
      $("#form-ajax-registration").submit(function () {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: location.pathname,
          data: $(this).serialize(),
          success: function (res) {
            if (res.error) {
              $("#error-text")
                .html(res.errorMessage)
                .show();
            } else {
              //location.replace("/");
            }
          }
        });
        return false;
      });
    }
  };


  /**
   * Поиск по ключу
   * @param selector
   * @param place
   * @param typekey
   * @param typeSearch
   */
  this.searchKey = function (selector, place, typekey, typeSearch) {
    var timer = false;
    $(selector).keyup(function () {
      var sItems = '',
        sHTML = '';
      var loader = '<div style="z-index: 15; width: 100%; height: 100px; position: absolute; background: #fff url(/img/loader.gif) no-repeat center center;"></div>';
      var key = $(this).val();
      if (key.length > 2) {
        $(place).html(loader).attr("data-show", 1);
        $(place).fadeIn(300);
        clearTimeout(timer);
        timer = setTimeout(function () {
          $.ajax({
            url: "/ajax/search_keyword.php?type_search=" + typeSearch + "&key=" + key,
            dataType: "json",
            success: function (res) {
              if (typeof res.none === "undefined") {
                for (var k in res) {
                  switch (res[k].type) {
                    case "vacancy":
                      res[k].sType = "Вакансия";
                      break;
                    case "resume":
                      res[k].sType = "Резюме";
                      break;
                    case "key":
                      res[k].sType = "Ключевое слово";
                      break;
                  }
                  sItems += '<li data-type="' + res[k].type + '" data-value="' + res[k].value + '" class="item" id="item-' + k + '">' + res[k].value + ' <smail>' + (res[k].sType) + '</smail></li>';
                }
              } else {
                sItems += '<li class="none">Нечего не найдено</li>';
                $(typekey).val("");
              }
              sHTML = '<ul class="search-pop">' + sItems + '</ul>'
              console.log(sHTML);
              $(place).html(sHTML);

              $('.search-pop .item').click(function () {
                var val = $(this).attr("data-value");
                var type = $(this).attr("data-type");
                $(selector).val(val);
                $(typekey).val(type);
                $(place).html("");
              });
              $(window).click(function () {
                var show = $(place).attr('data-show');
                if (show) {
                  $(place).fadeOut(300, function () {
                    $(this).html("");
                  });
                }

              });
            }
          });
        }, 1000);
      }
    });
  };


  /**
   * Получение контакта
   */
  this.getContact = function () {
    $(".pop-contact").click(function (e) {
      e = e || e.window;
      if (e.target === this) {
        $(".pop-contact").fadeOut(300);
      }
    });

    $('a[href="#get-contact"]').click(function () {
      $(".pop-contact").fadeIn(300);
      var id = $(this).attr("data-id-resume");
      var idUser = $(this).attr("data-id-user");
      $.ajax({
        url: "/ajax/get_contact.php?id=" + id + "&id_user="+idUser,
        dataType: "json",
        success: function (data) {
          if (typeof data.message !== "undefined") {
            $(".pop-contact .content").html(data.message);
          } else {
            $(".pop-contact .content").html(data.form);
            self.onJobApp();
          }
        }
      });
      return false;
    });
  };


  /**
   * Получение вакансии
   */
  this.getVacancy = function () {
    $(".pop-contact").click(function (e) {
      e = e || e.window;
      if (e.target === this) {
        $(".pop-contact").fadeOut(300);
      }
    });

    $('a[href="#app-vacancy"]').click(function () {
      $(".pop-contact").fadeIn(300);
      var id = $(this).attr("data-id-vacancy");
      var companyId = $(this).attr("data-id-user");
      $.ajax({
        url: "/ajax/get_vacancy.php?id=" + id + "&company="+companyId,
        dataType: "json",
        success: function (data) {
          if (typeof data.message !== "undefined") {
            $(".pop-contact .content").html(data.message);
          } else {
            $(".pop-contact .content").html(data.form);
            self.onResponseApp();
          }
        }
      });
      return false;
    });
  };


  /**
   * Обработчик формы
   */
  this.onJobApp = function () {
    $("#form-ajax-job").submit(function () {
      console.log("init form-ajax-job");
      $.ajax({
        type: "POST",
        url: "/ajax/job_app.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function (data) {
          if (typeof data.success !== "undefined") {
            $(".pop-contact .content").html(data.success);
          } else {
            $(".pop-contact #error").html(data.error);
          }
        }
      });
      return false;
    });
  };


  /**
   * Обработчик формы
   */
  this.onResponseApp = function () {
    $("#form-ajax-job").submit(function () {
      console.log("init form-ajax-job");
      $.ajax({
        type: "POST",
        url: "/ajax/response_app.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function (data) {
          if (typeof data.success !== "undefined") {
            $(".pop-contact .content").html(data.success);
          } else {
            $(".pop-contact #error").html(data.error);
          }
        }
      });
      return false;
    });
  };



};

window.RV = new obRV;