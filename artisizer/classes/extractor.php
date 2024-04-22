<?php
namespace Artisizer;
use ZipArchive;
include_once('pclzip.php');
class Extractor
{
    public function extract($zipFile,$extractFolder)
    {
        if (!file_exists($zipFile))
        {
            throw new \Exception("Zip File don't exist.");
            return;
        }
        $archive = new \PclZip($zipFile);
        $result = $archive->extract(PCLZIP_OPT_PATH, $extractFolder);
        
        $this->deleteZipFile($zipFile);
    }
    
    public function pack($extractFolder,$zipFile)
    {
        $archive = new \PclZip($extractFolder."/result.zip");
        $result = $archive->create($extractFolder);
    }
    
    private function deleteZipFile($zipFile){
        if (file_exists($zipFile)) {
            unlink($zipFile);
        }
    }
}
?>
