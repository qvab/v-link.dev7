var obRV = function() {
  var self = this;


  this.auth = {
    logIn: function() {
      $("#form-ajax-login").submit(function() {

        $.ajax({
          type: "POST",
          dataType: "json",
          url: location.pathname,
          data: $(this).serialize(),
          success: function(res) {
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
    logOut: function() {

    },

    registration: function() {

    },
    remindPass: function() {

    }
  };


};

window.RV = new obRV;