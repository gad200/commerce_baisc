@extends('layouts.adminApp')
@section('title', 'Sellers')

<main>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <!-- the vertical nave -->
                @include('components.admin.vertical-nav')
            </div>
            <div class="col align-items-end ">
                <!--Page Name -->
                <div class="row parent position-relative">
                    <div class="col-6">
                        <h1>Sellers</h1>
                    </div>
                    <div class="col-6 child position-absolute top-0 end-0">
                        <form class="input-group m-2 " method="POST" action="{{route('admin.sellers.search')}}">
                            @csrf
                            <input type="text" id="searchQuery" name="search" placeholder=" search " style="width: 200px;">
                            <button class="btn btn-success" type="button">Search</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Seller ID</th>
                            <th>Seller Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Certificates</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellers as $seller)
                            <tr>
                                <td>{{$seller->id}}</td>
                                <td>{{$seller->name}}</td>
                                <td>{{$seller->address ?? "NULL" }}</td>
                                <td>{{$seller->email}}</td>
                                <td>Data</td>
                                <td>Data</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$sellers->links()}}
                </div>
            </div>
        </div>
    </div>
</main>
