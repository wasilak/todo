var Router = Backbone.Router.extend({
  routes: {
        '' : 'home',
        'list' : 'home',
        'about': 'about',
        'contact': 'contact'
      },
      home: function() {
        $('ul.mainNavigation a[href="#list"]').tab('show');
      },
      about: function() {
        $('ul.mainNavigation a[href="#about"]').tab('show');
      },
      contact: function() {
        $('ul.mainNavigation a[href="#contact"]').tab('show');
      }
});
