ESLint
-
v4.7.2

JSLint & JSHint - works with predefined rules.

````sh
# init eslint config
node_modules/.bin/eslint --init

node_modules/.bin/eslint src/

node_modules/.bin/eslint --fix src/

node_modules/.bin/eslint --print-config .eslintrc.json > .eslintrc
````

`.eslintignore`
````
/* eslint-disable */ # in top of file for ignor this file by eslint.
// eslint-disable-line
/* eslint-disable-line camelcase, max-len */
// eslint-disable-next-line
````

package.json:
````js
{
  "eslintConfig": {
    "env": {
      "browser": true,
      "jest": true,
      "node": true
    },
    "parserOptions": { "ecmaVersion": 5 },
    "globals": {
      "window": true
    },
    "extends": [
      "airbnb-base",
      "node",
      "plugin:node/recommended"
    ],
    "rules": {
        "semi": ["error", "always"],
        "quotes": ["error", "double"],
        "global-require": "off"
    }
  },
}
````
