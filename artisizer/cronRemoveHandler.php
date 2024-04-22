<?
$directory = "uploads/";
$timeLimit = 5 * 60; // 5 minutes in seconds

// Get all directories in the uploads directory
$directories = glob($directory . '*', GLOB_ONLYDIR);

foreach ($directories as $directory) {
    // Get the timestamp of the directory
    $timestamp = filemtime($directory);

    // Calculate the difference between the current time and the directory's timestamp
    $difference = time() - $timestamp;

    // If the difference is greater than the time limit, delete the directory
    if ($difference > $timeLimit) {
        if (is_dir($directory)) {
            rrmdir($directory);
        }
    }
}
function rrmdir($dir) {
    foreach(glob($dir . '/' . '*') as $file) {
        if(is_dir($file)){
            rrmdir($file);
        }else{
            unlink($file);
        }
    }
    rmdir($dir);
}
?>