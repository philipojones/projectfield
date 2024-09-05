function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: -6.7924, lng: 39.2083 } // Centered on Dar es Salaam
    });

    function updateBusLocations() {
        fetch('fetch_bus_locations.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(bus => {
                    new google.maps.Marker({
                        position: { lat: parseFloat(bus.current_lat), lng: parseFloat(bus.current_lng) },
                        map: map,
                        title: bus.bus_number
                    });
                });
            });
    }
    setInterval(updateBusLocations, 5000); // Update every 5 seconds
}

window.onload = initMap;
