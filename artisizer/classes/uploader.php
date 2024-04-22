<?php
namespace Artisizer;

class UploadData {
    public $zipFilePath;
    public $zipFolderPath;

    public function __construct($zipFilePath, $zipFolderPath) {
        $this->zipFilePath = $zipFilePath;
        $this->zipFolderPath = $zipFolderPath;
    }
}

class Uploader
{
    public function upload($path)
    {
        if (!file_exists($path))
        {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        if (isset($_FILES['zipfile']))
        {
            $folderName = $this->getFolderName();
            $folderPath = $path . $folderName;
            if (!file_exists($folderPath))
            {
                mkdir($folderPath, 0777, true);
                chmod($folderPath, 0777);
            }
            $uploadFile = $folderPath."/" . basename($_FILES["zipfile"]["name"]);
            $uploadFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            if ($uploadFileType != "zip")
            {
                throw new \Exception("Sorry, only ZIP files are allowed.");
                return;
            }
            if (file_exists($uploadFile))
            {
                throw new \Exception("Sorry, the file already exists.");
                return;
            }
            if (move_uploaded_file($_FILES["zipfile"]["tmp_name"], $uploadFile)){
                return new UploadData($uploadFile, $folderPath."/");
            }else{
                throw new \Exception("Sorry, there was an error uploading your file.");
            }
        }
        else
        {
            throw new \Exception("Argument 'zipFile' don't exist");
        }
    }

    private function getFolderName()
    {
        return uniqid();
    }
}
?>
