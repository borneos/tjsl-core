<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $merchants = Merchant::sortable()
                ->where('merchants.name', 'like', '%' . $filter . '%')
                ->orWhere('merchants.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $merchants = Merchant::sortable()->paginate(10);
        }
        return view('admin.merchant.index', compact('merchants', 'filter'));
    }
}
