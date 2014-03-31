define(['/js/guest/m/login.js', 'text!/js/guest/t/login.tpl.html'], function (m, t) {
    return  Backbone.skipeView.extend({
        events:{
            'click #btnLogIn': 'logIn',
            'click #btnFPass': 'fPass',
            'click #btnSubmitFPass': 'submitFPass',
            'change #type input[name=type]': 'switchType',
        },
        switchType: function (e) {
            this.$('#token').val('');
            this.$('#pass').val('');
            var type = this.$('input[name=type]:checked').val();
            switch (type) {
                case 'email':
                    this.model.checkOptions.token.msg = 'Invalid email';
                    this.$('#token').attr('placeholder', 'EMAIL');
                    break;
                case 'sname':
                    this.model.checkOptions.token.msg = 'Invalid screen name';
                    this.$('#token').attr('placeholder', 'SCREEN NAME');
                    break;
                default:
                    this.model.checkOptions.token.msg = 'Invalid token.';
            }
        },
        initialize: function () {
            this.tpl = _.template(t);
            this.model = new m();
            this.model.on('afterLogIn', this.afterLogIn, this);
            this.model.on('afterFPass', this.afterFPass, this);
        },
        goTo: function () {
            this.$el.show().html(this.tpl());
            var matches = (document.cookie).match(/guestLoginType=(email|sname)/);
            if (matches) {
                this.$el.find('#type input[name=type][value='+matches[1]+']').trigger('click');
            }
            app.views.app.hideLoading();
        },
        fulfillAction: function (h, a) {
            this.hideErrors();
            this.model.clear();
            var type = this.$('input[name=type]:checked').val();
            this.model.checkOptions.token.type = type;
            this.model.set({
                type: type,
                token: (this.$('#token').val()).trim(),
            });
            if (this.$('#login').is(':visible')) {
                this.model.set({
                    pass: (this.$('#pass').val()).trim(),
                });
            }
            if (this.model.isValid()) {
                app.views.app.showLoading();
                this.model.hash = h;
                this.model.save({}, {
                    success: function (m) {
                        m.trigger(a);
                    }
                });
            } else {
                this.showErrors(this.model.validationError);
            }
        },
        logIn: function () {
            this.fulfillAction('logIn', 'afterLogIn');
        },
        fPass: function () {
            this.$('#login').hide();
            this.$('#fp').removeClass('hide');
        },
        submitFPass: function () {
            this.fulfillAction('forgotPassword', 'afterFPass');
        },
        afterSave: function (cb) {
            var e = this.model.get('errors');
            if (e) {
                this.showErrors(e);
            }
            if (this.model.get('success')) {
                cb(this);
            }
            app.views.app.hideLoading();
        },
        afterLogIn: function () {
            this.afterSave(function (t) {
                document.cookie = 'guestLoginType='+t.$('input[name=type]:checked').val();
                t.$('form').submit();
            });
        },
        afterFPass: function () {
            this.afterSave(function (t) {
                t.$el.find('div:first').hide();
                t.$el.find('div:nth-child(2)').removeClass('hide');
            });
        },
    });
});
