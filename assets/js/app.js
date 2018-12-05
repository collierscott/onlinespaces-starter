'use strict';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// require jQuery normally
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('popper.js');
require('bootstrap');

// console.log("Hello");
//
// $(function() {
//     console.log( 'Hello with jquery' );
// });
//
// $('#myModal').modal('show');

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/main.scss');
require('../css/app.css');
