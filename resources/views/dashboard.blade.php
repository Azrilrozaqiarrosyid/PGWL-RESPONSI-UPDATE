<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DASHBOARD CIVICTRACS') }}
        </h2>
    </x-slot>

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container py-12 flex-grow-1">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Ringkasan Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-primary" role="alert">
                                <h4><i class="fa-solid fa-location-dot"></i>  Total PJU Rusak Dilaporkan</h4>
                                <p style="font-size:32 pt">{{$total_points}}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-success" role="alert">
                                <h4><i class="fa-solid fa-route"></i>  Total Jalan Rusak Dilaporkan</h4>
                                <p style="font-size:32 pt">{{$total_polylines}}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-warning" role="alert">
                                <h4><i class="fa-solid fa-draw-polygon"></i> Total Bangunan Rusak Dilaporkan</h4>
                                <p style="font-size:32 pt">{{$total_polygons}}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>Anda login sebagai <b>{{ Auth::user()->name }}</b> dengan <i>{{Auth::user()->email}}</i></p>
                </div>
            </div>
        </div>
    <div class="wrapper d-flex flex-column min-vh-200">
        <div class="container py-10 flex-grow-1">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Tentang Kami</h3>
                </div>
                <div class="card-body">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">CIVICTRACS</h1>
                        <p class="lead fw-normal text-muted mb-5">
                            Civil Infratructure Tracking and Reporting System (CIVICTRACS) merupakan Website berbasis Sistem Informasi Geografis (SIG)
                            yang mengintegrasikan antara WebGIS yang dibangun dengan Laravel PHP dengan database PostgreSQL. CIVITRACS telah diintegrasikan
                            dengan QGIS dan juga Geoserver dan menyediakan akses untuk administrator dalam melakukan pelaporan kerusakan Penerangan Jalan Umum (PJU),
                            Jalan, dan juga Bangunan umum. Administrator hanya perlu menandai dan mengisi formulir yang langsung dapat diakses oleh pemerintah
                            Kabupaten sebagai pengelola utama.
                        </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-10 flex-grow-1">
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder mb-4">KOLABORASI</h1>
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="image-container">
                            <img class="img-fluid rounded-3" src="storage/FOTO/LOGO UGM.jpg" alt="..." />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="image-container">
                            <img class="img-fluid rounded-3" src="storage/FOTO/LOGO_SV.png" alt="..." />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="image-container">
                            <img class="img-fluid rounded-3" src="storage/FOTO/LOGO_SIG.jpg" alt="..." />
                        </div>
                    </div>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-8">
                            <p class="lead fw-normal text-muted">AZRIL ROZAQI AR ROSYID - 22/504560/SV/21660</p>
                            <a class="text-decoration-none" href="https://github.com/Azrilrozaqiarrosyid">
                                GITHUB
                                <i class="bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px; /* Sesuaikan tinggi gambar sesuai keinginan */
        overflow: hidden;
    }

    .image-container img {
        max-height: 100%;
        max-width: 100%;
        object-fit: cover;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
</style>


        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-10">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; CIVICTRACS LAMONGAN 2024</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="https://www.lamongankab.go.id/">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="https://www.lamongankab.go.id/">Address</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="https://www.lamongankab.go.id/">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</x-app-layout>

<style>
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .flex-grow-1 {
        flex-grow: 1;
    }
</style>