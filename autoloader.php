<?php 
function autoloader(string $className){
    $prefix = 'App\\';
    $base_dir = __DIR__.'/src/';
    $len = strlen($prefix);
    if(strncmp($prefix, $className, $len) !==0){
        return;
    }
   $relative_className = substr($className, $len);
   $file = $base_dir . str_replace('\\','/', $relative_className) . '.php';
   if(file_exists($file)){
    require $file;
   }
}
spl_autoload_register('autoloader');
?>