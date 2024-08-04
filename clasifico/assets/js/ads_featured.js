document.addEventListener('DOMContentLoaded', function() {
    // Function to create HTML for featured ads
    function createFeaturedAdHTML(ad, index) {
        return `
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInDown animated animated" data-wow-delay="${index * 300}ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="${ad.image}" alt=""></figure>
                            <div class="shape"></div>
                            <div class="feature">Featured</div>
                            <div class="icon">
                                <div class="icon-shape"></div>
                                <i class="${ad.icon_class}"></i>
                            </div>
                        </div>
                        <div class="lower-content">
                            <div class="author-box">
                                <div class="inner">
                                    <img src="${ad.author_image}" alt="">
                                    <h6>${ad.author_name}<i class="icon-18"></i></h6>
                                    <span>${ad.author_role}</span>
                                </div>
                            </div>
                            <div class="category"><i class="fas fa-tags"></i><p>${ad.category}</p></div>
                            <h3><a href="browse-ads-details.php?id=${ad.id}">${ad.title}</a></h3>
                            <ul class="rating clearfix">
                                ${'<li><i class="icon-17"></i></li>'.repeat(ad.rating)}
                                <li><a href="index.php">(${ad.rating_count})</a></li>
                            </ul>
                            <ul class="info clearfix">
                                <li><i class="far fa-clock"></i>${ad.time_ago}</li>
                                <li><i class="fas fa-map-marker-alt"></i>${ad.location}</li>
                            </ul>
                            <div class="lower-box">
                                <h5><span>Start From:</span>$${ad.price}</h5>
                                <ul class="react-box">
                                    <li><a href="index.php"><i class="icon-21"></i></a></li>
                                    <li><a href="index.php"><i class="icon-22"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Fetch and display featured ads
    function fetchFeaturedAds() {
        fetch('controller/userController.php?action=getFeaturedAds')
            .then(response => response.json())
            .then(ads => {
                var adsContainer = document.querySelector('.tabs-content .tab.active-tab .row');
                let html = '';
                ads.forEach(function(ad, index) {
                    html += createFeaturedAdHTML(ad, index);
                });
                adsContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching featured ads:', error));
    }

    fetchFeaturedAds();
});
