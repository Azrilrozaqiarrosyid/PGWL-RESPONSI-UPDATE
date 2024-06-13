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
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal edit polygon -->
    <div class="modal fade" id="PolygonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="PolygonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-polygon', $id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="Name" class="form-label">Nama Pelapor</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill Polygon Name">
                        </div>

                        <div class="mb-3">
                            <label for="Nomor" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor" name="nomor"
                                placeholder="Isi Nomor">
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

                            <input type="hidden" class="form-control" id="image_old" name="image_old">

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
    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script>
        //map
        var map = L.map('map').setView([-6.1753924, 106.8271528], 13);

        //basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: false,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layers) {
                var geojson = layers.toGeoJSON();

                var wkt = Terraformer.geojsonToWKT(geojson.geometry);

                $('#name').val(layers.feature.properties.name);
                $('#nomor').val(layers.feature.properties.nomor);
                $('#jenis').val(layers.feature.properties.jenis);
                $('#status').val(layers.feature.properties.status);
                $('#description').val(layers.feature.properties.description);
                $('#geom_Polygon').val(wkt);
                $('#image_old').val(layers.feature.properties.image);
                $('#preview-image-polygon').attr('src', "{{ asset('storage/images/') }}/" +
                layers.feature.properties.image);
                $('#PolygonModal').modal('show');
            });
        });

        /* GeoJSON Polygon */
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                //add polygon layer to drawItems
                drawnItems.addLayer(layer);

                var popupContent = 
            "<div style='background-color: #f0f8ff; color: #2c3e50; padding: 2px; border-radius: 5px;'>" +
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
                "</div>";
            "</div>";

                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygon', $id) }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
            map.fitBounds(polygon.getBounds());
        });
    </script>
@endsection

