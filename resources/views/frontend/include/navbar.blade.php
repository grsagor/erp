<nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Navbar</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.orders.index') }}">My Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.add.order.index') }}">Add Order</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>