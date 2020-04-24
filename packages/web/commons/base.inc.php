<?php
/**
 * Base that commonizes the requirements of ARCHER.
 *
 * PHP version 5
 *
 * @category Base
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * Base that commonizes the requirements of ARCHER.
 *
 * @category Base
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * Setup our more secure friendly header information.
 */
header('X-Frame-Options: sameorigin');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=31536000');
header(
    "Content-Security-Policy: default-src 'none';"
    . "script-src 'self' 'unsafe-eval';"
    . "connect-src 'self';"
    . "img-src 'self' data:;"
    . "style-src 'self' 'unsafe-inline';"
    . "font-src 'self';"
);
header('Access-Control-Allow-Origin: *');
/**
 * Our required files, text for language and init to initialize system.
 */
require 'text.php';
require 'init.php';
/**
 * All output should be sanitized for faster browser experience.
 */
ob_start(array('Initiator', 'sanitizeOutput'));
Initiator::sanitizeItems();
Initiator::startInit();
new LoadGlobals();
