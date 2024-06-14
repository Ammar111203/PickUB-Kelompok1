<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container-fluid {
            display: flex;
            height: 100%;
        }
        .nav {
            gap: 16px;
        }
        .nav-item {
            width: 217px;
            height: 44px;
            background-color: #00537d;
            border-radius: 10px;
        }
        .sidebar {
            background-color: #007bff;
            color: white;
            padding-top: 56px;
            padding-left: 32px;
            width: 280px;
            display: flex;
            flex-direction: column;
            gap: 96px;
        }
        .content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        #map {
            flex-grow: 1;
        }
        .form-container {
            padding: 15px;
            width: 280px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <h2>PickUB</h2>
            <ul class="nav flex-column nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('order.index') }}">Order</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div id="map"></div>
        </div>
        <div class="form-container">
            <h1>Hai, Sayang</h1>
            <p>Buat Pesanan</p>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="order_type">Minta apa?</label>
                    <select id="order_type" name="order_type" class="form-control">
                        <option value="Antar Aku">Antar Aku</option>
                        <option value="Antar Pesananku">Antar Pesananku</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="origin">Dari mana?</label>
                    <input type="text" id="origin" name="origin" class="form-control">
                </div>
                <div class="form-group">
                    <label for="destination">Mau ke mana?</label>
                    <input type="text" id="destination" name="destination" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Untuk lebih jelasnya bagaimana?</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Order Sekarang!</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.200000, 106.816666], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var originInput = document.getElementById('origin');
            var destinationInput = document.getElementById('destination');

            var originMarker, destinationMarker;

            map.on('click', function(e) {
                var latlng = e.latlng;
                if (!originMarker) {
                    originMarker = L.marker(latlng, { draggable: true }).addTo(map)
                        .bindPopup('Dari sini').openPopup();
                    originInput.value = latlng.lat + ',' + latlng.lng;

                    originMarker.on('dragend', function(event) {
                        var marker = event.target;
                        var position = marker.getLatLng();
                        originInput.value = position.lat + ',' + position.lng;
                    });
                } else if (!destinationMarker) {
                    destinationMarker = L.marker(latlng, { draggable: true }).addTo(map)
                        .bindPopup('Mau ke sini').openPopup();
                    destinationInput.value = latlng.lat + ',' + latlng.lng;

                    destinationMarker.on('dragend', function(event) {
                        var marker = event.target;
                        var position = marker.getLatLng();
                        destinationInput.value = position.lat + ',' + position.lng;
                    });
                }
            });
        });
    </script>
</body>
</html>
