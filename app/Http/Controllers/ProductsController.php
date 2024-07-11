<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): view
    {
        $products = Product::with('seller', 'category')->paginate(10);;
        return view('admin.products', compact('products'));
    }

    public function search(Request $request): view
    {
        $search= $request->input('search');

        $products = Product::with('seller', 'category')
            ->where('title', 'like', "%$search%")
            ->paginate(10);

        return view('admin.products',compact('products'));
    }

    public function edit_product(Product $product): view
    {
        return view('admin.edit-product', compact('product'));
    }

    public function save_edited_product(EditProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['title'] !== $product->title) {
            $product->title = $validated['title'];
        }

        if ($validated['subtitle'] !== $product->subtitle) {
            $product->subtitle = $validated['subtitle'];
        }

        if ($validated['description'] !== $product->description) {
            $product->description = $validated['description'];
        }

        if ($validated['quantity'] !== $product->quantity) {
            $product->quantity = $validated['quantity'];
        }

        if ($validated['price'] !== $product->price) {
            $product->price = $validated['price'];
        }

        if ($validated['offer'] !== $product->offer) {
            $product->offer = $validated['offer'];
        }

        if ($validated['color'] !== $product->variation->color) {
            $product->variation->update(['color' => $validated['color']]);
        }

        if ($validated['size'] !== $product->variation->size) {
            $product->variation->update(['size' => $validated['size']]);
        }

        if ($validated['category'] !== $product->category->name) {
            $product->category->update(['name' => $validated['category']]);
        }

        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid('image_') . '.' . $image->getClientOriginalExtension();

                $image->storeAs('images', $filename);

                $uploadedImages[] = ['image' => $filename];
            }
        }
        $product->images()->createMany($uploadedImages);

        $product->save();

        return redirect()->back();
    }

    public function delete_product_image(ProductImage $productImage): RedirectResponse
    {
        $imagePath = public_path('productImages/' . $productImage->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $productImage->delete();


        return redirect()->back();
    }

    public function delete_product(Product $product)
    {
        $product->delete();
        $products = Product::with('seller', 'category')->paginate(10);;
        return redirect()->route('admin.products', compact('products'));
    }
}
