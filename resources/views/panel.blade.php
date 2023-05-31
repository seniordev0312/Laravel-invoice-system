<div class="wrapper">
    <div class="menu">
        <ul class="navbar-nav">
        <div class="nav-item">
                <img src="{{ asset('images/polymorphe_logo_retina.png') }}" alt="Logo" class="logo">
        </div>
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/sc_admin">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/label">Label</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">ShopCart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/invoice">Invoice</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.search.view') }}">Inventory</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link btn btn-link" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            </li>
        </ul>
    </div>
