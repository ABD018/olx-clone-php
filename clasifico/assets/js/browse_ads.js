document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch and display categories
    function fetchCategories() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "controller/userController.php?action=getCategories", true); // Adjust path if necessary
        xhr.onload = function() {
            if (xhr.status === 200) {
                var categories = JSON.parse(xhr.responseText);
                // console.log(categories)
                displayCategories(categories);
            } else {
                console.error('Error fetching categories:', xhr.statusText);
            }
        };
        xhr.send();
    }

    // Function to display categories
    function displayCategories(categories) {
        var categoryList = document.querySelector('.category-list');
        categoryList.innerHTML = ''; // Clear previous content

        // Add 'All' category
        var allCategory = document.createElement('li');
        allCategory.innerHTML = '<a href="#" class="current" data-category="All">All</a>';
        
        categoryList.appendChild(allCategory);

        categories.forEach(category => {
            var categoryItem = document.createElement('li');
            categoryItem.innerHTML = `<a href="#" data-category="${category.name}">${category.name}</a>`;
            categoryList.appendChild(categoryItem);
        });

        // Add event listeners for category links
        var categoryLinks = document.querySelectorAll('.category-list a');
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var selectedCategory = this.getAttribute('data-category');
                
                fetchFeaturedAds(selectedCategory); // Fetch ads based on selected category
                updateActiveCategory(this); // Update the active category style
            });
        });

        document.querySelector('.searchButton').addEventListener('click', function(event) {
            event.preventDefault();
            const inputVal = document.querySelector('.searchInput').value;
            fetchFeaturedAds('', inputVal.trim());

        });
        
    }

    // Function to update active category style
    function updateActiveCategory(activeLink) {
        var links = document.querySelectorAll('.category-list a');
        links.forEach(link => {
            link.classList.remove('current');
        });
        activeLink.classList.add('current');
    }

    // Function to fetch featured ads based on selected category
    function fetchFeaturedAds(category, itemTitle) {

        category = category=="All" ? null : category;
        // console.log(category)
    
        // Construct URL based on category
        var url = category ? 
            `controller/userController.php?action=getAdsByCategory&category_id=${category}` : 
            "controller/userController.php?action=getFeaturedAds";

        if (itemTitle)
            url = `controller/userController.php?action=getAdsByItemTitle&itemTitle=${itemTitle}`
    
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        
        xhr.open("GET", url, true); // Adjust path if necessary
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var featuredAds = JSON.parse(xhr.responseText);
                    // console.log(featuredAds);
                    displayFeaturedAds(featuredAds);
                } catch (e) {
                    console.error('Error parsing JSON:', e.message);
                }
            } else {
                console.error('Error fetching featured ads:', xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Network error occurred');
        };
        xhr.send();
    }
    

    // Function to display featured ads
    function displayFeaturedAds(ads) {
        var container = document.getElementById('featured-ads-container');
        container.innerHTML = ''; // Clear previous content

        // Ensure we only display up to 9 ads
        ads = ads.slice(0, 9);

        // Set up grid container style for 3 columns
        container.style.display = 'grid';
        container.style.gridTemplateColumns = 'repeat(3, 1fr)'; // 3 columns
        container.style.gap = '20px'; // Space between items

        ads.forEach(ad => {
            var adElement = document.createElement('div');
            adElement.className = 'feature-block-one';
            adElement.style.border = '1px solid #ddd';
            adElement.style.borderRadius = '8px';
            adElement.style.overflow = 'hidden';
            adElement.style.backgroundColor = '#fff';
            adElement.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            adElement.style.padding = '0px';
            adElement.style.boxSizing = 'border-box'; // Ensure padding and border are included in element's total width and height
            adElement.style.marginBottom = '20px';

            adElement.innerHTML = `
                <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="image-box" style="position: relative; width: 100%; height: 200px; overflow: hidden;">
                        <figure class="image" style="margin: 0; width: 100%; height: 100%; overflow: hidden;">
                            <img src="${ad.image}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        </figure>
                        <div class="feature-2" style="position: absolute; top: 10px; left: 10px; background: #f00; color: #fff; padding: 5px; border-radius: 5px;">Featured</div>
                    </div>
                    <div class="lower-content" style="padding: 10px; display: flex; flex-direction: column; flex: 1;">
                        <div class="category" style="font-size: 14px; color: #666; margin-bottom: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i class="fas fa-tags"></i><p>${ad.category}</p></div>
                        <h4 style="font-size: 16px; margin: 10px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="browse-ads-details.php?id=${ad.id}">${ad.title}</a></h4>
                        
                        <ul class="info clearfix" style="list-style: none; padding: 0; margin: 0;">
                            <li style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i class="far fa-clock"></i>${ad.time_ago}</li>
                            <li style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i class="fas fa-map-marker-alt"></i>${ad.location}</li>
                        </ul>
                        <div class="lower-box" style="margin-top: auto;">
                            <h5 style="font-size: 16px; color: #333;"><span>Start From:</span> ₹${ad.price}</h5>
                            <ul class="react-box" style="list-style: none; padding: 0; margin: 0; display: flex; gap: 10px;">
                                <li><a href="#"><i class="icon-22"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-box" style="margin-top: 10px; text-align: right;">
                        <a href="browse-ads-details.php?id=${ad.id}" class="theme-btn-one" style="margin-right: 120px; margin-bottom: 10px;">Details</a>
                    </div>
                </div>`;
            container.appendChild(adElement);
        });
    }

    // Fetch categories on page load
    fetchCategories();
    
    // Fetch featured ads for all categories on page load
    fetchFeaturedAds('');
});
