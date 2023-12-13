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

// Function to add a marker to the map
function addMarker(farmer) {
    var position = new google.maps.LatLng(farmer.latitude, farmer.longitude);
    var iconUrl = getIconForCropStatus(farmer.crop_status);

    // Custom icon size and other properties for a smaller, more formal design
    var icon = {
        url: iconUrl, // URL of the image
        scaledSize: new google.maps.Size(20, 20), // Size of the marker
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(10, 10) // Anchor point for the marker
    };

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: farmer.farm_n,
        icon: icon
    });

    google.maps.event.addListener(marker, 'click', function() {
        showFarmerDetails(farmer.ID);
    });

    markers.push(marker);
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

    clearMarkers(); // Clear existing markers

    for (var farmerID in farmersData) {
        var farmer = farmersData[farmerID];
        var matchesCropName = !cropName || farmer.crop_name.toLowerCase() === cropName;
        var matchesCropStatus = !cropStatus || farmer.crop_status.toLowerCase() === cropStatus;

        if (matchesCropName && matchesCropStatus) {
            addMarker(farmer);
        }
    }
}



window.onload = initMap;
