// Global variables
var map;
var markers = []; // Array to store map markers
var statusIcons = {};
var farmersData = {}; // Object to store farmer details keyed by ID

// Initialize the map and load farmers data
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 10.8062, lng: 122.5841 },
        zoom: 12
    });

    fetchAndDisplayFarmers();
    fetchStatusIcons();
}

// Fetch status icons from the server
function fetchStatusIcons() {
    fetch('get_icons.php')
        .then(response => response.json())
        .then(data => {
            statusIcons = data;
            refreshMarkers(); // Refresh markers once icons are loaded
        })
        .catch(error => console.error('Error fetching icons:', error));
}

// Fetch and display farmers on the map
function fetchAndDisplayFarmers() {
    fetch('get_farmer_locations.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                clearMarkers();
                data.farmers.forEach(farmer => {
                    farmersData[farmer.ID] = farmer; // Store farmer data
                    addMarker(farmer);
                });
            } else {
                console.error("Error fetching farmers:", data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Function to clear existing markers from the map
function clearMarkers() {
    markers.forEach(marker => marker.setMap(null));
    markers = [];
}

function createCustomMarker(iconUrl) {
    var markerDiv = document.createElement('div');
    markerDiv.className = 'custom-marker';
    markerDiv.style.backgroundImage = 'url(' + iconUrl + ')';
    return markerDiv;
}


// Function to add a marker to the map
function addMarker(farmer) {
    var position = new google.maps.LatLng(farmer.latitude, farmer.longitude);
    var iconUrl = getIconForCropStatus(farmer.crop_status); // Get icon based on status
    var customMarkerElement = createCustomMarker(iconUrl);

    var overlay = new google.maps.OverlayView();
    overlay.onAdd = function() {
        var layer = this.getPanes().overlayLayer;
        layer.appendChild(customMarkerElement);

        overlay.draw = function() {
            var projection = this.getProjection();
            var pixel = projection.fromLatLngToDivPixel(position);
            customMarkerElement.style.left = pixel.x + 'px';
            customMarkerElement.style.top = pixel.y + 'px';
        };
    };

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: farmer.farm_n,
        icon: iconUrl
    });

    // Event listener for each marker
    google.maps.event.addListener(marker, 'click', function() {
        showFarmerDetails(farmer.ID);
    });

    markers.push(marker);
}

// Get the appropriate icon for a given crop status
function getIconForCropStatus(crop_status) {
    return statusIcons[crop_status] || statusIcons['default']; 
}

// Show detailed information of a selected farmer in the info panel
function showFarmerDetails(farmerID) {
    var farmerDetails = farmersData[farmerID];

    if (farmerDetails) {
        var infoPanel = document.getElementById('info-panel');
        infoPanel.innerHTML = `
            <h4>${farmerDetails.farm_n || 'Unknown Farm'}</h4>
            <p>
                <strong>Farmer Name:</strong> ${farmerDetails.farmer_n || 'Unknown'}<br>
                <strong>Contact:</strong> ${farmerDetails.fcontact || 'Unknown'}<br>
                <strong>Age:</strong> ${farmerDetails.age || 'Unknown'}<br>
                <strong>Sex:</strong> ${farmerDetails.sex || 'Unknown'}<br>
                <strong>Area (hectars):</strong> ${farmerDetails.area || 'Unknown'}<br>
                <strong>Barangay:</strong> ${farmerDetails.barangay || 'Unknown'}<br>
                <strong>Crop Name:</strong> ${farmerDetails.crop_name || 'Unknown'}<br>
                <strong>Crop Status:</strong> ${farmerDetails.crop_status || 'Unknown'}
            </p>
        `;
    }
}

// Function to refresh and display markers based on the latest data
function refreshMarkers() {
    clearMarkers();
    fetchAndDisplayFarmers();
}

// Function to filter farmers based on crop name and crop status
function filterFarms() {
    var cropName = document.getElementById('crop-name').value.toLowerCase();
    var cropStatus = document.getElementById('crop-status').value.toLowerCase();

    var filteredFarmers = Object.values(farmersData).filter(farmer => 
        farmer.crop_name.toLowerCase().includes(cropName) && 
        farmer.crop_status.toLowerCase().includes(cropStatus)
    );

    clearMarkers();
    filteredFarmers.forEach(addMarker);
}

// Modified createCustomMarker function
function createCustomMarker(iconUrl, size, shape) {
    var markerDiv = document.createElement('div');
    markerDiv.className = 'custom-marker ' + shape; // Apply shape class
    markerDiv.style.backgroundImage = 'url(' + iconUrl + ')';
    markerDiv.style.width = size.width + 'px';
    markerDiv.style.height = size.height + 'px';
    return markerDiv;
}

// Modified addMarker function
function addMarker(farmer) {
    var position = new google.maps.LatLng(farmer.latitude, farmer.longitude);
    var iconUrl = getIconForCropStatus(farmer.crop_status);

    // Customize size and shape based on your requirement
    var customMarkerElement = createCustomMarker(iconUrl, { width: 30, height: 30 }, 'pointer');

    var overlay = new google.maps.OverlayView();
    overlay.onAdd = function() {
        var layer = this.getPanes().overlayMouseTarget;
        layer.appendChild(customMarkerElement);

        overlay.draw = function() {
            var projection = this.getProjection();
            var pixel = projection.fromLatLngToDivPixel(position);
            customMarkerElement.style.left = (pixel.x - 10) + 'px'; // Centering the marker
            customMarkerElement.style.top = (pixel.y - 10) + 'px';
        };
    };
    overlay.setMap(map);

    // Event listener for custom marker
    google.maps.event.addDomListener(customMarkerElement, 'click', function() {
        showFarmerDetails(farmer.ID);
    });
}

window.onload = initMap;
