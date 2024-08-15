<?php
include 'sidebar.php';
require_once '../admin/models/AdminModel.php';
$adminModel = new AdminModel();

// Fetch data
$dashboardData = $adminModel->getDashboardStats();
$newsData = $adminModel->getNews();
$categoriesData = $adminModel->getCategories();
$eventsData = $adminModel->getEvents(); // Fetch events for calendar

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .calendar-container {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 250px;
            height: 250px;
            z-index: 1000;
        }

        .todo-container {
            position: fixed;
            top: 280px;
            right: 20px;
            width: 250px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
        }

        .todo-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            position: relative;
        }

        .todo-list input[type="checkbox"] {
            margin-right: 10px;
        }

        .todo-list .delete-btn {
            display: none;
            position: absolute;
            right: 0;
            background-color: #e57373;
            border: none;
            color: #fff;
            padding: 5px;
            border-radius: 4px;
            cursor: pointer;
        }

        .todo-list li.completed .delete-btn {
            display: inline;
        }

        .news-container {
    overflow: hidden;
    position: relative;
    height: 400px;
    width: 100%;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.news-item {
    width: 100%;
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    /* Adjust animation settings if necessary */
}


        @keyframes newsFlow {
            0% { transform: translateY(100%); }
            100% { transform: translateY(-100%); }
        }

        .chart-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }

        @media (max-width: 768px) {
            .calendar-container,
            .todo-container {
                width: 200px;
                height: auto;
                top: 20px;
            }

            .todo-container {
                top: 240px;
            }
        }
    </style>
</head>
<body>
    <div id="page-content-wrapper">
        <nav class="navbar">
            <button class="btn"><a href="index.php?action=dashboard">Home</a></button>
        </nav>

        <div class="container-fluid">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Select an option from the sidebar to manage the application.</p>
            
            <!-- Calendar Section -->
            <div class="calendar-container">
                <div id="calendar"></div>
            </div>

            <!-- To-Do List Section -->
            <div class="todo-container">
                <h5 class="card-title">To-Do List</h5>
                <ul class="todo-list">
                    <!-- Example tasks -->
                    <li>
                        <input type="checkbox" id="task1">
                        <span class="task-text">Task 1</span>
                        <button class="delete-btn" onclick="deleteTask(this)">Delete</button>
                    </li>
                    <li>
                        <input type="checkbox" id="task2">
                        <span class="task-text">Task 2</span>
                        <button class="delete-btn" onclick="deleteTask(this)">Delete</button>
                    </li>
                    <!-- Additional tasks can be added dynamically here -->
                </ul>
            </div>

            <!-- Key Metrics Section -->
            <div class="row">
                <!-- Key metrics content... -->
            </div>

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
            <div class="news-container" id="news-container">
                <!-- News items will be injected here by JavaScript -->
            </div>
        </div>
    </div>

    <!-- JavaScript to render charts, calendar, and add interactivity -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Calendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($eventsData); ?>, // Inject events data
            editable: true,
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
                // Implement additional functionality if needed
            }
        });
        calendar.render();

        // To-Do List functionality
        function deleteTask(button) {
            const taskItem = button.parentElement;
            taskItem.remove();
        }

        document.querySelectorAll('.todo-list input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const taskItem = this.parentElement;
                if (this.checked) {
                    taskItem.classList.add('completed');
                    taskItem.querySelector('.task-text').style.textDecoration = 'line-through';
                } else {
                    taskItem.classList.remove('completed');
                    taskItem.querySelector('.task-text').style.textDecoration = 'none';
                }
            });
        });

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
</body>
</html>
