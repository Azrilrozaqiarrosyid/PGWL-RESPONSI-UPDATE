@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        html,
        body,
        {
        height: 100%;
        width: 100%;
        margin: 0;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }

        /* Background pada Judul */
        *.info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
        }

        .info h2 {
            margin: 0 0 5px;
            color: #777;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal create point -->
    <div class="modal fade" id="PointModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="PointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #F0F8FF">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">LAPOR KERUSAKAN PJU</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-point') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Nama Pelapor</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Isi nama pihak (Instansi/Pemerintah)">
                        </div>
                        <div class="mb-3">
                            <label for="Nomor" class="form-label">Lokasi Kerusakan</label>
                            <input type="text" class="form-control" id="nomor" name="nomor"
                                placeholder="Isi Jalan/Desa/Kecamatan">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Jenis" class="form-label">Kerusakan</label>
                            <select class="form-select" aria-label="Default select example" id="jenis" name="jenis">
                            <option selected>Pilih Kerusakan</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Status" class="form-label">Status Perbaikan</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                            <option selected>Pilih</option>
                            <option value="Baru Dilaporkan">Baru Dilaporkan</option>
                            <option value="Telah Disurvei">Telah Disurvei</option>
                            <option value="Proses Perbaikan">Proses Perbaikan</option>
                            <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Area dan Kerusakan </label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_Point" name="geom" rows="3" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').
                                src = window.URL.createObjectURL(this.files[0])"></input>
                        </div>
                        <div class="mb-3">
                            <img src="" alt="Preview" id="preview-image-point" class="img-thumbnail"
                                width="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal create Polyline -->
    <div class="modal fade" id="PolylineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="PolylineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #F0F8FF">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">LAPOR KERUSAKAN JALAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-polyline') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Pihak Pelapor</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Isi nama pihak (instansi/pemerintah).">
                        </div>

                        <div class="mb-3">
                            <label for="Nomor" class="form-label">Lokasi Kerusakan</label>
                            <input type="text" class="form-control" id="nomor" name="nomor"
                                placeholder="Isi jalan/desa/kecamatan">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Jenis" class="form-label">Jenis Kerusakan</label>
                            <select class="form-select" aria-label="Default select example" id="jenis" name="jenis">
                            <option selected>Pilih Kerusakan</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Status" class="form-label">Status Perbaikan</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                            <option selected>Pilih Status</option>
                            <option value="Baru Dilaporkan">Baru Dilaporkan</option>
                            <option value="Telah Disurvei">Telah Disurvei</option>
                            <option value="Proses Perbaikan">Proses Perbaikan</option>
                            <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Area dan Kerusakan </label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_Polyline" name="geom" rows="3" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').
                                src = window.URL.createObjectURL(this.files[0])"></input>
                        </div>
                        <div class="mb-3">
                            <img src="" alt="Preview" id="preview-image-polyline" class="img-thumbnail"
                                width="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create Polygon -->
    <div class="modal fade" id="PolygonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="PolygonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #F0F8FF">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">LAPOR KERUSAKAN BANGUNAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-polygon') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Pihak Pelapor</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Isi nama pihak (instansi/pemerintah).">
                        </div>

                        <div class="mb-3">
                            <label for="Nomor" class="form-label">Lokasi Kerusakan</label>
                            <input type="text" class="form-control" id="nomor" name="nomor"
                                placeholder="Isi jalan/desa/kecamatan">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Jenis" class="form-label">Kerusakan</label>
                            <select class="form-select" aria-label="Default select example" id="jenis" name="jenis">
                            <option selected>Pilih Kerusakan</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Status" class="form-label">Status Perbaikan</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                            <option selected>Pilih</option>
                            <option value="Baru Dilaporkan">Baru Dilaporkan</option>
                            <option value="Telah Disurvei">Telah Disurvei</option>
                            <option value="Proses Perbaikan">Proses Perbaikan</option>
                            <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Area dan Kerusakan </label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_Polygon" name="geom" rows="3" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').
                                src = window.URL.createObjectURL(this.files[0])"></input>
                        </div>
                        <div class="mb-3">
                            <img src="" alt="Preview" id="preview-image-polygon" class="img-thumbnail"
                                width="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>

    <script>
        //map
        var map = L.map('map').setView([-7.102344039389437, 112.40844745799747], 10);

        // Title
        var title = new L.Control();
        title.onAdd = function (map) {
            this._div = L.DomUtil.create("div", "info");
            this.update();
            return this._div;
        };
        title.update = function () {
            this._div.innerHTML =
                "<h4> Data Sebaran Titik Kerusakan Jalan, PJU, dan Aset Pemkab </h4>Berdasarkan Data Partisipatif Masyarakat Kabupaten Lamongan";
        };
        title.addTo(map);

        // Basemaps
        var basemap1 = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                maxZoom: 19,
                attribution:
                    'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }
        );

        var basemap2 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}",
            {
                attribution:
                    'Tiles &copy; Esri | <a href="DIVSIGUGM" target="_blank">DIVSIG UGM</a>',
            }
        );

        var basemap3 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
            {
                attribution:
                    'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>',
            }
        );

        var basemap4 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
            {
                attribution: 'Tiles &copy; OpenTopoMap | <a href="Lathan WebGIS" target="_blank">Azrill</a>'
            });

        basemap1.addTo(map);

        var baseMaps = {
            OpenStreetMap: basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Open Topo Map": basemap4,
        };

        L.control.layers(baseMaps).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);

            if (type === 'polyline') {
                // set value geometry to input geom
                $("#geom_Polyline").val(objectGeometry);
                // show modal
                $("#PolylineModal").modal('show');
                console.log("Create " + type);

            } else if (type === 'polygon' || type === 'rectangle') {
                // set value geometry to input geom
                $("#geom_Polygon").val(objectGeometry);
                // show modal
                $("#PolygonModal").modal('show');

            } else if (type === 'marker') {
                // set value geometry to input geom
                $("#geom_Point").val(objectGeometry);
                // show modal
                $("#PointModal").modal('show');

            } else {
                console.log('__undefined__');
            }
            drawnItems.addLayer(layer);
        });

        /* GeoJSON Point */
