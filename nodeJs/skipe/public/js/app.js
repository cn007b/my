requirejs.config({
    paths: {
        text: '/js/lib/text-2.0.10',
        i18n: '/js/lib/i18n-2.0.4',
        nls: '/js/nls/default',
        helpers: '/js/lib/helpers',
        skipeView: '/js/lib/backboneSkipeView',
        skipeModel: '/js/lib/backboneSkipeModel',
        view_guest_index: '/js/guest/guest',
        view_account_index: '/js/account/account',
    },
});

window.app = {
    init: {
        routers: {},
        models: {},
        views: {},
    },
    routers: {},
    helpers: {},
    views: {},
    nls: {},
};

app.init.routers.app = Backbone.Router.extend({
    routes: {
        '*other': 'goTo',
    },
    goTo: function (id) {
        this.id = id;
        this.scope = 'guest';
        if (/^\/account/.test(window.location.pathname)) {
            this.scope = 'account';
        }
        if (_.isEmpty(app.views[this.scope])) {
            require(['view_'+this.scope+'_index'], app.routers.app.go);
        } else {
            this.go();
        }
    },
    go: function (v) {
        scope = app.routers.app.scope;
        id = app.routers.app.id;
        if (_.isEmpty(app.views[scope])) {
            app.views[scope] = new v();
        }
        app.views[scope].goTo(id);
    },
});

app.init.models.app = Backbone.Model.extend({});

app.init.views.app = Backbone.View.extend({
    locale: 'uk',
    el: 'body',
    initialize: function () {
        this.showLoading();
        this.loadNls();
        require(['skipeModel', 'skipeView', 'helpers'], function (m, v, h) {
            Backbone.skipeModel = m;
            Backbone.skipeView = v;
            app.helpers = h;
        });
        app.routers.app = new app.init.routers.app();
        Backbone.history.start();
    },
    loadNls: function (clb) {
        var l = '/js/nls/'+this.locale+'.js';
        require(['nls', l], function (a, b) {
            app.nls = _.extend(a, b);
            if (_.isFunction(clb)) {
                clb();
            }
        });
    },
    showLoading: function () {
        this.$('footer #progress').removeClass('hide');
    },
    hideLoading: function () {
        this.$('footer #progress').addClass('hide');
    },
});

$(function () {
    app.views.app = new app.init.views.app({model: new app.init.models.app()});
});
