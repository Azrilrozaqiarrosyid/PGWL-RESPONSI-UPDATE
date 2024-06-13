@extends('layouts.template')

@section('styles')
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
@endsection

@section('script')
    <script>
        //map
        var map = L.map('map').setView([-7.102344039389437, 112.40844745799747], 13);

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

        /// Basemaps
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
            "</div>";
            
        layer.on({
            click: function(e) {
                point.bindPopup(popupContent).openPopup(e.latlng);
            },
            mouseover: function(e) {
                point.bindTooltip(feature.properties.name);
            },
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
            "</div>";
            
        layer.on({
            click: function(e) {
                point.bindPopup(popupContent).openPopup(e.latlng);
            },
            mouseover: function(e) {
                point.bindTooltip(feature.properties.name);
            },
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
