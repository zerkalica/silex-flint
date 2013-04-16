// Set the require.js configuration for your application.
requirejs.config({
    paths: {
        'requireLib': '../vendor/bower/requirejs/require',
        'jade': '../vendor/bower/require-jade/jade',

        'test': '../test',

        'mocha': '../node_modules/mocha/mocha',
        'phantom-bridge': '../node_modules/grunt-mocha/phantomjs/bridge',
        'chai': '../node_modules/chai/chai',
        'chai-backbone': '../node_modules/chai-backbone/chai-backbone',
        'chai-changes': '../node_modules/chai-changes/chai-changes',
        'chai-jquery': '../node_modules/chai-jquery/chai-jquery',
        'sinon': '../node_modules/sinon/pkg/sinon',
        'sinon-chai': '../node_modules/sinon-chai/lib/sinon-chai',

        'underscore': '../vendor/bower/underscore/underscore',
        'jquery': '../vendor/bower/jquery/jquery',
        'backbone': '../vendor/bower/backbone/backbone',
        'backbone-relational': '../vendor/bower/backbone-relational/backbone-relational',
        'Backbone.ModelBinder': '../vendor/Backbone.ModelBinder',
        'backbone.wreqr': '../vendor/bower/backbone.wreqr/lib/amd/backbone.wreqr',
        'backbone.babysitter': '../vendor/bower/backbone.babysitter/lib/amd/backbone.babysitter',
        'Backbone.Marionette': '../vendor/bower/marionette/lib/core/amd/backbone.marionette',

        'blockUI': '../vendor/bower/blockui/jquery.blockUI',
        'pickadate': '../vendor/bower/pickadate/source/pickadate',
        'pickadate.ru' : '../vendor/bower/pickadate/translations/pickadate.ru_RU',

        'config': './app.config',
        'chosen': '../vendor/chosen-js/chosen/chosen.jquery',
        'moment': '../vendor/moment/moment',
        'moment.ru': '../vendor/moment/lang/ru',
        'datatables': '../vendor/datatables/js/jquery.dataTables'
        //@todo убрать load=package.full после рефакторинга PlaceEditController
        //'ymaps': 'http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU'
    },
    deps: ['backbone-relational'],
    shim: {
        'mocha': {
            exports: 'mocha'
        },
        'chai': {
            deps: ['mocha'],
            exports: 'chai'
        },
        'sinon': {
            deps: ['chai'],
            exports: 'sinon'
        },
        'sinon-chai': {
            deps: ['sinon'],
            exports: 'sinon'
        },
        'chai-jquery': {
            deps: ['jquery', 'chai'],
            exports: 'chai'
        },
        'chai-backbone': {
            deps: ['chai', 'backbone', 'chai-changes'],
            exports: 'chai'
        },
        'blockUI': {
            deps: ['jquery'],
            exports: 'blockUI'
        },
        'backbone-relational': {
            deps: ['backbone'],
            exports: 'Backbone.Relational'
        },
        'moment': {
            exports: 'moment'
        },
        'moment.ru': {
            deps: ['moment'],
            exports: 'moment.ru'
        },
        /*
         'ymaps': {
         deps: ['jquery'],
         exports: 'ymaps'
         },
         */
        'chosen': {
            deps: ['jquery'],
            exports: 'chosen'
        },
        'datatables': {
            deps: ['jquery'],
            exports: 'datatables'
        },
        'pickadate': {
            deps: ['jquery'],
            exports: 'pickadate'
        },
        'pickadate.ru': {
            deps: ['pickadate'],
            exports: 'pickadateru'
        },
        'underscore': {
            exports: '_'
        },
        'backbone': {
            deps: ['jquery', 'underscore'],
            exports: 'Backbone'
        }
    }
});

