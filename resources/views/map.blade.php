<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map { height: 1000px; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([27.7172, 85.324], 13);

        // Add a tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Fetch posts data
        async function fetchPostsData() {
            try {
                const response = await fetch('/api/getPostsByTags?requiredtagids=[1,2,3]'); // Replace with your actual tag IDs
                const data = await response.json();
                if (data.success) {
                    // Plot markers for each post's address
                    data.posts.forEach(post => {
                        const { latitude, longitude } = post.address;
                        const marker = L.marker([latitude, longitude]).addTo(map);
                        
                        // Customize marker color based on tag
                        switch (post.tags[0].name.toLowerCase()) { // Assuming each post has at least one tag
                            case 'clothing & accessories':
                                marker.setIcon(L.icon({ iconUrl: 'https://cdn.mapmarker.io/api/v1/pin?icon=laundry&size=50&background=%23B0E0E6&color=%23FFFFFF&voffset=0&hoffset=1' }));
                                break;
                            case 'electronics':
                                marker.setIcon(L.icon({ iconUrl: 'https://cdn.mapmarker.io/api/v1/pin?icon=technology&size=50&background=%238B4513&color=%23FFFFFF&voffset=0&hoffset=1' }));
                                break;
                            default:
                                marker.setIcon(L.icon({ iconUrl: 'https://cdn.mapmarker.io/api/v1/pin?icon=home&size=50&background=%23FF6347&color=%23FFFFFF&voffset=0&hoffset=1' }));
                        }

                        // Add popup with post details
                        const popupContent = `
                            <div class="popup-content">
                                <b>${post.title}</b><br>
                                <p>${post.address.name}</p>
                                <p>${post.desc}</p>
                            </div>
                        `;
                        marker.bindPopup(popupContent);
                    });
                } else {
                    console.error('Failed to fetch posts:', data.message);
                }
            } catch (error) {
                console.error('Error fetching posts:', error);
            }
        }

        // Call fetchPostsData function to fetch and plot posts data
        fetchPostsData();
    </script>
</body>
</html>
