# generator-degordian-phprontend [![NPM version][npm-image]][npm-url] [![Build Status][travis-image]][travis-url] [![Dependency Status][daviddm-image]][daviddm-url] [![Coverage percentage][coveralls-image]][coveralls-url]
> Frontend scaffolding for wordpress or yii projects.

## Installation

First, install [Yeoman](http://yeoman.io) and generator-degordian-phprontend using [npm](https://www.npmjs.com/) (we assume you have pre-installed [node.js](https://nodejs.org/)).

```bash
npm install -g yo
npm install -g generator-degordian-phprontend
```

## Generating project

```bash
yo degordian-phprontend
```

and follow the prompts as follows:

### 1. defining project folder
  * you can generate your project into an existing directory or you can supply a name for a new one
  * supplying the name of the current folder will scaffold the application in the current folder
  * supplying a new name will create the folder for you
  
### 2. choosing structure
  * you can choose between Wordpress or Yii boilerplate
  * Yeoman will generate folder and base structure based on your selection
  
### 3. installing default libraries 
  * there are some js and css plugins available for you to install based on the frequency of usage in our projects
  * configuration files will be _automagically_ adjusted according to your selection
  * __JavaScript__
    * some libraries, such as jquery often require global scope as their plugins rely on presence of `jQuery` or `$` in `window` object
    * therefore, some plugins (e.g. `jQuery`) are added to global scope to prevent errors
    * plugins like `TweenMax which are often used in a lot of modules are loaded everywhere to avoid tedious import in every user module
  * __CSS__
    * `style.scss is modified based on selected css libraries
    * libraries installed as node packages are referenced with `~` which is an alias to node_modules, eg. `~/plugin-name`
    

## Installing libraries

The recommended way to install libraries is via npm. 
Dependencies installed this way be easily maintained based on information defined in `package.json`.
If the library is not available through npm, place its contents in `static/js/vendor` for javascript files, and `static/scss/plugins` for (s)css.

## Using libraries

### JavaScript

Adding plugins to `static/js/vendor.js` file will bundle them to a separate bundle called `vendor.js` located in the `dist` folder which is referenced as a separate script tag in the markup.

They can be included as a regular ES6 import. 

Using unnamed imports `import 'my-module'` is valid syntax, but keep in my that it will only __import a module for its side effects only*__.
That means that it runs the module's global code, but doesn't actually import any values or assign module's contents to a namespace.

If you want to use the imported library in other modules you can reference it from the file where it is located, and webpack will still bundle the library in the `dist/vendor.js` file, as long as it is imported in `js/vendor.js`.

__Example:__
```
/* vendor.js */

// imported from node_modules
// automatically bundled to dist/vendor.js
import 'jquery';
import 'is_js' 

/* index.js */

// imported as a named import so it can be used in the module
import $ from 'jquery'; 
import is from 'is_js';

$(document).ready(() => {
    is.number('I am a number, trust me.');
});
```

If you want to import the library to every module without having to always write import statement, you can use webpack's `ProvidePlugin`. 
Assigning a value to an identifier in the object passed to `ProvidePlugin` will automatically import that variable to all the other modules and fill it with exports of the loaded module.


```
/* webpack.config.js */

new webpack.ProvidePlugin({
    identifier: 'my-module'
})

// identifier is the name of the variable
// that you want to assign exports of 'my-module'
```

__Example:__
```
/* webpack.config.js */

new webpack.ProvidePlugin({
  TweenMax: 'gsap/TweenMax.js' 
})

// exports of 'gsap/TweenMax.js' are loaded into every module
// under the name TweenMax so you can use anywhere in your modules

/* index.js */

import $ from 'jquery';
// note here that TweenMax is not imported manually

$(document).ready(() => {
    TweenMax.to('.js-animated-element', 1, {
        autoAlpha: 1
    });
});
```
Beware, assigning an identifier to a module with `ProvidePlugin` imports it to every module, but does not automatically assign to `window` object. 
If you need to expose variable globally(some jQuery plugins require this), you can use the example below.   

__Example with global exposure:__

```
/* webpack.config.js */

new webpack.ProvidePlugin({
  $: 'jquery',
  jQuery: 'jquery',
  // line below assigns jquery to window.jQuery
  'window.jQuery': 'jquery', 
})
```

#### Importing js libraries from vendor folder

Not all libraries are available through npm. 
In that case you can vendor them inside the `static/js/vendor` folder.

```
my-project
- slice
- static
-- js
--- vendor (place vendored libs here)

/* vendor.js */

import 'vendor/vendored-plugin-not-on-npm';

/* index.js */

import VendoredPlugin from 'vendor/vendored-plugin-not-on-npm';
```

-----------

#### Caveats and notes

Some plugins such as gsap custom plugins require dependencies which don't resolve automatically and create odd errors.

In such cases you may need to set those dependencies as externals so they don't break the build.

__Example:__
```
/* webpack.config.js */

module.exports = {
    ...
    externals: {
        'TweenLite': 'TweenLite',
        'TimelineMax': 'TimelineMax',
        'TweenMax': 'TweenMax'
    }
};
```

__You can read more about about ES6 modules [here](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import).__  

------------------

###### *Meaning of importing for side effects
  * when you need to import something that doesn't export anything, but does something else, this is a side effect only module. You import it only to __initialize it__
  * examples of side effects
    * a polyfill that enables features in the browsers that don't support them, e.g. babel polyfill or svgxuse
    * jQuery plugins that attach themselves to the global jQuery object
 
  * further information about the subject can be found [here](https://stackoverflow.com/a/41127559/5278557)
                
### CSS

You can reference s(css) libraries and partials directly from `node_modules`, webpack will resolve them automatically.

__Example:__
```
/* style.scss */

@import "~susy/sass/susy";
``` 

Other libraries that are not available through npm need to be placed inside `static/scss/plugins` folder. 


## License

MIT © [Degordian](https://www.degordian.com/)


[npm-image]: https://badge.fury.io/js/generator-degordian-phprontend.svg
[npm-url]: https://npmjs.org/package/generator-degordian-phprontend
[travis-image]: https://travis-ci.org/degordian/generator-degordian-phprontend.svg?branch=master
[travis-url]: https://travis-ci.org/degordian/generator-degordian-phprontend
[daviddm-image]: https://david-dm.org/degordian/generator-degordian-phprontend.svg?theme=shields.io
[daviddm-url]: https://david-dm.org/degordian/generator-degordian-phprontend
[coveralls-image]: https://coveralls.io/repos/degordian/generator-degordian-phprontend/badge.svg
[coveralls-url]: https://coveralls.io/r/degordian/generator-degordian-phprontend
