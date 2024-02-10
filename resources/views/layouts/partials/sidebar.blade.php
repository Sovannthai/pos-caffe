<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-white elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/poslg.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->getFullname() }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link {{ activeSegment('') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if (Route::is('products.*')) menu-open @endif" >
                    <a href="" class="nav-link new">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Product Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                                class="nav-link @if (request()->routeIs('products.index')) active @endif">
                                <i class="fas fa-list nav-icon"></i>
                                <p>List Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}"
                                class="nav-link @if (request()->routeIs('products.create')) active @endif">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('unit.index') }}" class="nav-link ">
                                <i class="fa fas fa-balance-scale nav-icon"></i>
                                <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link @if (request()->routeIs('category.index')) active @endif">
                                <i class="fa fas fa-tags nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ activeSegment('customers') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction.index') }}" class="nav-link {{ activeSegment('orders') }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>All Sale</p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if (Route::is('exspend.*')) menu-open @endif">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-minus-circle"></i>
                        <p>
                            Exspenses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="{{ route('exspend.index') }}"
                                class="nav-link @if (request()->routeIs('exspend.index')) active @endif">
                                <i class="nav-icon fas fa-list"></i>
                                <p>List Exspenses</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('exspend.create') }}"
                                class="nav-link @if (request()->routeIs('exspend.create')) active @endif">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Add Exspenses</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('table.index') }}" class="nav-link @if (request()->routeIs('table.index')) active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Table</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    $(document).ready(function(){
        $("#menu-pos").click(function(){
            $("#new").toggle(1000,)
        })
    })
</script>
