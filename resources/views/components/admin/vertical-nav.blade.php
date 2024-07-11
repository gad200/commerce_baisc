<div>
    <nav class="nav">

        <div>
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <p>{{Auth::guard('admin')->user()->name}}</p>
        </div>

        <!-- Vertical Navigation List -->
        <ul >
            <li  class="list-group-item">
                <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                    <img src="{{@asset('/image/Dashboard icon.png')}}">
                    Dashboard
                </a>
            </li>
            <li  class="list-group-item" >
                <a class="d-flex align-items-center" href="{{route('admin.orders')}}">
                    <img src="{{@asset('/image/Order.png')}}">
                    Orders
                </a>
            </li>
            <li  class="list-group-item" >
                <a class="d-flex align-items-center" href="{{route('admin.products')}}">
                    <img src="{{@asset('/image/Marketplace - store.png')}}">
                    Products
                </a>
            </li>
            <li  class="list-group-item" >
                <a class="d-flex align-items-center" href="{{route('admin.categories')}}">
                    <img src="{{@asset('/image/cat.png')}}">
                    Categories
                </a>
            </li>
            <li  class="list-group-item" >
                <a class="d-flex align-items-center" href="{{route('admin.sellers')}}">
                    <img src="{{@asset('/image/Vector.png')}}">
                    Sellers
                </a>
            </li>
            <li  class="list-group-item" >
                <a class="d-flex align-items-center" href="{{route('admin.customers')}}">
                    <img src="{{@asset('/image/customer.png')}}">
                    Customers
                </a>
            </li>
            <form method="POST" action="{{route('admin.logout')}}">
                @csrf

                <button class="btn btn-success" type="submit">
                    <img class="logout" src="{{@asset('/image/Icon-logout.png')}}" alt="Image 4">
                    Log Out
                </button>
            </form>
        </ul>
    </nav>
</div>
