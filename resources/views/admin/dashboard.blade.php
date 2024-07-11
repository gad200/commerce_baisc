@extends('layouts.adminApp')
@section('title', 'Dashboard')

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
                        <div class="header" style="display: flex; justify-content: space-between">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="display: flex; justify-content: flex-end; margin-top: 8px">
                            <form  action="{{ route('admin.dashboard.statistics') }}" method="GET">
                                @csrf
                                <input type="month" name="date" type="date" id="selectedDate" name="date" style="padding: 5px;">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--first row-->
                <div class="row ">
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/1.png')}}" alt="">
                            <p>Total Visitors</p>
                            <h4>{{$vars['visitors']}} Visitors</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rateVisitors']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/2.png')}}" alt="">
                            <p>New Customers</p>
                            <h4>{{$vars['new_customers']}} Customers</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rate_customers']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/3.png')}}" alt="">
                            <p>Conversion rate</p>
                            <h4>{{$vars['Conversion_rate']}}%</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rateConversion']}}%</span>
                            From Last Month
                        </div>
                    </div>
                </div>
                <!--second row-->
                <br>
                <div class="row ">
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/4.png')}}" alt="">
                            <p>Total Products</p>
                            <h4>{{$vars['products']}} Product</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rateProducts']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/5.png')}}" alt="">
                            <p>Sales</p>
                            <h4>{{$vars['sales']}} EGP</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rateSales']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/6.png')}}" alt="">
                            <p>Avg Order value</p>
                            <h4>{{$vars['avg_orders_value']}} EGP</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rate_avg_orders_value']}}%</span>
                            From Last Month
                        </div>
                    </div>
                </div>
                <!--third row-->
                <br>
                <div class="row ">
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/Group 182 (5).png')}}" alt="">
                            <p>Total Orders</p>
                            <h4>{{$vars['orders']}} Order</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rateOrders']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/Group 182 (4).png')}}" alt="">
                            <p>Total Orders delivered</p>
                            <h4>{{$vars['delivered_orders']}} Order</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rate_delivered_orders']}}%</span>
                            From Last Month
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/Group 182 (3).png')}}" alt="">
                            <p>Total Orders returned</p>
                            <h4>{{$vars['returned_orders']}} Order</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rate_returned_orders']}}%</span>
                            From Last Month
                        </div>
                    </div>
                </div>
                <!--forth row-->
                <br>
                <div class="row ">
                    <div class="col-4">
                        <div class="box">
                            <img src="{{@asset('/image/Group 182 (6).png')}}" alt="">
                            <p>Total Orders pending</p>
                            <h4>{{$vars['pending_orders']}} Order</h4>
                            <img src="{{@asset('/image/UP.png')}}" alt="">
                            <span>{{$vars['rate_pending_orders']}}%</span>
                            From Last Month
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div >
                            <h2>Visited By Device</h2>
                            <form  action="{{ route('admin.dashboard.device') }}" method="GET">
                                @csrf
                                <input type="month" name="date" type="date" id="selectedDate" name="date" style="padding: 5px;">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </form>
                        </div>
                        <div class="d-flex">
                            <h3>{{$user_devices['phone_rate']}}% </h3>
                            <h1><i class="m-2 bi bi-phone"></i></h1>
                        </div>
                        <br>
                        <div class="d-flex">
                            <h3>{{$user_devices['desktop_rate']}}% </h3>
                            <h1><i class="bi m-2 bi-pc-display-horizontal"></i></h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <h2>Best Products</h2>
                        <form action="{{ route('admin.dashboard.best-products') }}" method="GET">
                            @csrf
                            <input type="month" name="date" type="date" id="selectedDate" name="date" style="padding: 5px;">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Sold</th>
                                <th>Profit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($best_products as $best_product)
                                <tr>
                                    <td>{{$best_product->title}}</td>
                                    <td>{{$best_product->price}}</td>
                                    <td>{{$best_product->sales_count}}</td>
                                    <td>{{$best_product->price * $best_product->sales_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="m-1">
                        <h2>Latest Orders</h2>
                        <form action="{{ route('admin.dashboard.latest-orders') }}" method="GET">
                            @csrf
                            <input type="month" name="date" type="date" id="selectedDate" name="date" style="padding: 5px;">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
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
                            @foreach($latest_orders as $latest_order)
                                <tr>
                                    <td>{{$latest_order->id}}</td>
                                    <td>{{$latest_order->status}}</td>
                                    <td>{{$latest_order->items}}</td>
                                    <td>{{$latest_order->total_value}}</td>
                                    <td>{{$latest_order->user->id}}</td>
                                    <td>{{$latest_order->user->name}}</td>
                                    <td>{{$latest_order->created_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropbtn btn btn-success d-flex"> Status <i class="m-1 bi bi-caret-down"></i></button>
                                            <div class="dropdown-content">
                                                <a href="{{route('admin.dashboard.order-update', [$latest_order->id, 'in production'])}}">in production</a>
                                                <a href="{{route('admin.dashboard.order-update', [$latest_order->id, 'shipped'])}}">shipped</a>
                                                <a href="{{route('admin.dashboard.order-update', [$latest_order->id, 'cancelled'])}}">cancel</a>
                                                <a href="{{route('admin.dashboard.order-update', [$latest_order->id, 'rejected'])}}">reject</a>
                                                <a href="{{route('admin.dashboard.order-update', [$latest_order->id, 'draft'])}}">draft</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
