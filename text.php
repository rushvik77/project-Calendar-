<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar</title>
<style>
  .calendar {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  .calendar th,
  .calendar td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }

  .calendar th {
    background-color: #f2f2f2;
  }

  .prev-next {
    margin-top: 20px;
  }

  .current-day {
    background-color: #ffc;
  }

  .other-month {
    color: #ccc;
  }

  .disabled {
    color: #ccc;
    pointer-events: none;
  }
</style>
</head>
<body>
<div>
  <label for="month">Select Month:</label>
  <select id="month">
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select>
</div>
<table id="calendar" class="calendar">
  <thead>
    <tr>
      <th colspan="7">
        <span id="currentMonth"></span>
        <span class="prev-next">
          <button id="previousMonth">Previous</button>
          <button id="nextMonth">Next</button>
        </span>
      </th>
    </tr>
    <tr>
      <th>Sun</th>
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
    </tr>
  </thead>
  <tbody id="calendarBody">
  </tbody>
</table>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let today = new Date();
    let currentMonth = today.getMonth() + 1;
    let currentYear = today.getFullYear();
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

    const calendarBody = document.getElementById('calendarBody');
    const currentMonthSpan = document.getElementById('currentMonth');
    const monthSelect = document.getElementById('month');

    function generateCalendar(year, month) {
      let startDate = new Date(year, month - 1, 1);
      let endDate = new Date(year, month, 0);
      let calendarHTML = '';

      while (startDate.getDay() !== 0) {
        startDate.setDate(startDate.getDate() - 1);
      }

      while (startDate <= endDate) {
        calendarHTML += '<tr>';
        for (let i = 0; i < 7; i++) {
          let day = startDate.getDate();
          let className = startDate.getMonth() + 1 === month ? '' : 'other-month';
          className += (startDate.toDateString() === today.toDateString()) ? ' current-day' : '';
          className += (startDate.getMonth() + 1 !== month || startDate.getFullYear() < currentYear ||
                         (startDate.getMonth() + 1 === month && startDate.getDate() < today.getDate() && startDate.getFullYear() === currentYear)) ? ' disabled' : '';
          calendarHTML += '<td class="' + className + '">' + day + '</td>';
          startDate.setDate(startDate.getDate() + 1);
        }
        calendarHTML += '</tr>';
      }

      calendarBody.innerHTML = calendarHTML;
      currentMonthSpan.textContent = `${monthNames[month - 1]} ${year}`;
    }

    function previousMonth() {
      currentMonth -= 1;
      if (currentMonth < 1) {
        currentMonth = 12;
        currentYear -= 1;
      }
      generateCalendar(currentYear, currentMonth);
    }

    function nextMonth() {
      currentMonth += 1;
      if (currentMonth > 12) {
        currentMonth = 1;
        currentYear += 1;
      }
      generateCalendar(currentYear, currentMonth);
    }

    function goToMonth() {
      currentMonth = parseInt(monthSelect.value);
      generateCalendar(currentYear, currentMonth);
    }

    generateCalendar(currentYear, currentMonth);

    // Attach event listeners to previous and next buttons
    document.getElementById('previousMonth').addEventListener('click', previousMonth);
    document.getElementById('nextMonth').addEventListener('click', nextMonth);
    monthSelect.addEventListener('change', goToMonth);
  });
</script>
</body>
</html>
