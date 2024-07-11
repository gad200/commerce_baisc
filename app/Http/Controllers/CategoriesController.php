<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): view
    {
        $categories = Category::paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function search(Request $request): view
    {
        $search= $request->input('search');

        $categories = Category::where('name', 'like', "%$search%")
            ->paginate(10);

        return view('admin.categories', compact('categories'));
    }

    public function add_category(): view
    {
        return view('admin.add-category');
    }

    public function save_category(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
        Category::create($validated);

       return redirect()->route('admin.categories');
    }

    public function edit_category(Category $category)
    {
        return view('admin.edit-category', compact('category'));
    }

    public function save_edited_category( Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        if ($validated['name'] !== $category->name){
            $category->name = $validated['name'];
        }
        if ($validated['description'] !== $category->description){
            $category->description = $validated['description'];
        }
        $category->save();

        return redirect()->back();
    }

    public function delete_category(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories');
    }

}
