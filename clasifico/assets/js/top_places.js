document.addEventListener('DOMContentLoaded', function() {
    // Function to create HTML for place items
    function createPlaceHTML(place, index) {
        var colSize = place.size || '4'; // Default to size 4 if not provided
        return `
            <div class="col-lg-${colSize} col-md-6 col-sm-12 place-block">
                <div class="place-block-one wow fadeInDown animated animated" data-wow-delay="${index * 200}ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="${place.image}" alt="${place.name}"></figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h3><a href="index.html">${place.name}</a></h3>
                                <span>${place.listing_count} Listing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Fetch and display place items
    function fetchPlaces() {
        fetch('controller/userController.php?action=getPlaces')
            .then(response => response.json())
            .then(places => {
                var placesContainer = document.getElementById('places-container');
                let html = '';
                places.forEach(function(place, index) {
                    html += createPlaceHTML(place, index);
                });
                placesContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching places:', error));
    }

    fetchPlaces();
});
