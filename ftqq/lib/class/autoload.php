<?php 
if( !defined("WHMCS") ) 
{
    exit( "Access denied." );
}

if( !defined("ROOTDIR") ) 
{
    define("ROOTDIR", dirname(dirname(dirname(dirname(__DIR__)))));
}

require_once(realpath(ROOTDIR . "/init.php"));
spl_autoload_register(function($className)
{
    $className = explode("\\", $className);
    $fileName = $className[2] . ".php";
    $filePath = realpath(__DIR__ . "/" . $fileName);
    if( is_file($filePath) ) 
    {
        include_once($filePath);
    }

}

);
?>