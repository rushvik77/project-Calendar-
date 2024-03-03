const yearlyCalendar = document.getElementById("yearlyCalendar");
const viewSelect = document.getElementById("view");
const notesContainer = document.getElementById("notes");
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth() + 1;
renderCalendar();
// current date 
function highlightCurrentDate() {
  // Get the current date
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1;
  var day = currentDate.getDate();

  // Construct the date key
  var dateKey = year + "-" + month + "-" + day;

  // Find the element corresponding to the current date
  var currentDateElement = document.querySelector(`.tit[data-date="${dateKey}"]`);

  // Remove any existing highlight from other dates
  var highlightedDates = document.querySelectorAll('.current-date');
  highlightedDates.forEach(date => {
      date.classList.remove('current-date');
  });

  // Apply highlight to the current date element
  if (currentDateElement) {
      currentDateElement.classList.add('current-date');
  }
}





function showNext() {
  const selectedView = viewSelect.value;
  switch (selectedView) {
    case "year":
      currentYear++;
      break;
    case "month":
      currentMonth++;
      if (currentMonth > 12) {
        currentMonth = 1;
        currentYear++;
      }
      break;
    case "week":
      updateWeekView(1);
      break;
    case "day":
      updateDayView(1);
      break;
    default:
      break;
  }

  renderCalendar();
  handleOptionChange();
}
function showPreview() {
  const selectedView = viewSelect.value;

  switch (selectedView) {
    case "year":
      currentYear--;
      break;
    case "month":
      currentMonth--;
      if (currentMonth < 1) {
        currentMonth = 12;
        currentYear--;
      }
      break;
    case "week":
      updateWeekView(-1);
      break;
    case "day":
      updateDayView(-1);
      break;
    default:
      break;
  }

  renderCalendar();
  handleOptionChange();
}
function handleOptionChange() {
  renderCalendar();
  const days = document.getElementById("days");
  const month = document.getElementById("month");
  var cssFile = "";
  if (viewSelect.value === "year") {
    cssFile = "caldeepak.css";
  }
  document.getElementById("custom-css").setAttribute("href", cssFile);
}

function renderCalendar() {
  let html = "";
  const selectedView = viewSelect.value;

  switch (selectedView) {
    case "year":
      html = renderYearView(currentYear);
      break;
    case "month":
      html = renderMonthView(currentYear, currentMonth);
      break;
    case "week":
      html = updateWeekView(0);
      break;
    case "day":
      html = updateDayView(0);
      break;
    default:
      break;
  }

  yearlyCalendar.innerHTML = html;
}

function renderYearView(year) {
  let html = "";
  for (let month = 0; month < 12; month++) {
    html += renderMonthView(year, month + 1);
  }
  return html;
}

function renderMonthView(year, month) {
  const daysInMonth = new Date(year, month, 0).getDate();
  const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
    month: "long",
  });
  // console.log(month)
  let html = `<div class="month" id="month">
                    <div class="month-name">${monthName} ${year}</div>
                    <div class="days" id="days">`;

  // Add day labels
  const dayLabels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  for (let i = 0; i < 7; i++) {
    html += `<div class="day label">${dayLabels[i]}</div>`;
  }

  // Add empty cells for days before the first day of the month
  const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
  for (let i = 0; i < firstDayOfMonth; i++) {
    html += '<div class="day empty"></div>'; // Add class "empty" to represent empty days
  }

  // Add cells for each day in the month
  for (let day = 1; day <= daysInMonth; day++) {
    const dateKey = `${year}-${month}-${day}`;
    const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
    const note = storedNotes[dateKey] || ""; // Get the note for this day
    html += `<div class="day tit ${
      note ? "green " : ""
    }" data-date="${dateKey}" onclick="addNotePrompt('${dateKey}')" >${day}<br><span class=" ${
      note ? "tooltiptext" : "d-none"
    }">${note}</span></div>`;
  }

  // Add empty cells for days after the last day of the month to complete the grid
  const lastDayOfMonth = new Date(year, month, 0).getDay();
  for (let i = lastDayOfMonth + 1; i < 7; i++) {
    html += '<div class="day empty"></div>'; // Add class "empty" to represent empty days
  }

  html += `</div>
              </div>`; // Close month div
              
  return html;
  
}

// function generateWeekView() {
//   console.log("genetate week function is called");
//   // Define hours
//   var hours = [
//     "",
//     "1 AM",
//     "2 AM",
//     "3 AM",
//     "4 AM",
//     "5 AM",
//     "6 AM",
//     "7 AM",
//     "8 AM",
//     "9 AM",
//     "10 AM",
//     "11 AM",
//     "12 PM",
//     "1 PM",
//     "2 PM",
//     "3 PM",
//     "4 PM",
//     "5 PM",
//     "6 PM",
//     "7 PM",
//     "8 PM",
//     "9 PM",
//     "10 PM",
//     "11 PM",
//     "12 AM",
//   ];

//   // Define days
//   var days = [
//     "Sunday",
//     "Monday",
//     "Tuesday",
//     "Wednesday",
//     "Thursday",
//     "Friday",
//     "Saturday",
//   ];

//   // Get the current date
//   var currentDate = new Date();
//   var currentDay = currentDate.getDay(); // 0 for Sunday, 1 for Monday, ..., 6 for Saturday