var point = L.geoJson(null, {
    onEachFeature: function(feature, layer) {
        var popupContent = 
            "<div style='background-color: #AFEEEE; color: #2c3e50; padding: 2px; border-radius: 5px;'>" +
            "<table style='width: 100%; border-collapse: collapse;'>" +
                "<tr>" +
                    "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Pelapor</td>" +
                    "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.name + "</td>" +
                "</tr>" +
                "<tr>" +
                    "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Lokasi</td>" +
                    "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.nomor + "</td>" +
                "</tr>" +
                "<tr>" +
                    "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Kerusakan</td>" +
                    "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.jenis + "</td>" +
                "</tr>" +
                "<tr>" +
                    "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Status</td>" +
                    "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.status + "</td>" +
                "</tr>" +
            "</table>" +
            "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                "'class='img-thumbnail' alt='...'>" + "<br>" +
            "<div class='d-flex flex-row mt-3'>" +
                "<a href='{{ url('edit-point') }}/" + feature.properties.id +
                "' class='btn btn-warning me-5'><i class='fa-solid fa-edit'></i></a>" +
                "<form action='{{ url('delete-point') }}/" + feature.properties.id + "'method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE') }}' +
                "<button type='submit' class='btn btn-danger' onClick='return confirm(`Hapus data ini sekarang?`)'><i class='fa-solid fa-trash'></i></button>" +
                "</form>" +
            "</div>" +
            "</div>";
            
        layer.bindPopup(popupContent);

        layer.on({
            click: function(e) {
                layer.openPopup();
            },
            mouseover: function(e) {
                layer.bindTooltip(feature.properties.status).openTooltip();
            },
        });
    },
});

$.getJSON("{{ route('api.points') }}", function(data) {
    point.addData(data);
    map.addLayer(point);
});



        /* GeoJSON Polyline*/
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
            var popupContent = 
            "<div style='background-color: #AFEEEE; color: #2c3e50; padding: 2px; border-radius: 5px;'>" +
                "<table style='width: 100%; border-collapse: collapse;'>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Pelapor</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.name + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Lokasi</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.nomor + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Kerusakan</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.jenis + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Status</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.status + "</td>" +
                    "</tr>" +
                "</table>" +

                "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt='...'>" + "<br>" +

                "<div class='d-flex flex-row mt-3'>" +

                    "<a href='{{ url('edit-polyline') }}/" + feature.properties.id +
                    "' class='btn btn-warning me-5'><i class='fa-solid fa-edit'></i></a>" +

                    "<form action='{{ url('delete-polyline') }}/" + feature.properties.id + "'method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{ method_field('DELETE') }}' +

                    "<button type='submit' class='btn btn-danger' onClick='return confirm(`Hapus data ini sekarang?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                "</div>";
            "</div>";
            
        layer.on({
            click: function(e) {
                polyline.bindPopup(popupContent).openPopup(e.latlng);
            },
            // mouseover: function(e) {
            //     polyline.bindTooltip(feature.properties.status);
            // },
        });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        /* GeoJSON Polygon*/
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
            var popupContent = 
            "<div style='background-color: #ADD8E6; color: #2c3e50; padding: 2px; border-radius: 5px;'>" +
                "<table style='width: 100%; border-collapse: collapse;'>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Pelapor</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.name + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Lokasi</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.nomor + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Kerusakan</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.jenis + "</td>" +
                    "</tr>" +
                    "<tr>" +
                        "<td style='font-weight: bold; padding: 5px; border-bottom: 1px solid #ddd;'>Status</td>" +
                        "<td style='padding: 5px; border-bottom: 1px solid #ddd;'>" + feature.properties.status + "</td>" +
                    "</tr>" +
                "</table>" +

                "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt='...'>" + "<br>" +

                "<div class='d-flex flex-row mt-3'>" +

                    "<a href='{{ url('edit-polygon') }}/" + feature.properties.id +
                    "' class='btn btn-warning me-5'><i class='fa-solid fa-edit'></i></a>" +

                    "<form action='{{ url('delete-polygon') }}/" + feature.properties.id + "'method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{ method_field('DELETE') }}' +

                    "<button type='submit' class='btn btn-danger' onClick='return confirm(`Hapus data ini sekarang?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                "</div>";
            "</div>";
            
        layer.on({
            click: function(e) {
                polygon.bindPopup(popupContent).openPopup(e.latlng);
            },
            // mouseover: function(e) {
            //     polygon.bindTooltip(feature.properties.status);
            // },
        });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // layer control
        var overlayMaps = {
            "Point": point,
            "Polyline": polyline,
            "Polygon": polygon
        };
        var layerControl = L.control.layers(null, overlayMaps, {
            collapsed: false
        }).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150, position: 'bottomright'
        }).addTo(map);

    </script>
@endsection
