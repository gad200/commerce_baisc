@extends('layouts.adminApp')
@section('title', 'Customers')

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
                        <h1>Customers</h1>
                    </div>
                    <div class="col-6">
                        <form class="input-group m-2" method="POST" action="{{route('admin.customers.search')}}">
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
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$customers->links()}}
                </div>
            </div>
        </div>
    </div>
</main>
