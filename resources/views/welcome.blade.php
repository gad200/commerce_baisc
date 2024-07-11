<x-guest-layout>
    <div class="container">
        <center><h1>Login and Register Page</h1></center><br>
        <div class="row">
            <img  src="{{asset('/image/Login.jpeg')}}">
        </div>

        <a href="{{route('admin.login')}}" class="btn btn-success btn-custom">Admin Login</a>
        <a href="{{route('admin.register')}}" class="btn btn-success btn-custom">Admin Register</a>

        <a href="{{route('login')}}" class="btn btn-success btn-custom">User Login</a>
        <a href="{{route('register')}}" class="btn btn-success btn-custom">User Register</a>

        <a href="{{route('seller.login')}}" class="btn btn-success btn-custom">Seller Login</a>
        <a href="{{route('seller.register')}}" class="btn btn-success btn-custom">Seller Register</a>
    </div>
</x-guest-layout>
