<?php
echo "API is working!<br>";
echo "Host: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "PHP Version: " . phpversion() . "<br>";

// Check if assets exist
if (file_exists(__DIR__ . '/../css/index.css')) {
    echo "✓ CSS files accessible<br>";
} else {
    echo "✗ CSS files NOT found<br>";
}

if (file_exists(__DIR__ . '/../img')) {
    echo "✓ IMG folder accessible<br>";
} else {
    echo "✗ IMG folder NOT found<br>";
}
?>
