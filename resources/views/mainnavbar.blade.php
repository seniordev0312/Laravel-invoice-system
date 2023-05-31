<nav class="mainnavbar">
  <div class="navbar-brand">
    <div class="nav-item">
    <img src="{{ asset('images/polymorphe_logo_retina.png') }}" alt="Logo">
  </div>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link btn" href="/">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn" href="/label">Label</a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn" href="/products">Product</a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn" href="{{ route('product.search.view') }}">Inventory</a>
    </li>
  </ul>
</nav>
