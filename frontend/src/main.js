require([
    'app',
    'moment.ru',
    'pickadate.ru'
], function (app) {
    'use strict';

    var options = {
        history: {
            pushState: false,
            root: '/frontend'
        },
        debug: true
    };

    app.start(options);
});
