<?php
if(isset($_GET['year']) && isset($_GET['month'])) {
    $year = $_GET['year'];
    $month = $_GET['month'];

    // Render calendar
    $calendarHTML = renderCalendar($year, $month);

    // Output the calendar HTML
    echo $calendarHTML;
}

// Define the renderCalendar function
function renderCalendar($year, $month) {
    $calendarHTML = '<div class="calendar">';
    $calendarHTML .= '<div class="month-navigation">';
    $calendarHTML .= '<a href="#" id="prevBtn"><i class="bx bx-caret-left text-dark icon"></i></a>';
    $calendarHTML .= '<span id="currentMonth">' . date('F Y', mktime(0, 0, 0, $month + 1, 1, $year)) . '</span>';
    $calendarHTML .= '<a href="#" id="nextBtn"><i class="bx bx-caret-right text-dark icon"></i></a>';
    $calendarHTML .= '</div>';

    $calendarHTML .= '<div class="weekdays">';
    $weekdays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    foreach ($weekdays as $weekday) {
        $calendarHTML .= '<div class="weekday">' . $weekday . '</div>';
    }
    $calendarHTML .= '</div>';

    $calendarHTML .= '<div class="dates">';
    $firstDayOfMonth = new DateTime("$year-$month-01");
    $startingDay = $firstDayOfMonth->format('w'); // Week day index (0 for Sunday)
    $totalDays = $firstDayOfMonth->format('t'); // Total days in month

    // Render dates from previous month
    $prevMonthLastDay = new DateTime("$year-$month-01");
    $prevMonthLastDay->modify('last day of previous month');
    for ($i = $startingDay - 1; $i >= 0; $i--) {
        $date = $prevMonthLastDay->format('d');
        $calendarHTML .= '<div class="date disabled">' . $date . '</div>';
        $prevMonthLastDay->modify('-1 day');
    }

    // Render dates for current month
    for ($i = 1; $i <= $totalDays; $i++) {
        $date = new DateTime("$year-$month-$i");
        $dayOfWeek = $date->format('w');
        $calendarHTML .= '<div class="date';
        if ($i === (int)date('d') && $month === (int)date('m') - 1) {
            $calendarHTML .= ' today';
        }
        $calendarHTML .= '">' . $i . '</div>';
    }

    // Render dates from next month
    $nextMonthFirstDay = new DateTime("$year-$month-01");
    $nextMonthFirstDay->modify('first day of next month');
    $remainingDays = 42 - ($startingDay + $totalDays);
    for ($i = 1; $i <= $remainingDays; $i++) {
        $date = $nextMonthFirstDay->format('d');
        $calendarHTML .= '<div class="date disabled">' . $date . '</div>';
        $nextMonthFirstDay->modify('+1 day');
    }

    $calendarHTML .= '</div>';
    $calendarHTML .= '</div>';

    // Output or return the calendar HTML
    return $calendarHTML;
}
?>
