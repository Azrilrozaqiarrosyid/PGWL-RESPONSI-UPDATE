<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css>
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-map-location-dot"></i> {{$title}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}"><i class="fa-solid fa-house-user"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Table
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('table-point') }}"><i 
                                        class="fa-solid fa-table"></i> Table 
                                    Point</a></li>
                            <li><a class="dropdown-item" href="{{ route('table-polyline') }}"><i
                                        class="fa-solid fa-table"></i> Table
                                    Polyline</a></li>
                            <li><a class="dropdown-item" href="{{ route('table-polygon') }}"><i
                                        class="fa-solid fa-table"></i> Table
                                    Polygon</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fa-solid fa-circle-info"></i> Info</a>
                    </li>


                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-clipboard"></i> Dashboard</a>
                    </li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <li class="nav-item">
                        <button class="nav-link text-danger" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                    </li>
                    </form>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Info </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
            <tr>
                <th>NAMA</th>
                <td> : </td>
                <td>Azril</td>
            </tr>
            <tr>
                <th>NIM</th>
                <td> : </td>
                <td>22/504560/SV/21660</td>
            </tr>
            <tr>
                <th>KELAS</th>
                <td> : </td>
                <td>B</td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    @yield('content')
    {{-- leaflet js --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JQUERY js --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    {{-- <script>
        // map
        var map = L.map('map').setView([-6.1753924, 106.8271528], 13);

        //basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //marker
        L.marker([-6.1753924, 106.8271528]).addTo(map)
            .bindPopup('Monas')
            .openPopup();
    </script> --}}

    @include('components.toast')

    @yield('script')
</body>
</html>
