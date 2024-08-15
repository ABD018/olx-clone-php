<div id="right-sidebar-wrapper">
    <!-- Calendar Section -->
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Calendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($eventsData); ?>, // Inject events data
            editable: true,
            height: 'calc(100vh - 20px)',
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
                // Implement additional functionality if needed
            }
        });
        calendar.render();
    });
</script>