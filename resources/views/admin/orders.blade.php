@extends('layouts.adminApp')
@section('title', 'Orders')

<main>
    <div class="container">

        <div class="row">
            <div class="col-3">
                <!-- the vertical nave -->
                @include('components.admin.vertical-nav')
            </div>
            <div class="col align-items-end ">
                <!--Page Name -->
                <div class="row my-4">
                    <div class="col-6 ">
                        <div class="">
                            <div class="dropdown ">
                                <button class="dropbtn btn btn-success ">Show With Status <i class="m-1 bi bi-caret-down"></i></button>
                                <div class="dropdown-content">
                                    <a href="{{route('admin.orders.get-by-status', ['new'])}}">new</a>
                                    <a href="{{route('admin.orders.get-by-status', ['in production'])}}">in production</a>
                                    <a href="{{route('admin.orders.get-by-status', ['shipped'])}}">shipped</a>
                                    <a href="{{route('admin.orders.get-by-status', ['cancelled'])}}">canceled</a>
                                    <a href="{{route('admin.orders.get-by-status', ['rejected'])}}">rejected</a>
                                    <a href="{{route('admin.orders.get-by-status', ['draft'])}}">draft</a>
                                    <a href="{{route('admin.orders')}}">ALL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Order Cost</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->items}}</td>
                                <td>{{$order->total_value}}</td>
                                <td>{{$order->user->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropbtn btn btn-success d-flex">Status <i class="m-2 bi bi-caret-down"></i></button>
                                        <div class="dropdown-content">
                                            <a href="{{route('admin.orders.order-update', [$order->id, 'in production'])}}">in production</a>
                                            <a href="{{route('admin.orders.order-update', [$order->id, 'shipped'])}}">shipped</a>
                                            <a href="{{route('admin.orders.order-update', [$order->id, 'cancelled'])}}">cancel</a>
                                            <a href="{{route('admin.orders.order-update', [$order->id, 'rejected'])}}">reject</a>
                                            <a href="{{route('admin.orders.order-update', [$order->id, 'draft'])}}">draft</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>

</main>

