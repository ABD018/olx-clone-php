document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'controller/userController.php?action=getNews', true);
    xhr.onload = function() {
        if (this.status === 200) {
            var newsItems = JSON.parse(this.responseText);
            var adsContainer = document.querySelector('.blog-grid-content .row.clearfix');

            newsItems.forEach(function(item, index) {
                var imagePath = `${item.image}`;
                var authorImagePath = `${item.admin_image}`;
                
                var adBlock = document.createElement('div');
                adBlock.className = 'col-lg-6 col-md-6 col-sm-12 news-block';

                adBlock.innerHTML = `
                    <div class="news-block-one wow fadeInDown animated" data-wow-delay="${index * 200}ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="${imagePath}" alt="${item.title}" onerror="this.onerror=null; this.src='assets/images/resource/default.jpg';">
                                <a href="${item.link}"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <figure class="admin-thumb"><img src="${authorImagePath}" alt="${item.author}" onerror="this.onerror=null; this.src='assets/images/resource/default-author.png';"></figure>
                                <span class="category">${item.category}</span>
                                <h3><a href="${item.link}">${item.title}</a></h3>
                                <p>${item.description}</p>
                                <span class="post-info">By <a href="${item.link}">${item.author}</a> - ${new Date(item.date_published).toDateString()}</span>
                            </div>
                        </div>
                    </div>
                `;

                adsContainer.appendChild(adBlock);
            });
        } else {
            console.error('Failed to load news:', this.status, this.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request error:', this.status, this.statusText);
    };
    xhr.send();
});
