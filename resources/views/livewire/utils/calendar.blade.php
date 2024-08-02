<!-- resources/views/components/calendar-component.blade.php -->

<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <button id="prevBtn" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Previous</button>
            <button id="nextBtn" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Next</button>
            <button id="todayBtn" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Today</button>
        </div>
        <div>
            <span id="currentDate" class="text-lg font-semibold"></span>
        </div>
    </div>
    <div id="calendar" style="height: 400px; width: 70vw;"></div>

    <script data-navigate-track>
        document.addEventListener('DOMContentLoaded', () => {
            const calendarOptions = {};
            const calendar = window.initCalendar('#calendar', calendarOptions, JSON.parse(
                @json($events)));

            const updateCurrentDate = () => {
                const viewName = calendar.getViewName();
                const options = {
                    year: 'numeric',
                    month: 'long'
                };
                const date = calendar.getDate();
                const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
                document.getElementById('currentDate').textContent =
                    `${viewName.charAt(0).toUpperCase() + viewName.slice(1)}: ${formattedDate}`;
            };

            updateCurrentDate();

            // Navigation buttons event listeners
            document.getElementById('prevBtn').addEventListener('click', () => {
                calendar.prev();
                updateCurrentDate();
            });

            document.getElementById('nextBtn').addEventListener('click', () => {
                calendar.next();
                updateCurrentDate();
            });

            document.getElementById('todayBtn').addEventListener('click', () => {
                calendar.today();
                updateCurrentDate();
            });
        });
    </script>
</div>