//   var html = "<table id='calendar'>";
//   html += "<thead>";
//   html += "<tr>";
//   html += "<th class='time-column'></th>";
//   days.forEach(function (day) {
//     html += "<th>" + day + "</th>";
//   });
//   html += "</tr>";
//   html += "</thead>";
//   html += "<tbody>";

//   // Create rows
//   hours.forEach(function (hour, index) {
//     html += "<tr>";
//     html += "<td class='time-column'>" + hour + "</td>";
//     days.forEach(function (day, dayIndex) {
//       html += "<td>";
//       if (index === 0) {
//         var diff = dayIndex - currentDay;
//         var date = new Date(currentDate);
//         date.setDate(currentDate.getDate() + diff);
//         html += date.getDate();
//       }
//       html += "</td>";
//     });
//     html += "</tr>";
//   });

//   html += "</tbody>";
//   html += "</table>";

//   return html;
// }

// Example usage:

// var weekViewHtml = generateWeekView();
// document.getElementById('container').innerHTML = weekViewHtml;// Assuming there's a container element where you want to display the generated HTML

// Global variable to keep track of the current week offset


// ======== Week Function is called ===========
var currentWeekOffset = 0;

// Function to generate week view with a given offset
function generateWeekView(weekOffset) {
  // Define hours
  var hours = [
    "",
    "1 AM",
    "2 AM",
    "3 AM",
    "4 AM",
    "5 AM",
    "6 AM",
    "7 AM",
    "8 AM",
    "9 AM",
    "10 AM",
    "11 AM",
    "12 PM",
    "1 PM",
    "2 PM",
    "3 PM",
    "4 PM",
    "5 PM",
    "6 PM",
    "7 PM",
    "8 PM",
    "9 PM",
    "10 PM",
    "11 PM",
    "12 AM",
  ];

  // Define days
  var days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];

  // Get the current date
  var currentDate = new Date();
  currentDate.setDate(currentDate.getDate() + weekOffset * 7); // Adjust date based on week offset

  var html = "<table id='calendar'>";
  html += "<thead>";
  html += "<tr>";
  html += "<th class='time-column'></th>";
  days.forEach(function (day) {
    html += "<th>" + day + "</th>";
  });
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  // Create rows
  hours.forEach(function (hour, index) {
    html += "<tr>";
    html += "<td class='time-column'>" + hour + "</td>";
    days.forEach(function (day, dayIndex) {
      html += "<td>";
      if (index === 0) {
        var diff = dayIndex - currentDate.getDay();
        var date = new Date(currentDate);
        date.setDate(currentDate.getDate() + diff);
        html += date.getDate();
      }
      html += "</td>";
    });
    html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";

  return html;
}

// Function to update week view
function updateWeekView(offset) {
  currentWeekOffset += offset;
  var weekViewHtml = generateWeekView(currentWeekOffset);
  // document.getElementById('calendarContainer').innerHTML = weekViewHtml;
  return weekViewHtml;
}

// Function to update day view
function updateDayView(offset) {
  var dayViewHtml = generateDayView(offset);
  // document.getElementById("container").innerHTML = dayViewHtml;
  return dayViewHtml;
}


// Event listeners for next and previous buttons
// document.getElementById("nextButton").addEventListener("click", function () {
//   updateWeekView(1); // Show next week
// });

// document.getElementById("prevButton").addEventListener("click", function () {
//   updateWeekView(-1); // Show previous week
// });

// Initial generation of week view
// updateWeekView(0); // Show current week

// =============== Day ================

function generateDayView(dayOffset) {
  // Define hours
  var hours = [
      '12 AM', '1 AM', '2 AM', '3 AM', '4 AM',
      '5 AM', '6 AM', '7 AM', '8 AM', '9 AM', '10 AM', '11 AM',
      '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',
      '6 PM', '7 PM', '8 PM', '9 PM', '10 PM', '11 PM'
  ];

  // // Get the current date
  // var currentDate = new Date();
  // currentDate.setDate(currentDate.getDate() + dayOffset);

  // // Format date
  // var options = { weekday: 'long', month: 'long', day: 'numeric' };
  // var formattedDate = currentDate.toLocaleDateString('en-US', options);

  // // Format day
  // var day = currentDate.toLocaleDateString('en-US', { weekday: 'long' });

  var options = { weekday: 'long', month: 'long', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);

    // Format day
    var day = currentDate.toLocaleDateString('en-US', { weekday: 'long' });

    document.getElementById('currentDate').innerHTML = formattedDate + ' (' + day + ')';

  var html = '<table id="dayCalendar">';
  html += '<thead>';
  html += '<tr>';
  // Current date
  html += '<th class="time-column" id="currentDate">' + formattedDate + ' (' + day + ')' + '</th>';
  html += '<th colspan="4">Today</th>'; // Adjust the colspan according to the number of time slots
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';

  // Create rows for each hour
  hours.forEach(function(hour) {
      html += '<tr>';
      html += "<td class='time-column'>" + hour + '</td>';
      html += "<td colspan='4'></td>"; // Adjust the colspan according to the number of time slots
      html += '</tr>';
  });

  // Close the table structure
  html += '</tbody>';
  html += '</table>';

  return html;
}




// Event listeners for next and previous buttons
// document.getElementById("nextButton").addEventListener("click", function () {
//   updateDayView(1); // Show next day
// });

// document.getElementById("prevButton").addEventListener("click", function () {
//   updateDayView(-1); // Show previous day
// });

// // Initial generation of day view
// updateDayView(0); // Show current day
