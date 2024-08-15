<div id="page-content-wrapper">
    <div class="header">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Select an option from the sidebar to manage the application.</p>
    </div>

    <div class="main-content">
        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="categoryDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="topAdsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="adsByCategoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- News Section -->
        <div class="news-container" id="news-container"></div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Get the element that will trigger the profile view
        const profileLink = document.getElementById('profile-link');
        const allUsers = document.getElementById('all-users');
        const allAds = document.getElementById('all-ads');
        const addEvents = document.getElementById('add-events');
        const messages = document.getElementById('messages');
        const sendMessage = document.getElementById('send-message');
        const inbox = document.getElementById('inbox');
        

        // Add a click event listener to the element
        profileLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=profile')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
                attachEventToProfile();
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        allUsers.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=allusers')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        allAds.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=allads')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        addEvents.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=events')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
                attachEventToAddEvents();
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        messages.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=messages')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        sendMessage.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=send_message')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
                attachEventToSendMessages();
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        inbox.addEventListener('click', function(event) {
            event.preventDefault();

            // Use the Fetch API to load the profile content
            fetch('index.php?action=inbox')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Parse the response as text
            })
            .then(data => {
                // Load the profile content into the main container
                document.querySelector('.main-content').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });

        function attachEventToProfile() {
            document.querySelectorAll('form').forEach(function(frm) {
                frm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    if (event.target.getAttribute('action') === 'update_profile')
                        formData.append('update_profile', '');

                    fetch('index.php?action=profile', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text(); // Parse the response as text
                    })
                    .then(data => {
                        // Load the profile content into the main container
                        document.querySelector('.main-content').innerHTML = data;
                        attachEventToProfile();
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
                });
            });
        }

        function attachEventToAddEvents() {
            document.querySelectorAll('form').forEach(function(frm) {
                frm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    if (event.target.getAttribute('action') === 'update_profile')
                        formData.append('update_profile', '');

                    fetch('index.php?action=events', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text(); // Parse the response as text
                    })
                    .then(data => {
                        // Load the profile content into the main container
                        document.querySelector('.main-content').innerHTML = data;
                        attachEventToAddEvents();
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
                });
            });
        }

        function attachEventToSendMessages() {
            document.querySelectorAll('form').forEach(function(frm) {
                frm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    if (event.target.getAttribute('action') === 'update_profile')
                        formData.append('update_profile', '');

                    fetch('index.php?action=send_message', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text(); // Parse the response as text
                    })
                    .then(data => {
                        // Load the profile content into the main container
                        document.querySelector('.main-content').innerHTML = data;
                        attachEventToSendMessages();
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
                });
            });
        }

        // Render charts
        function renderUserGrowthChart(data) {
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(entry => entry.date),
                    datasets: [{
                        label: 'New Users Over Time',
                        data: data.map(entry => entry.count),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: { beginAtZero: true },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        function renderCategoryDistributionChart(data) {
            const ctx = document.getElementById('categoryDistributionChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.map(entry => entry.category),
                    datasets: [{
                        label: 'Ads by Category',
                        data: data.map(entry => entry.count),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const data = tooltipItem.dataset.data;
                                    const total = data.reduce((acc, curr) => acc + curr, 0);
                                    const value = data[tooltipItem.dataIndex];
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return tooltipItem.label + ': ' + percentage + '%';
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderTopAdsChart(data) {
            const ctx = document.getElementById('topAdsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(entry => entry.title.length > 20 ? entry.title.slice(0, 20) + '...' : entry.title),
                    datasets: [{
                        label: 'Top Ads by Rating',
                        data: data.map(entry => entry.rating), // Changed from views to rating
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: { beginAtZero: true },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Example data
        const userGrowthData = <?php echo json_encode($dashboardData['userGrowth']); ?>;
        const categoryDistributionData = <?php echo json_encode($categoriesData); ?>;
        const topAdsData = <?php echo json_encode($dashboardData['topAds']); ?>;

        renderUserGrowthChart(userGrowthData);
        renderCategoryDistributionChart(categoryDistributionData);
        renderTopAdsChart(topAdsData);

        // News scrolling functionality
        function fetchNews() {
            return <?php echo json_encode($newsData); ?>;
        }

        function renderNews() {
            const newsContainer = document.getElementById('news-container');
            const newsItems = fetchNews();

            newsContainer.innerHTML = '';

            newsItems.forEach(item => {
            const newsItemDiv = document.createElement('div');
            newsItemDiv.className = 'news-item';
            newsItemDiv.textContent = item.title;
            newsContainer.appendChild(newsItemDiv);
        });

        // Implement scrolling functionality
        const newsItemsElements = newsContainer.querySelectorAll('.news-item');
        let offset = 0;

        function scrollNews() {
            offset -= 1;
            newsItemsElements.forEach(item => {
                item.style.transform = `translateY(${offset}px)`;
            });

            if (Math.abs(offset) >= newsContainer.scrollHeight) {
                offset = 0;
            }

            requestAnimationFrame(scrollNews);
        }

        scrollNews();
    }

    renderNews();
});
</script>
