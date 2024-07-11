<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomersController extends Controller
{
    public function index(): view
    {
        $customers = User::paginate(10);
        return view('admin.customers', compact('customers'));
    }

    public function search(Request $request): view
    {
        $search= $request->input('search');

        $customers = User::where('name', 'like', "%$search%")
            ->paginate(10);

        return view('admin.customers', compact('customers'));
    }

    public function promote_user_to_admin(User $user)
    {

    }
}
