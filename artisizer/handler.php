<?

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define("UPLOADS_FOLDER", "uploads/");

require_once('classes/uploader.php');
require_once('classes/extractor.php');
require_once('classes/compressor.php');

use Artisizer\Uploader;
use Artisizer\Extractor;
use Artisizer\Compressor;

class Artisizer
{
    private $uploader;
    private $extractor;
    private $compressor;

    public function __construct()
    {
        $this->uploader = new Uploader();
        $this->extractor = new Extractor();
        $this->compressor = new Compressor();
    }

    public function process($uploadsDir)
    {
        $uploadData = $this->uploader->upload($uploadsDir);
        $zipFolderPath = $uploadData->zipFolderPath;
        $zipFilePath = $uploadData->zipFilePath;
        
        $this->extractZip($zipFilePath, $zipFolderPath);
        
        $this->compressImages($zipFolderPath);
        
        $this->packCompressedFolder($zipFolderPath, $zipFilePath);
        
        $this->redirectToDownload($zipFolderPath);
    }
    
    private function extractZip($zipFilePath, $zipFolderPath){
        $this->extractor->extract($zipFilePath, $zipFolderPath);
    }
    
    private function compressImages($zipFolderPath){
        $this->compressor->compress($zipFolderPath);
    }
    
    private function packCompressedFolder($zipFolderPath,$zipFilePath){
        $this->extractor->pack($zipFolderPath, $zipFilePath);
    }
    
    private function redirectToDownload($zipFolderPath){
        header('Location: ' .'download.php?folder=' . urlencode($zipFolderPath));
    }
}

$artisizer = new Artisizer();
$artisizer->process(UPLOADS_FOLDER);
?>