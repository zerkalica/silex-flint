define([
    'underscore',
    'backbone',
    'backbone-relational'
], function (_, Backbone, Br) {
    'use strict';

    _.extend(Backbone.Model.prototype, {
        fetch: function (options) {
            var model = this;
            var success = options.success;
            options.success = function (resp) {
                model.trigger('sync:fetch', model, resp, options);
                if (success) {
                    success(model, resp);
                }
            };

            return Backbone.Model.prototype.fetch(options);
        },

        save: function(key, val, options) {
            var model = this;
            var success = options.success;
            options.success = function (resp) {
                model.trigger('sync:save', model, resp, options);
                if (success) {
                    success(model, resp);
                }
            };

            return Backbone.Model.prototype.save(key, val, options);
        }
    });
});
