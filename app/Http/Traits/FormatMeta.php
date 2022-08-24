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
    public function metaMerchantList($data)
    {
        return [
            'pagination' => [
                'page'    => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total'   => $data['total']
            ]
        ];
    }
    public function metaBlogList($data)
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
