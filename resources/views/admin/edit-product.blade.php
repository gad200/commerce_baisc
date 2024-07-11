@extends('layouts.adminApp')
@section('title', 'Edit-Product')

<main>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <!-- the vertical nave -->
                @include('components.admin.vertical-nav')
            </div>
            <div class="col align-items-end ">
                <!--Page Name -->
                <div class="row ">
                    <div class="col-6">
                        <h1>Edit-Product</h1>
                    </div>
                    <div class="col-6">
                        <a href="{{route('admin.products')}}" class="btn btn-success m-2">BACK TO PRODUCT LIST</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <form class="border border-1 border-solid rounded p-3" method="POST" action="{{route('admin.save-edited-product', $product->id)}}"  enctype="multipart/form-data">
                            @csrf
                            <p class="fw-bold d-inline">General information</p><span class="text-danger">*</span>
                            <p class="input-info">To start selling, all you need is a name and a price.</p>
                            <!--title, subtitle-->
                            <div class="row" >
                                <div class="col-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <x-text-input id="title" name="title" type="text" class=" form-control " :value="old('title', $product->title)"/>
                                    </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('title')" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Subtitle</label>
                                    <div class="input-group mb-3">
                                        <x-text-input id="subtitle" name="subtitle" type="text" class="form-control" :value="old('subtitle', $product->subtitle)"/>
                                    </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('subtitle')" />
                                </div>
                            </div>
                            <!--Description-->
                            <div class="row">
                                <label class="form-label">Description</label>
                                <div class="input-group mb-3">
                                    <x-text-input style="height: 100px" id="description" name="description" type="text" class="form-control" :value="old('description', $product->description)"/>
                                </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('description')" />
                                <p class="input-info">Give your product a short and clear title.</p>
                                <p class="input-info">50-60 characters is the recommended length for search engines</p>
                            </div>
                            <!--quantity price offer-->
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Available Quantity<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <x-text-input style=" " id="quantity" name="quantity" type="text" class="form-control" :value="old('quantity', $product->quantity)"/>
                                    </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('quantity')" />
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Price EGP<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <x-text-input style=" " id="price" name="price" type="text" class="form-control" :value="old('price', $product->price)"/>
                                    </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('price')" />
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Offer Percentage<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <x-text-input style=" " id="offer" name="offer" type="text" class="form-control" :value="old('offer', $product->offer)"/>
                                    </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('offer')" />
                                </div>
                            </div>
                            <!--product options -->
                            <div class="row">
                                <div class="col">
                                    <p class="fw-bold">Product Options</p>
                                    <p class="input-info">Used for products that come in different variations . </p>

                                    <table>
                                        <thead >
                                        <tr >
                                            <th class="bg-success text-white">Options</th>
                                            <th class="bg-success text-white">Variations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>color</td>
                                            <td>
                                                <x-text-input style="" id="color" name="color" type="text" class="form-control" :value="old('color', $product->variation->color ?? '')"/>
                                                <x-input-error class="text-danger" :messages="$errors->get('color')" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Size</td>
                                            <td>
                                                <x-text-input style=" " id="size" name="size" type="text" class="form-control" :value="old('size', $product->variation->size ?? '')"/>
                                                <x-input-error class="text-danger" :messages="$errors->get('size')" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>category</td>
                                            <td>
                                                <x-text-input style=" " id="category" name="category" type="text" class="form-control" :value="old('category', $product->category->name )"/>
                                                <x-input-error class="text-danger" :messages="$errors->get('category')" />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <!--Thumbnail-->
                            <div class="row">
                                <p class="fw-bold">Thumbnail</p>
                                <p class="input-info">Used to represent your product during checkout, social sharing and more.</p>
                                <label for="imageUpload" class="dashed-border text-center">
                                    <span id="fileInputLabel">Drop your file here, or click to browse</span>
                                    <input style="display: none;" type="file" id="imageUpload" name="images[]" accept="image/*" multiple>
                                </label>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-wrap">
                                    @foreach($product->images as $image)
                                        <div class="card m-2" style="width: 100px; height: 100px">
                                            <img style="width: 100px; height: 100px" src="{{ asset('productImages/' . $image->image) }}" class="card-img-top" alt="Image">
                                            <div class="card-body">
                                                <a href="{{ route('admin.delete-product-image', $image->id) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.delete-product', $product->id)}}" class="delete-product">Delete This Product</a>
                            </div>
                            <br>
                            <br>
                            <div >
                                <center><button class="btn btn-success btn-custom-width" type="submit">Edit</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
