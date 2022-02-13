<?php

class Image
{
    public $Stream;

    function __construct($stream)
    {
        $this->Stream = $stream;
    }

    public function AsBinaryString(): string
    {
        rewind($this->Stream);
        return stream_get_contents($this->Stream);
    }

    public function Dispose()
    {
        fclose($this->Stream);
    }
}

class ImageProcessor
{
    private $imageObject;
    private $imageWidth;
    private $imageHeight;
    private $imageFormat;

    function __construct($tmpPath)
    {
        $fp = fopen($tmpPath, 'rb');
        $this->imageObject = new Image($fp);

        $imgProperties = getimagesize($tmpPath);

        $this->imageWidth = $imgProperties[0];
        $this->imageHeight = $imgProperties[1];
        $this->imageFormat = $imgProperties[2];
    }

    public function Resize($width, $height): Image
    {
        $img = imagecreatefromstring($this->imageObject->AsBinaryString());

        if ($img !== false) {
            $thumbnailHandle = $this->image_resize($img, $width, $height);

            $stream = fopen('php://memory', 'r+');
            $this->GdGetImageData($thumbnailHandle, $stream);
            $thmbObj = new Image($stream);

            imagedestroy($img);
            imagedestroy($thumbnailHandle);

            return $thmbObj;
        }
    }

    public function AspectResizeWidth($width): Image
    {
        $aspectRatio = $this->imageHeight / $this->imageWidth;
        return $this->Resize($width, $width * $aspectRatio);
    }

    public function AspectResizeHeight($height): Image
    {
        $aspectRatio = $this->imageWidth / $this->imageHeight;
        return $this->Resize($height * $aspectRatio, $height);
    }

    public function ResizeRatio($ratio): Image
    {
        return $this->Resize($this->imageWidth * $ratio, $this->imageHeight * $ratio);
    }

    public function GetImage(): Image
    {
        return $this->imageObject;
    }

    private function GdGetImageData($gdImageHandle, $memoryStream)
    {
        switch ($this->imageFormat) {

            case IMAGETYPE_PNG:
                imagepng($gdImageHandle, $memoryStream);
                break;

            case IMAGETYPE_JPEG:
                imagejpeg($gdImageHandle, $memoryStream);
                break;

            default:
                return false;
                break;
        }
    }

    private function image_resize($source, $width, $height)
    {
        $thumbImg = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumbImg, $source, 0, 0, 0, 0, $width, $height, $this->imageWidth, $this->imageHeight);
        return $thumbImg;
    }
}
