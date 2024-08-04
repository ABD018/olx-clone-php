document.addEventListener("DOMContentLoaded", function() {
    // Determine the current page
    const isIndexPage = document.getElementById('category-container-index') !== null;
    const isCategoryPage = document.getElementById('category-container-category') !== null;

    // Function to create HTML for index.php
    function createIndexHTML(category) {
        return `
            <div class="category-block-one wow fadeInDown animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="shape">
                        <div class="shape-1" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                        <div class="shape-2" style="background-image: url(assets/images/shape/shape-2.png);"></div>
                    </div>
                    <div class="icon-box"><i class="icon-${category.icon_id}"></i></div>
                    <h5>${category.name}</h5>
                    <span>${category.count}</span>
                </div>
            </div>
        `;
    }

    // Function to create HTML for category.php
    function createCategoryHTML(category) {
        return `
            <div class="col-lg-3 col-md-6 col-sm-12 category-block">
                <div class="category-block-two wow fadeInDown animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/category-${category.id}.jpg" alt=""></figure>
                        <div class="lower-content">
                            <span>${category.count}</span>
                            <div class="icon-box"><i class="icon-${category.icon_id}"></i></div>
                            <h4><a href="browse-ads-1.php">${category.name}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Fetch and display categories
    function fetchCategories() {
        fetch('controller/userController.php?action=getCategories')
            .then(response => response.json())
            .then(categories => {
                let html = '';
                categories = categories.filter(category => category.name.toLowerCase() !== 'others'); // Filter out 'others' category

                categories.forEach(category => {
                    if (isIndexPage) {
                        html += createIndexHTML(category);
                    } else if (isCategoryPage) {
                        html += createCategoryHTML(category);
                    }
                });

                if (isIndexPage) {
                    document.getElementById('category-container-index').innerHTML = html;
                } else if (isCategoryPage) {
                    document.getElementById('category-container-category').innerHTML = html;
                }
            })
            .catch(error => console.error('Error fetching categories:', error));
    }

    fetchCategories();
});
