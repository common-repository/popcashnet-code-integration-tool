(function($) {

var $el = '.pcit-wrap ';

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

function getFcap(apiKey, wid) {
  return $.ajax({
    method: 'get',
    url:    'https://api.popcash.net/websites/' + wid + '/fcap?apikey=' + apiKey,
  }).done(function(response) {
      $($el + ".aab .error-msg").hide();
      var max = response.fcap;
      var items = Array(response.fcap).fill().map(function(x,i){return i+1});
      $($el + ".aab #popcash_net_fcap").empty();
      $($el + ".aab input[name=popcash_net_uid]").val(response.uid);
      $.each(items, function(key,value) {
        $($el + ".aab #popcash_net_fcap").append($("<option" + (value == 1 ? ' selected' : '' )+ "></option>").attr("value", value).text(value));
      });
      $($el   + "input[type=submit]").removeAttr('disabled');

    }).fail(function(error) {
      $($el   + "input[type=submit]").attr('disabled', true);
      $($el + ".aab .error-msg").show();

      $($el + ".aab #popcash_net_fcap").empty();
      $.each([1], function(key,value) {
        $($el + ".aab #popcash_net_fcap").append($("<option selected></option>").attr("value", value).text(value));
      });
    }).always(function(error) {
      $($el + ".aab .ajax-loader").hide();
    });
}

function toggleSubmit(e, pair) {
  (e.target.value.length)
    ?  $($el + "input[type=submit]").removeAttr('disabled')
    :  $($el + "input[type=submit]").attr('disabled',true);

  if(!pair) return;
  if(!$($el + pair).val()) {
    $($el + "input[type=submit]").attr('disabled',true);

  }
}

// Standard FORM
$(function() {
  if($($el + ".standard #popcash_net_uid").val() && $($el + ".standard #popcash_net_wid").val() ) {
    $($el   + "input[type=submit]").removeAttr('disabled');
  };

  $($el + ".standard #popcash_net_uid").on('input', function(e) {toggleSubmit(e, ".standard #popcash_net_wid")});
  $($el + ".standard #popcash_net_wid").on('input', function(e) {toggleSubmit(e, ".standard #popcash_net_uid")});

})

// Manual FORM
$(function() {
  if($($el + ".manual-integration #popcash_net_textarea").val()) {
    $($el   + "input[type=submit]").removeAttr('disabled');
  };

  $($el + ".manual-integration #popcash_net_textarea").on('input', toggleSubmit);

})

// Aab FORM
$(function() {
  if($($el + ".aab #popcash_net_api_key").val() && $($el + ".aab #popcash_net_wid").val() ) {
    $($el   + "input[type=submit]").removeAttr('disabled');
  }

  if($($el + ".aab #popcash_net_api_key").val() && $($el + ".aab #popcash_net_wid").val() ) {
    getFcap($($el + ".aab #popcash_net_api_key").val(), $($el + ".aab #popcash_net_wid").val())
      .then(function() {
        $($el + ".aab #popcash_net_fcap").val(pcit_globals.fcap).change();
      });
  };

  $($el + ".aab #popcash_net_wid").on("input", function(e) {
    var apiKey = $($el + ".aab #popcash_net_api_key").val();
    if(!apiKey) return;
    $($el + ".aab .ajax-loader").show();
  });

  $($el + ".aab #popcash_net_wid").on("input", debounce(function(e) {
    var apiKey = $($el + ".aab #popcash_net_api_key").val();
    if(!apiKey) return;
    getFcap(apiKey, e.target.value);
  }, 1000, false));

  $($el + ".aab #popcash_net_api_key").on("input", function(e) {
    var uid = $($el + ".aab #popcash_net_wid").val();
    if(!uid) return;
    $($el + ".aab .ajax-loader").show();
  });

  $($el + ".aab #popcash_net_api_key").on("input", debounce(function(e) {
    var uid = $($el + ".aab #popcash_net_wid").val();
    if(!uid) return;
    getFcap(e.target.value, uid);
  }, 1000, false));

})


})(jQuery)
