<?php
// Check if the 'view' parameter is set
if (isset($_GET['view'])) {
    $view = $_GET['view'];
    
    // Generate calendar content based on the view parameter
    switch ($view) {
        case 'Day':
            generateDayView();
            break;
        case 'Week':
            generateWeekView();
            break;
        case 'Month':
            renderMonthView(currentYear, currentMonth);
            break;
        default:

    }
} else {
    echo "View parameter is missing.";
}





















generateDayView();
// Function to generate day view content
function generateDayView() {
    // Start the table structure
    $html = '<table id="dayCalendar">';
    $html .= '<thead>';
    $html .= '<tr>';
    // Current date
    $html .= '<th class="time-column" id="currentDate">' . date('l, jS') . '</th>';
    $html .= '<th colspan="4">Today</th>'; // Adjust the colspan according to the number of time slots
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    // Define hours
    $hours = [
        '1 AM', '2 AM', '3 AM', '4 AM',
        '5 AM', '6 AM', '7 AM', '8 AM',
        '9 AM', '10 AM','11 AM','12 PM',
        '1 PM','2 PM','3 PM','4 PM',
        '5 PM','6 PM','7 PM','8 PM',
        '9 PM','10 PM','11 PM','12 AM'
    ];

    // Create rows for each hour
    foreach ($hours as $hour) {
        $html .= '<tr>';
        $html .= "<td class='time-column'>$hour</td>";
        $html .= "<td colspan='4'></td>"; // Adjust the colspan according to the number of time slots
        $html .= '</tr>';
    }

    // Close the table structure
    $html .= '</tbody>';
    $html .= '</table>';

    // Return the generated HTML
    echo $html;
}

// Function to generate week view content
function generateWeekView() {
    // Define hours
    $hours = ['', '1 AM', '2 AM', '3 AM', '4 AM', '5 AM', '6 AM', '7 AM', '8 AM', '9 AM', '10 AM','11 AM','12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM','8 PM','9 PM','10 PM','11 PM','12 AM'];
    
    
    // Define days
    $days = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    
    // Get the current date
    $currentDay = date('w'); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday
    
    echo "<table id='calendar'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='time-column'></th>";
    foreach ($days as $day) {
        echo "<th>$day</th>";
    }
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Create rows
    foreach ($hours as $index => $hour) {
        echo "<tr>";
        echo "<td class='time-column'>$hour</td>";
        foreach ($days as $dayIndex => $day) {
            echo "<td>";
            if ($index === 0) {
                $diff = $dayIndex - $currentDay;
                $date = date('j', strtotime("$diff days"));
                echo $date;
            }
            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}


// Function to generate month view content
// function generateMonthView() {
//     // Function to get month name
//     function getMonthName($monthIndex) {
//         $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
//         return $months[$monthIndex];
//     }

//     // Output the calendar HTML
//     echo "<style>";
//     echo ".calendar {";
//     echo "    border: 2px solid #ccc;";
//     echo "    margin: 70px;";
//     echo "    width: 96%;";
//     echo "    position: relative; /* Change to relative positioning */";
//     echo "    box-shadow: 2px 3px 33px black; /* Adjust box-shadow property */";
//     echo "}";
//     echo ".weekdays {";
//     echo "    display: flex;";
//     echo "    background-color: #f0f0f0; /* Move background color here */";
//     echo "}";
//     echo ".weekday {";
//     echo "    flex: 1;";
//     echo "    text-align: center;";
//     echo "    padding: 10px; /* Adjust padding */";
//     echo "}";
//     echo ".dates {";
//     echo "    display: grid;";
//     echo "    grid-template-columns: repeat(7, 1fr);";
//     echo "    gap: 1px;";
//     echo "}";
//     echo ".date {";
//     echo "    text-align: center;";
//     echo "    padding: 20px 0;";
//     echo "    border: 1px solid #ccc;";
//     echo "}";
//     echo ".disabled {";
//     echo "    color: #ccc;";
//     echo "}";
//     echo ".today {";
//     echo "    background: linear-gradient(to bottom, #5ba6c4 23%, #7b5bdb 95%);";
//     echo "    color: #000; /* Black text color for today's date */";
//     echo "}";
//     echo "</style>";

//     // Output the calendar HTML
//     echo "<section class='home-section'>";
//     echo "<div class='calendar-container' id='calendarContainer'>";
//     echo "<div class='calendar'>";
//     echo "<div class='weekdays'>";
//     echo "<div class='weekday'>Sun</div>";
//     echo "<div class='weekday'>Mon</div>";
//     echo "<div class='weekday'>Tue</div>";
//     echo "<div class='weekday'>Wed</div>";
//     echo "<div class='weekday'>Thu</div>";
//     echo "<div class='weekday'>Fri</div>";
//     echo "<div class='weekday'>Sat</div>";
//     echo "</div>";
//     echo "<div class='dates' id='dates'></div>";
//     echo "</div>";
//     echo "</div>";
//     echo "</section>";
    
//     // Include the JavaScript functionality
//     echo "<script>";
//     echo "document.addEventListener('DOMContentLoaded', function() {";
//     echo "const currentMonth = document.getElementById('currentMonth');";
//     echo "const datesContainer = document.getElementById('dates');";
//     echo "let currentDate = new Date();";
//     echo "let currentYear = currentDate.getFullYear();";
//     echo "let currentMonthIndex = currentDate.getMonth();";
//     echo "renderCalendar($currentYear, $currentMonthIndex);";
//     echo "function renderCalendar(year, month) {";
//     echo "currentMonth.textContent = getMonthName(month) + ' ' + year;";
//     echo "datesContainer.innerHTML = '';";
//     echo "const firstDayOfMonth = new Date(year, month, 1);";
//     echo "const lastDayOfMonth = new Date(year, month + 1, 0);";
//     echo "const startingDay = firstDayOfMonth.getDay();";
//     echo "const totalDays = lastDayOfMonth.getDate();";
//     echo "const totalSlots = startingDay + totalDays;";
//     echo "const prevMonthLastDay = new Date(year, month, 0).getDate();";
//     echo "for (let i = startingDay - 1; i >= 0; i--) {";
//     echo "const dateElement = document.createElement('div');";
//     echo "dateElement.classList.add('date', 'disabled');";
//     echo "dateElement.textContent = prevMonthLastDay - i;";
//     echo "datesContainer.appendChild(dateElement);";
//     echo "}";
//     echo "for (let i = 1; i <= totalDays; i++) {";
//     echo "const dateElement = document.createElement('div');";
//     echo "dateElement.classList.add('date');";
//     echo "dateElement.textContent = i;";
//     echo "if (year === currentYear && month === currentMonthIndex && i === currentDate.getDate()) {";
//     echo "dateElement.classList.add('today');"; // Highlight today's date
//     echo "}";
//     echo "datesContainer.appendChild(dateElement);";
//     echo "}";
//     echo "for (let i = 1; i < 42 - totalSlots; i++) {";
//     echo "const dateElement = document.createElement('div');";
//     echo "dateElement.classList.add('date', 'disabled');";
//     echo "dateElement.textContent = i;";
//     echo "datesContainer.appendChild(dateElement);";
//     echo "}";
//     echo "}";
//     echo "});";
//     echo "</scrip>";
// }








