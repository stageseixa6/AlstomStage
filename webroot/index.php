    <?php

/* 
 * definir le dossier racine
 */
session_start();
define ('WEBROOT', dirname(__FILE__));

define ('ROOT',dirname(WEBROOT));
define ('SERVER',$_SERVER['HTTP_HOST']);

define ('DS',DIRECTORY_SEPARATOR);
define ('CORE',ROOT.DS.'core');
define ('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])).'.');
define ('BASE_SITE',dirname($_SERVER['SCRIPT_NAME']));

include CORE.DS.'includes.php';

$d=new Dispatcher();


    /*
     * definir le dossier racine
     *
    session_start();
    define('WEBROOT', dirname(__FILE__));

    //define ('ROOT',dirname(WEBROOT));
    define('ROOT', 'alstom');
    //define ('SERVER',$_SERVER['HTTP_HOST']);

    define('DS', DIRECTORY_SEPARATOR);
   // define('DS', '/');
    define('CORE', ROOT . DS . 'core');
    //define ('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
    //define ('BASE_SITE',dirname($_SERVER['SCRIPT_NAME']));

    include CORE . DS . 'includes.php';

    $d = new Dispatcher();*/


