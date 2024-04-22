<?
$source = $_GET['folder']; // the folder you want to zip
$destination = $source.'/result.zip'; // the zip file you want to create

function zip_folder($source, $destination) {
    if (file_exists($destination)) {
        unlink($destination);
    }
    $zip = new ZipArchive();
    if ($zip->open($destination, ZipArchive::CREATE) === true) {
        $source = realpath($source);
        if (is_dir($source)) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
            foreach ($files as $file) {
                $file = realpath($file);
                if (is_dir($file)) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source)) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }
        $zip->close();
    }
}

zip_folder($source, $destination);

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . basename($destination));
header('Content-Length: ' . filesize($destination));
readfile($destination);
?>
?>