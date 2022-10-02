<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function get_banners()
    {
        $query = Banner::all();
        if($query->count() == 0){
            $results = (object)[];
        }else{
            foreach($query as $item){
                $results[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image' => $item->image ? $item->image : null,
                    'additionalImage' => $item->additional_image ? $item->additional_image : null,
                    'link' => $item->url ? $item->url : ''
                ];
            }
            return response()->json(['status' => 'success','data'=> $results]);
        }
    }
}
