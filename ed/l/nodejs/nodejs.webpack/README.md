webpack
-
<br>4.22.0
<br>2.2.1

Webpack is replace for grunt and gulp!)
Core Concepts:
* Entry
* Output
* Loaders
* Plugins

````sh
# example one
npm install
./node_modules/.bin/webpack
./node_modules/.bin/webpack ./app.js bundle.js
./node_modules/.bin/webpack-dev-server --host 0.0.0.0 --public 0.0.0.0:8080 --watch-poll

# run from vagrant
webpack-dev-server --host 0.0.0.0 --public 192.168.56.101:8080 --watch-poll

# source map
./node_modules/.bin/webpack -d
````

Build:

````sh
# minify
./node_modules/.bin/webpack -p
````

## Config (webpack.config.js)

````js
var path = require('path');

module.exports = {
  debug: true,
  devtool: 'source-map',
  noInfo: false,
  entry: './foo.js',
  target: 'web',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'foo.bundle.js'
  }
};
````
