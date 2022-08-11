<?php

namespace App\Http\Traits;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait CloudinaryImage
{
    public function UploadImageCloudinary($data)
    {
        $path_name = $data['image']->getRealPath();
        $image = Cloudinary::upload($path_name, ["folder" => $data['folder'], "overwrite" => TRUE, "resource_type" => "image"]);
        $image_url = $image->getSecurePath();
        $ext = substr($image_url, -3);
        $ext_jpeg = substr($image_url, -4);

        if ($ext == "jpg") {
            $image_url_webp = substr($image_url, 0, -3) . "webp";
        } else if ($ext == "png") {
            $image_url_webp = substr($image_url, 0, -3) . "webp";
        } elseif ($ext == "svg") {
            $image_url_webp = substr($image_url, 0, -3) . "webp";
        } elseif ($ext_jpeg == "jpeg") {
            $image_url_webp = substr($image_url, 0, -4) . "webp";
        };
        $detail_image = [
            'public_id' =>  $image->getPublicId(),
            'file_type' =>  $image->getFileType(),
            'size'      =>  $image->getReadableSize(),
            'width'     =>  $image->getWidth(),
            'height'    =>  $image->getHeight(),
            'extension' =>  $image->getExtension(),
            'webp'      =>  $image_url_webp
        ];
        return ['url' => $image_url, 'additional_image' => json_encode($detail_image)];
    }
}
