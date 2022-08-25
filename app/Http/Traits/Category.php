<?php

namespace App\Http\Traits;

trait Category
{
    public function result_category_list($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id' => $result->id,
                'name' => $result->name,
                'slug' => $result->slug,
                'description' => $result->description ? $result->description : null,
                'image' => $result->image ? $result->image : null,
                'additional_image' => $result->additional_image ? json_decode($result->additional_image) : null
            ];
        }
        return $results;
    }
}
