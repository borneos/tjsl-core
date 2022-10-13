<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function get_banners(Request $request)
    {
        $sort = $request->sort ?? 'desc';
        $query = Banner::orderBy('id',$sort)->get();
        if($query->count() == 0){
            $results = (object)[];
        }else{
            foreach($query as $item){
                $results[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image' => $item->image ? $item->image : null,
                    'additionalImage' => $item->additional_image ? json_decode($item->additional_image) : null,
                    'link' => $item->url ? $item->url : ''
                ];
            }
            return response()->json(['status' => 'success','data'=> $results]);
        }
    }
}
