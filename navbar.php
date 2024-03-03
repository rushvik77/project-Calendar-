<?php
    include 'CreateEventdb.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Calendar </title>
  <!-- Bootstrap Link  -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CraeteEventStyle.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- calendar Link -->
  <!-- <link rel="stylesheet" href="caldeepak.css"> -->
  <link id="custom-css" rel="stylesheet" type="text/css" href="caldeepak.css">
  <script src="calendar.js"></script>
  <style>
    .year {
      /* margin-top: 75px; */
      margin-top: 61px;
      margin-left: 8px;
      width: 98%;
      box-shadow: black 2px 3px 33px;
    }

    /* .day:hover {
      background-color: #2b78e3ee;
      color: #fff;
    } */
    .tooltiptext {
    visibility: hidden;
    width: 100px;
    background-color: #2b78e3ee;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: 110%; /* Position the tooltip below the day element */
    left: 50%;
    transform: translateX(-50%);
  }

  /* Show tooltip on hover */
  .day:hover .tooltiptext {
    visibility: visible;
  }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top "
    style="background:linear-gradient(to bottom, #5f2c84 23%, #4b2958 95% );">
    <a class="navbar-brand" href="#">Calendar </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <sp an class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <select id="view" class="select-dropdown" onchange="handleOptionChange(this)">
          <option value="year">Year</option>
          <option value="month">Month</option>
          <option value="week">Week</option>
          <option value="day">Day</option>
        </select>
        <button class="tagb" onclick="showPreview()"><</button>
              <select id="months" class="month_sel">
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

        <button class="tagb" onclick="showNext()">></button>
      </ul>
    </div>




    <div class="profile-container">
      <img class="profile-image" src="user.png" alt="Profile Picture" width="42px" height="42px">
      <div class="profile-dropdown">
        <a href="text.php">Edit Profile</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
      </div>
    </div>

  </nav>

  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">Menubar</div>
      <i class='bx bx-calendar-alt' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-hive'></i>
          <span class="links_name">Group Calendar</span>
        </a>
        <span class="tooltip">Group Calendar</span>
      </li>
      <li>
        <a href="#" data-toggle="modal" data-target="#createEventModal">
          <i class='bx bx-edit-alt'></i>
          <span class="links_name">Create Events </span>
        </a>
        <span class="tooltip">Create Events</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name"> Events Analytics</span>
        </a>
        <span class="tooltip">Events Analytics</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-bell'></i>
          <span class="links_name">Notification</span>
        </a>
        <span class="tooltip">Notification</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="calendar-container" id="calendarContainer">
      <div class="year" id="yearlyCalendar"></div>

      <!-- Calendar content will be loaded here dynamically -->
    </div>

  </section>

  <script src="calenderrender.js"></script>
  <script>
    // generateDayView()
    function generateDayView() {
      var html = '<table id="dayCalendar">';
      html += '<thead>';
      html += '<tr>';
      // Current date
      var currentDate = new Date();
      var options = { weekday: 'long', day: 'numeric' };
      html += '<th class="time-column" id="currentDate">' + currentDate.toLocaleDateString('en-US', options) + '</th>';
      html += '<th colspan="4">Today</th>'; // Adjust the colspan according to the number of time slots
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      // Define hours
      var hours = [
        '1 AM', '2 AM', '3 AM', '4 AM',
        '5 AM', '6 AM', '7 AM', '8 AM',
        '9 AM', '10 AM', '11 AM', '12 PM',
        '1 PM', '2 PM', '3 PM', '4 PM',
        '5 PM', '6 PM', '7 PM', '8 PM',
        '9 PM', '10 PM', '11 PM', '12 AM'
      ];

      // Create rows for each hour
      hours.forEach(function (hour) {
        html += '<tr>';
        html += "<td class='time-column'>" + hour + "</td>";
        html += "<td colspan='4'></td>"; // Adjust the colspan according to the number of time slots
        html += '</tr>';
      });

      // Close the table structure
      html += '</tbody>';
      html += '</table>';

      // Return the generated HTML
      return html;
    }

  </script>
  <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
        </div>
        <div class="modal-body">


             <!-- icons -->
            <!-- <svg xmlns="http://www.w3.org/2000/svg" id="tag" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/>
                <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" id="tag1" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
              </svg>
          
              <svg xmlns="http://www.w3.org/2000/svg" id="tag2" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" id="tag3" fill="currentColor" class="bi bi-hourglass-top" viewBox="0 0 16 16">
                <path d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z"/>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" id="tag4" fill="currentColor" class="bi bi-hourglass-bottom" viewBox="0 0 16 16">
                <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z"/>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" id="tag5" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" id="tag6" fill="currentColor" class="bi bi-crosshair" viewBox="0 0 16 16">
                <path d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
              </svg> -->
            <form action="" method="POST" class="signup-form" id="form1">
                <div class="container">
                    <div class="input-field">
                       
                        <input type="text" name="title" required>
                         <label><i class="bi bi-tag"></i>Title</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="description" required>
                        <label><i class="bi bi-pencil-square"></i>Description</label>
                    </div>
                    <div class="input-field">
                        <input type="date" name="date" required>
                        <label> <i class="bi bi-calendar3"></i></label>
                    </div>
                    <div class="input-field">

                        
                        <input type="time" name="start_time"required>
                        <label><i class=" timefont"></i>Start-Time</label>
                    </div>
                    <div class="input-field">

                   
                        <input type="time" name="end_time"required>
                        <label><i class="bi bi-hourglass-bottom"></i>End-Time</label>
                    </div>
                    <div class="input-field">

                        <input type="text" name="members" required autocomplete="off"/>
                        <label><i class="bi bi-people"></i>Add Guests</label>
                        
                    </div>
                    <div class="input-field">

                        <input type="text" name="location" required autocomplete="off"/>    
                        <label><i class="bi bi-crosshair"></i>Location</label>
                         
                    </div>
                </div>
                
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" id="add" name="add" >Add</button>
          <button type="button" class="btn btn-secondary" id="update" data-dismiss="modal">Update</button>
          <button type="button" class="btn btn-primary" id="delete">Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script src="script.js"></script>

  <script src="sidebar.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>