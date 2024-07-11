<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index(): view
    {
        $sellers = Seller::paginate(10);
        return view('admin.sellers', compact('sellers'));
    }

    public function search(Request $request): view
    {
        $search= $request->input('search');

        $sellers = Seller::where('name', 'like', "%$search%")
            ->paginate(10);

        return view('admin.sellers', compact('sellers'));
    }
}
