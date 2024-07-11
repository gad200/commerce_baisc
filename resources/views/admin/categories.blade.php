@extends('layouts.adminApp')
@section('title', 'Categories')

<main>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <!-- the vertical nave -->
                @include('components.admin.vertical-nav')
            </div>
            <div class="col align-items-end ">
                <!--Page Name -->
                <div class="row m-3">
                    <div class="col-6">
                        <div style="display: flex; justify-content: flex-start; gap: 5px">
                            <form class="input-group mb-3" method="POST" action="{{route('admin.categories.search')}}">
                                @csrf
                                <input type="text" id="searchQuery" name="search" placeholder=" search " style="width: 200px;">
                                <button class="btn btn-success" type="button">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-6 parent position-relative">
                        <a href="{{route('admin.categories.add')}}" class="btn btn-success child position-absolute top-0 end-0">ADD CATEGORY</a>
                    </div>
                </div>
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td class="text-center">
                                    <a  href="{{route('admin.edit-category', $category->id)}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
</main>
