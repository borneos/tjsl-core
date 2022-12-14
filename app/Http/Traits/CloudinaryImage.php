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
    public function UpdateImageCloudinary($data)
    {
        if ($data['collection']['image']) {
            if (substr($data['collection']['image'], 0, 4) == 'http') {
                $key = json_decode($data['collection']['additional_image']);
                Cloudinary::destroy($key->public_id);
                return $this->UploadImageCloudinary(['image' => $data['image'], 'folder' => $data['folder']]);
            } else {
                return $this->UploadImageCloudinary(['image' => $data['image'], 'folder' => $data['folder']]);
            }
        } else {
            return $this->UploadImageCloudinary(['image' => $data['image'], 'folder' => $data['folder']]);
        }
    }
    public function UpdateImageMerchantCloudinary($data)
    {
        if($data['storagePath'] == 'additionalImage' && $data['collection']['additional_image']){
            $key = json_decode($data['collection']['additional_image']);
            Cloudinary::destroy($key->public_id);
        }elseif($data['storagePath'] == 'additionalImageCover' && $data['collection']['additional_image_cover']){
            $key = json_decode($data['collection']['additional_image_cover']);
            Cloudinary::destroy($key->public_id);
        }elseif($data['storagePath'] == 'additionalImageSeo' && $data['collection']['additional_image_seo']){
            $key = json_decode($data['collection']['additional_image_seo']);
            Cloudinary::destroy($key->public_id);
        }
        return $this->UploadImageCloudinary(['image' => $data['image'], 'folder' => $data['folder']]);
    }
    public function UploadImageMultipleCloudinary($data)
    {
        foreach ($data['images'] as $item) {
            $path_name = $item->getRealPath();
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
            $additional_image[] = [
                'https'     =>  $image->getSecurePath(),
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $image_url_webp
            ];
            $result_image[] = ['url' => $image_url];
        };
        return compact('result_image', 'additional_image');
    }
    public function UpdateImageMultipleCloudinary($data)
    {
        if ($data['collection']['additional_image']) {
            foreach (json_decode($data['collection']['additional_image']) as $item) {
                Cloudinary::destroy($item->public_id);
            }
            return $this->UploadImageMultipleCloudinary(['folder' => $data['folder'], 'images' => $data['images']]);
        } else {
            return $this->UploadImageMultipleCloudinary(['folder' => $data['folder'], 'images' => $data['images']]);
        };
    }
}
