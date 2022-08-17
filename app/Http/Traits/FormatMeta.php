<?php

namespace App\Http\Traits;

trait FormatMeta
{
    public function metaListCategories($data)
    {
        return [
            'pagination' => [
                'page'    => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total'   => $data['total']
            ]
        ];
    }
}
