<?php

namespace App\Service;

class ImageService
{
    public function createImages($image):\GdImage
    {
        $image = imagecreatefromstring(file_get_contents($image));
        return $this->resizeImage($image);
    }

    public function resizeImage($image){
        $originalWidth = ImageSX($image);
        $originalHeight = ImageSY($image);
        $maxWidth = 400;
        if ($originalWidth > $maxWidth) {
            $ratio = $maxWidth / $originalWidth;
            $maxHeight = $originalHeight * $ratio;
        } else {
            $maxWidth = $originalWidth;
            $maxHeight = $originalHeight;
        }
        imagepalettetotruecolor($image);
        $resizedImage = imagecreatetruecolor($maxWidth, $maxHeight);
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $originalWidth, $originalHeight);
        imagedestroy($image);
        return $resizedImage;
    }

    public function uploadImages($img, $id):void
    {
        $image = $this->createImages($img);
        imagejpeg($image, 'images/users/'.$id.'.jpg', 100);
        imagewebp($image, 'images/users/'.$id.'.webp', 100);
        imagedestroy($image);
    }

    public function deleteImages($id):void
    {
        if(file_exists('images/users/'.$id.'.jpg')){
            unlink('images/users/'.$id.'.jpg');
        }
        if(file_exists('images/users/'.$id.'.webp')){
            unlink('images/users/'.$id.'.webp');
        }
    }
}