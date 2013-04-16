silex-flint
===========

1. Install node + npm http://nodejs.org/download/
2. From project root `php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"` (installs `http://getcomposer.org/download/`)
3. Install php vendors `php composer.phar install`
4. Install js vendors `cd frontend && npm i`
5. from frontend directory run `node_modules/.bin/grunt dev` for build frontend in web/frontend

