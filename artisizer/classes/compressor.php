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

        // Create a new image from the source file
        $image = null;
        switch ($info['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            default:
                $image = null;

                break;
        }

        // Save the compressed image to the destination file
        switch ($info['mime']) {
            case 'image/jpeg':
                imagejpeg($image, $destination, $quality);
                break;
            case 'image/gif':
                imagegif($image, $destination);
                break;
            case 'image/png':
                imagepng($image, $destination, ($quality / 10)); // PNG quality is from 0 (lowest) to 9 (highest)
                break;
        }

        // Free up memory
        if($image)
            imagedestroy($image);

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