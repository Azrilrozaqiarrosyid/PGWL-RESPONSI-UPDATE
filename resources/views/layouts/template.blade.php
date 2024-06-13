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
            <a class="navbar-brand" href="#"><i class="fa-solid fa-road-bridge"></i> {{$title}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}"><i class="fa-solid fa-house-user"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table-point') }}"><i class="fa-solid fa-location-pin"></i> Data PJU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table-polyline') }}"><i class="fa-solid fa-arrows-split-up-and-left"></i> Data Jalan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table-polygon') }}"> <i class="fa-solid fa-building-flag"></i> Data Aset </a>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMASI </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
            <tr>
                <th>CARA PENGGUNAAN</th>
                <td> : </td>
                <td>
                    Pastikan anda telah masuk dengan akun yang sesuai. Pilih draw di bagian kiri, mulai gambar di titik yang diinginkan, kemudian isi keseluruhan data di form.
                    Anda juga dapat melihat hasil titik yang anda gambar di menu Data serta di menu dashboard
                </td>
            </tr>
            <tr>
                <th>KETERANGAN</th>
                <td> : </td>
                <td>
                    Website ini merupakan website uji coba. Segala sesuatu yang berkaitan dengan fitur atau penggunaan website ini dapat menghubungi kontak
                    yang terdapat di bagian bawah menu dashboard
                </td>
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
        var map = L.map('map').setView([-7.102344039389437, 112.40844745799747], 10);

        //basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // //marker
        // L.marker([-7.02303, 112.43498]).addTo(map)
        //     .bindPopup('Monas')
        //     .openPopup();
    </script> --}}

    @include('components.toast')

    @yield('script')
</body>
</html>



