var Router = Backbone.Router.extend({
  routes: {
        '' : 'home',
        'about': 'about',
        'contact': 'contact'
      },
      home: function() {
        this.clear();
        $('ul.mainNavigation #homeNav').addClass('active');
      },
      about: function() {
        this.clear();
        $('ul.mainNavigation #aboutNav').addClass('active');
      },
      contact: function() {
        this.clear();
        $('ul.mainNavigation #contactNav').addClass('active');
      },
      clear: function() {
        $('ul.mainNavigation li').removeClass('active');
      }
});
