document.addEventListener("DOMContentLoaded", function() {
    function fetchFeaturedAds() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "controller/userController.php?action=getFeaturedAds", true); // Adjust path if necessary
        xhr.onload = function() {
            if (xhr.status === 200) {
                var featuredAds = JSON.parse(xhr.responseText);
                displayFeaturedAds(featuredAds);
            } else {
                console.error('Error fetching featured ads:', xhr.statusText);
            }
        };
        xhr.send();
    }

    function displayFeaturedAds(ads) {
        var container = document.getElementById('featured-ads-container');
        container.innerHTML = ''; // Clear previous content

        // Set up grid container style for 2 columns
        container.style.display = 'grid';
        container.style.gridTemplateColumns = 'repeat(2, 1fr)'; // 2 columns
        container.style.gap = '20px'; // Space between items

        ads.forEach(ad => {
            var adElement = document.createElement('div');
            adElement.className = 'feature-block-one';
            adElement.style.border = '1px solid #ddd';
            adElement.style.borderRadius = '8px';
            adElement.style.overflow = 'hidden';
            adElement.style.backgroundColor = '#fff';
            adElement.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            adElement.style.padding = 'px';
            adElement.style.boxSizing = 'border-box'; // Ensure padding and border are included in element's total width and height

            adElement.innerHTML = `
                <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="image-box" style="position: relative; flex: 1;">
                        <figure class="image" style="margin: 0; overflow: hidden;">
                            <img src="${ad.image}" alt="" style="width: 100%; height: auto; display: block;">
                        </figure>
                        <div class="feature-2" style="position: absolute; top: 10px; left: 10px; background: #f00; color: #fff; padding: 5px; border-radius: 5px;">Featured</div>
                    </div>
                    <div class="lower-content" style="padding: 10px; display: flex; flex-direction: column; flex: 1;">
                        <div class="category" style="font-size: 14px; color: #666; margin-bottom: 10px;"><i class="fas fa-tags"></i><p>${ad.category}</p></div>
                        <h4 style="font-size: 16px; margin: 10px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="browse-ads-details.php">${ad.title}</a></h4>
                        <ul class="rating clearfix" style="list-style: none; padding: 0; margin: 0;">
                            <li><i class="${ad.icon_class}"></i></li>
                            <li><i class="${ad.icon_class}"></i></li>
                            <li><i class="${ad.icon_class}"></i></li>
                            <li><i class="${ad.icon_class}"></i></li>
                            <li><i class="${ad.icon_class}"></i></li>
                            <li><a href="index.php">(${ad.rating_count})</a></li>
                        </ul>
                        <ul class="info clearfix" style="list-style: none; padding: 0; margin: 0;">
                            <li><i class="far fa-clock"></i>${ad.time_ago}</li>
                            <li><i class="fas fa-map-marker-alt"></i>${ad.location}</li>
                        </ul>
                        <div class="lower-box" style="margin-top: auto;">
                            <h5 style="font-size: 16px; color: #333;"><span>Start From:</span> ${ad.price}</h5>
                            <ul class="react-box" style="list-style: none; padding: 0; margin: 0; display: flex; gap: 10px;">
                                <li><a href="index.php"><i class="icon-21"></i></a></li>
                                <li><a href="index.php"><i class="icon-22"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>`;
            container.appendChild(adElement);
        });
    }

    fetchFeaturedAds();
});
