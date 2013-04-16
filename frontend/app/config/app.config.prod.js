define([], function () {
    'use strict';

    return {
        debug: {
            enable: false
        },
        auth: {
            logoutUrl: 'http://boombate.com/user/logout',
            loginUrl: 'http://boombate.com/user/login'
        },
        correspondence: {
            url: 'http://boombate.com/admin_correspondence/create_initial_correspondence'
        }
    };
});
