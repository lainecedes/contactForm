<?php
// Check if Xdebug is installed and available
if (function_exists('xdebug_info')) {
    // Call the xdebug_info() function to show the Xdebug configuration
    xdebug_info();
} else {
    echo "Xdebug is not installed or enabled.";
}

