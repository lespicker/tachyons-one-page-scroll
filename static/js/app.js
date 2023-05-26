$( function(){
  $("form.xxxnews").submit(function (event) {
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

  const algoliaClient = algoliasearch(
    'GKE6Y4S63I',
    '3723d8a93a52b50655f1771c329cc61c'
  );

  const searchClient = {
    search(requests) {
      if (requests.every(({ params }) => !params.query)) {
        return Promise.resolve({
          results: requests.map(() => ({
            hits: [],
            nbHits: 0,
            nbPages: 0,
            page: 0,
            processingTimeMS: 0,
          })),
        });
      }

      return algoliaClient.search(requests);
    },
  };

  const search = instantsearch({
    indexName: 'lpfa',
    searchClient,
  });

  search.addWidgets([
    instantsearch.widgets.searchBox({
      container: '#search-box',
      placeholder: 'search'
    }),

    instantsearch.widgets.hits({
      container: '#hits',
      escapeHTML: false,
      templates: {
        item: `
          <h2 class="f3 fw4 mt0 mb2 ls-title">
            <a href="{{url}}" class="link white underline-hover">{{ title }}</a>
          </h2>
          <p class="mt0 mb4 f6 white-50">{{summary}}</p>
        `,
      }
    })
  ]);

  search.start();

});

$(window).click( function(e) {
  target = $(event.target);
  if(target.is('a')){
   $('#menu-switch').prop('checked', false);
  }
});