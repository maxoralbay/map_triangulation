<?php
// autoload class
function autoload($class)
{
    // Directories that belong to the SYSTEM
    $system_dirs = ['Http', 'MVC', 'Router'];

    // Directories that belong to the APPLICATION
    $application_dirs = ['Controllers', 'Models', 'Services'];

    // Convert namespace to path format
    $path = str_replace('\\', '/', $class);

    // Extract the first part of the namespace to determine the directory
    $parts = explode('/', $path);
    $base_dir = $parts[0];

    // Determine the correct prefix (SYSTEM or APPLICATION)
    if (in_array($base_dir, $system_dirs)) {
        $file = SYSTEM . $path . '.php';
    } elseif (in_array($base_dir, $application_dirs)) {
        $file = APPLICATION . $path . '.php';
    } else {
        // Default to SYSTEM if the directory isn't specified
        $file = SYSTEM . $path . '.php';
    }

//    echo $file . '<br>';

    // Check if the file exists before including
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "Error: File not found - $file<br>";
    }
}


// set autoload function
spl_autoload_register('autoload');

// load helper
require_once SYSTEM . 'Helper/public.php';
