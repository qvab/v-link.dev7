var obRV = function () {
  var self = this;


  /**
   * Класс для работы с авторизаций/регистрацией
   */
  this.auth = {
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
    },
    remindPass: function () {

    }
  };


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

};

window.RV = new obRV;