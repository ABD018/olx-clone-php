document.addEventListener('DOMContentLoaded', function() {
    // Function to create HTML for news items
    function createNewsHTML(news, index) {
        var colSize = '4'; // Default size
        return `
            <div class="col-lg-${colSize} col-md-6 col-sm-12 news-block">
                <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="${index * 200}ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="${news.image}" alt="">
                            <a href="${news.link}"><i class="fas fa-link"></i></a>
                        </figure>
                        <div class="lower-content">
                            <figure class="admin-thumb"><img src="${news.admin_image}" alt=""></figure>
                            <span class="category">${news.category}</span>
                            <h3><a href="${news.link}">${news.title}</a></h3>
                            <p>${news.description}</p>
                            <span class="post-info">By <a href="${news.link}">${news.author}</a> - ${news.date_published}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Fetch and display news items
    function fetchNews() {
        fetch('controller/userController.php?action=getNews')
            .then(response => response.json())
            .then(newsItems => {
                var newsContainer = document.getElementById('news-container');
                let html = '';
                newsItems.forEach(function(news, index) {
                    html += createNewsHTML(news, index);
                });
                newsContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching news:', error));
    }

    fetchNews();
});
