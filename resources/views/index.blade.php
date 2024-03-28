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

        <!-- Modal create point -->
        <div class="modal fade" id="PointModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="PointModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('store-point') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill Point Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geom" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_Point" name="geom" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>

        <!-- Modal create Polyline -->
        <div class="modal fade" id="PolylineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="PolylineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Polyline</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('store-polyline')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill Point Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geom" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_Polyline" name="geom" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>

        <!-- Modal create Polygon -->
        <div class="modal fade" id="PolygonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="PolygonModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Polygon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('store-polygon')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill Point Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geom" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_Polygon" name="geom" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
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
        </script>
@endsection
