define([
    'underscore',
    'jquery',
    'backbone',
    'Backbone.ModelBinder',
    './MillwrightValidator'
], function (_, $, Backbone, ModelBinder, MillwrightValidator) {
    'use strict';

    var initErrors = function (model, cid) {
        var errors = {};

        //@todo var validated = _.has(model, 'validation'); always returns false
        var validated = _.isObject(model.validation);

        _.each(model.toJSON(), function (value, name) {

            var id = name + '-' + cid;

            var attributes = {
                class: '',
                block: '',
                inline: '',
                name: id,
                id: id,
                required: false
            };

            if (validated && _.has(model.validation, name)) {
                var item = model.validation[name];

                if (item.required) {
                    attributes.required = true;
                }
            }

            errors[name] = attributes;
        });

        return errors;
    };

    var bindModel = function (model, view) {
        var triggers = {
            '': 'change keyup paste',
            '[contenteditable]': 'blur keyup paste'
        };

        var modelBinder = new ModelBinder();

        var attributeBindings = {};
        _.each(view.model.toJSON(), function (value, name) {
            var id = '#' + name + '-' + view.cid;
            if (!(value instanceof Object) && view.$el.find(id).length) {
                attributeBindings[name] = id;
            }
        });
        modelBinder.bindCustomTriggers(model, view.$el, triggers, attributeBindings);
    };

    var bindHelpers = function (view, options) {
        var model = view.model;

        view.templateHelpers = _.extend({
            form: initErrors(model, view.cid),
            cid: view.cid
        }, view.templateHelpers || {});

        view.on('render', function () {
            bindModel(model, view);
        });

        MillwrightValidator.bind(view, options);
    };

    return {
        bindHelpers: bindHelpers
    };
});
