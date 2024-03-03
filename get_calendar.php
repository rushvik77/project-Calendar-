<?php
function renderCalendar($year, $month) {
    $firstDayOfMonth = new DateTime("$year-$month-01");
    $daysInMonth = $firstDayOfMonth->format('t');
    $lastDayOfMonth = new DateTime("$year-$month-$daysInMonth");
    $firstDayOfWeek = $firstDayOfMonth->format('N');

    $monthNames = [
        1 => "January", 2 => "February", 3 => "March", 4 => "April",
        5 => "May", 6 => "June", 7 => "July", 8 => "August",
        9 => "September", 10 => "October", 11 => "November", 12 => "December"
    ];

    $calendarHTML = "
        <div class='calendar-header'>
            <button onclick='previousMonth()'>Previous</button>
            <div>{$monthNames[$month]} $year</div>
            <button onclick='nextMonth()'>Next</button>
        </div>
        <table class='calendar-table'>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <tr>";

    $day = 1;
    $nextMonthDay = 1;
    for ($i = 0; $i < 6; $i++) {
        $calendarHTML .= "<tr>";
        for ($j = 0; $j < 7; $j++) {
            if (($i === 0 && $j < $firstDayOfWeek) || $day > $daysInMonth) {
                $calendarHTML .= "<td class='disabled'></td>";
            } else {
                // Check if the date is today
                if ($year == date('Y') && $month == date('m') && $day == date('j')) {
                    $calendarHTML .= "<td class='current-date'>$day</td>";
                } else {
                    $calendarHTML .= "<td>$day</td>";
                }
                $day++;
            }
        }
        $calendarHTML .= "</tr>";
    }
    
    $calendarHTML .= "
        </tr>
        </table>
    ";

    echo $calendarHTML;
}

// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('n');

// Render the calendar for the current month and year
renderCalendar($currentYear, $currentMonth);
?>
