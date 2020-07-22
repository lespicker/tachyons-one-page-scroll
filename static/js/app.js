$( function(){
  $("form.news").submit(function (event) {
    $("#subscribe").prop("disabled", true);
    $("#spinner").addClass("dib");
    console.log(data = $(this).serializeArray());
    event.preventDefault();
    p = { "email_address": data[0].value,
      "status": "subscribed",
      "merge_fields": {}
    };
    fetch("https://mc-serv-lpfa.vercel.app", {
    //fetch("http://localhost:3000", {
      headers: {
      'Accept': 'application/json, text/plain, */*',
      'Content-Type': 'application/json'
      },
      "method": "POST",
      body: JSON.stringify(p)
    }).then(response => response.json().then( data => {
      console.log(data)
      $("#spinner").removeClass("dib");
      $('form.news').trigger("reset");
      $("#subscribe").prop("disabled", false);
    }));
  });
});

$(window).click( function(e) {
  target = $(event.target);
  if(target.is('a')){
   $('#menu-switch').prop('checked', false);
  }
});