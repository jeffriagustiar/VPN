<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li></li>

            <li class="nav-item me-auto">
                <a class="nav-link active" aria-current="page" href="{{ route('home-admin') }}">Home</a>
              </li>
              <li class="nav-item me-auto">
                <a class="nav-link active" aria-current="page" href="{{ route('list-paket') }}">List Paket</a>
              </li>
              <li class="nav-item me-auto">
                <a class="nav-link active" aria-current="page" href="{{ route('home-admin') }}">List User</a>
              </li>
        </ul>
      </div>
    </div>
  </nav>