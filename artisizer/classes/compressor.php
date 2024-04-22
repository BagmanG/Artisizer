<?
namespace Artisizer;
class Compressor
{
    public function compress($folder)
    {
        return $this->find_images($folder);
    }
    
    private function compress_image($source, $destination, $quality) {
        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }
    
    private function find_images($directory, $quality = 30) {
        $images = [];
        $dir = new \RecursiveDirectoryIterator($directory);
        foreach (new \RecursiveIteratorIterator($dir) as $filename => $file) {
            $info = pathinfo($filename);
            if (in_array($info['extension'], ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = $filename;
            }
        }
        foreach ($images as $image) {
            $compressed_image = $this->compress_image($image, $image, $quality);
        }
        return $images;
    }
}

?>