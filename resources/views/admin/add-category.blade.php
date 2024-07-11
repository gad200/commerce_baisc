@extends('layouts.adminApp')
@section('title', 'Add-Category')

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
                        <h1>Add-Category</h1>
                    </div>
                    <div class="col-6">
                        <a href="{{route('admin.categories')}}" class="btn btn-success m-2">BACK TO CATEGORIES LIST</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <form class="border border-1 border-solid rounded p-3" method="POST" action="{{route('admin.categories.save')}}">
                            @csrf
                            <div class="row">
                                <label class="form-label">Name<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <x-text-input id="name" name="name" type="text" class="form-control"/>
                                </div>
                                    <x-input-error class=" mx-4 text-danger" :messages="$errors->get('name')" />
                            </div>
                            <div class="row">
                                <label class="form-label">Description<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <x-text-input style="width: 80%; height: 50px" id="description" name="description" type="text" class="form-control"/>
                                </div>
                                    <x-input-error class="mx-4 text-danger" :messages="$errors->get('description')" />
                            </div>
                            <center><button class="btn btn-success btn-custom-width" type="submit">ADD</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
