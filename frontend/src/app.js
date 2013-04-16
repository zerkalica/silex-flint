define([
    'jade',
    'underscore',
    'backbone',
    'Backbone.Marionette',
    'backbone-relational'

], function (jade, _, Backbone, Marionette) {
    'use strict';

    var app = new Marionette.Application();

    app.addRegions({
        headerRegion:    '#jsHeader',
        mainRegion:      '#jsMainContent',
        indicatorRegion: '#jsIndicator',
        messageRegion:   '#jsMessages'
    });

    app.addInitializer(function (options) {
        Marionette.TemplateCache.prototype.loadTemplate = function (templateId) {
            return templateId;
        };
        Marionette.TemplateCache.prototype.compileTemplate = function (rawTemplate) {
            return rawTemplate;
        };
    });

    return app;
});
