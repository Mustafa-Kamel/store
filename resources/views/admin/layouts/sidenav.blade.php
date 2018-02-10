{{-- Side Navigation --}}
<div class="col-md-2">
    <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="current"><a href="{{route('admin.index')}}"><i class="glyphicon glyphicon-home"></i>
                    Dashboard</a></li>
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Products <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    {{--  <li><a href="{{action('ProductController@index')}}">Products</a></li>  --}}
                    <li><a href="{{route('products.index')}}">Products</a></li>
                    <li><a href="{{route('products.create')}}">Add Product</a></li>
                    {{--  <li><a href="{{action('ProductController@create')}}">Add Product</a></li>  --}}
                    {{--  <li><a href="{{url('admin/products/create')}}">Add Product</a></li>  --}}
                </ul>
            </li>
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Categories <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="{{action('CategoryController@index')}}">Categories</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">
                    <i class="glyphicon glyphicon-list"></i> Orders <span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li><a href="{{route('orders.index', 'pending')}}">Pending Orders</a></li>
                    <li><a href="{{route('orders.index', 'delivered')}}">Delivered Orders</a></li>
                    <li><a href="{{route('orders.index')}}">All Orders</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div> <!-- ADMIN SIDE NAV-->