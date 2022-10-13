<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Responder;
use Illuminate\Http\Request;

class ResponderController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $responders = Responder::sortable()
                ->where('responder.name', 'like', '%' . $filter . '%')
                ->orWhere('responder.email', 'like', '%' . $filter . '%')
                ->orWhere('responder.telp', 'like', '%' . $filter . '%')
                ->orWhere('responder.message', 'like', '%' . $filter . '%')
                ->latest()
                ->paginate(10);
        } else {
            $responders = Responder::sortable()->latest()->paginate(10);
        }
        return view('admin.responder.index', compact('responders', 'filter'));
    }
}
