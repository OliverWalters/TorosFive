document.addEventListener('DOMContentLoaded', function () {
    if (navigator.geolocation) {
        var location = [36.563558, -4.855472];

        // Crear el mapa centrado en la ubicación específica
        var map = L.map('map').setView(location, 15);

        // Añadir mapa base
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Crear un marcador en la ubicación específica
        L.marker(location).addTo(map);//.bindPopup('Ubicación específica.').openPopup();

    } else {
        // Browser doesn't support Geolocation
        console.log('ERROR: Geolocation no es soportado por este navegador.');
    }
});


