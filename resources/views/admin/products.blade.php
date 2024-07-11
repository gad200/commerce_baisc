@extends('layouts.adminApp')
@section('title', 'Products')

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
                        <div class="m-3">
                            <form class="input-group mb-3" method="POST" action="{{route('admin.products.search')}}">
                                @csrf
                                <input type="text" id="searchQuery" name="search" placeholder=" Product Name " style="width: 200px; height: 36px">
                                <button class="btn btn-success" type="button">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Seller Name</th>
                            <th>Price</th>
                            <th>Offers</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->seller->name}}</td>
                                <td>{{$product->price}}$</td>
                                <td>{{$product->offer}}%</td>
                                <td>{{$product->quantity == 0 ? "Out Stock" : "In Stock" }}</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    <a href="{{route('admin.edit-products', $product->id)}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</main>
