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
        #map {
            height: 1000px;
        }
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
                const response = await fetch('/api/post/getPostsByTags?requiredtagids=[1,2,3]', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    // Plot markers for each post's address
                    data.posts.forEach(post => {
                        const {
                            latitude,
                            longitude
                        } = post.address;
                     const marker=   L.marker([latitude, longitude]).addTo(map)
                            .bindPopup(`<b>${post.title}</b><br>${post.address.name}`);
                        // Add click event listener to the marker
                        marker.on('click', function() {
                            const postJSON = JSON.stringify(post);
                            Android.onMarkerClick(postJSON);
                        });
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