<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar</title>
<style>
/* Styles for the calendar */
.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.calendar-header button {
  background-color: #f0f0f0;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}

.calendar-table {
  border-collapse: collapse;
}

.calendar-table th,
.calendar-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}

.calendar-table th {
  background-color: #f0f0f0;
}

.disabled {
  color: #ccc;
  cursor: not-allowed;
}

.current-date {
  background-color: #ffff99;
}
</style>
</head>
<body>

<div id="calendar">
<?php
include 'calendar_views.php';

// Get the current year and month
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('n');

// Render the calendar for the current month and year
renderCalendar($currentYear, $currentMonth);
?>
</div>

<!-- View selection dropdown -->
<label for="view_select">Select View:</label>
<select id="view_select" onchange="changeView()">
    <option value="month">Month View</option>
    <option value="week">Week View</option>
    <option value="day">Day View</option>
</select>

<script>
function nextMonth(year, month) {
    if (month == 12) {
        window.location.href = '?year=' + (parseInt(year) + 1) + '&month=1';
    } else {
        window.location.href = '?year=' + year + '&month=' + (parseInt(month) + 1);
    }
}

function previousMonth(year, month) {
    if (month == 1) {
        window.location.href = '?year=' + (parseInt(year) - 1) + '&month=12';
    } else {
        window.location.href = '?year=' + year + '&month=' + (parseInt(month) - 1);
    }
}

function changeView() {
    var selectedView = document.getElementById("view_select").value;
    window.location.href = '?year=<?php echo $currentYear; ?>&month=<?php echo $currentMonth; ?>&view=' + selectedView;
}
</script>

</body>
</html>
