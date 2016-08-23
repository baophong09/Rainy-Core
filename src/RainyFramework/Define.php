<?php

/**
 * path seperator
 * ex: '/', '\'
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * root path
 * /public_html/rainyframework
 */
define('ROOT_PATH', getcwd() . DS);

/**
 * root path
 * /public_html/rainyframework/app
 */
define('APP_PATH', ROOT_PATH . 'app' . DS);

/**
 * core path
 * /public_html/rainyframework/core
 */
define('CORE_PATH', ROOT_PATH . 'core' . DS);

/**
 * Root path
 * /public_html/rainyframework/public
 */
define('ASSETS_PATH', ROOT_PATH . 'assets' . DS);

/**
 * File Extension
 *
 */
define('EXT', '.php');