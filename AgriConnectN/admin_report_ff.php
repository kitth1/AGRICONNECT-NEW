<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report Page</title>
    <style>
    /* General Style Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9f9f9;
    }

    /* Styles for the search bar container */
.search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff; /* White background for the search bar */
    padding: 8px 12px;
    border-radius: 20px; /* Rounded corners for the search bar */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* subtle shadow for depth */
    margin-bottom: 20px; /* Space below the search bar */
    width: 100%; /* Full width */
    max-width: 400px; /* Maximum width of the search bar */
}

/* Styles for the search input field */
#search-input {
    border: none;
    display: inline-block;
    padding: 10px 15px;
    outline: none;
    flex-grow: 1; /* Takes up available space */
    margin-right: 10px; /* Space between input and button */
    font-size: 16px; /* Font size */
}

/* Styles for the search button */
.search-bar button {
    display: inline-block;
    padding: 10px 15px;
    margin-right: px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #5cb85c; /* Bootstrap's btn-success color */
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

    .container {
        max-width: 90%;
        margin: 20px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #003300;
        text-align: center;
        margin-bottom: 20px;
    }

/* Additional styles for buttons */
.btn {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px; /* Adjust font size to your preference */
    padding: 10px 15px; /* Adjust padding to your preference */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    margin-left: 8px; /* Space between buttons */
    text-align: center; /* Center text inside buttons */
}

/* Additional hover effect for buttons */
.btn:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
    transform: translateY(-2px); /* Slightly raise the button on hover */
}

/* Specific styles for the cancel button */
.btn.cancel {
    background-color: #d9534f; /* Red background color */
    color: white; /* White text color */
}

/* Specific styles for the print button */
.btn.print {
    background-color: #5cb85c; /* Green background color */
    color: white; /* White text color */
}

/* Align buttons to the right */
.btn-container {
    text-align: left;
    margin-top: 20px; /* Space above the button container */
}

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #006400;
        color: white;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 95%;
        }

        .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
    }

/* Print-specific styles */
@media print {
    body, html {
        background: none;
        -webkit-print-color-adjust: exact; /* Ensures that background color and images are printed */
    }

    .container {
        box-shadow: none;
        margin: 0;
        width: auto;
        max-width: 100%;
    }

    .table th, .table td {
        border: 1px solid #000; /* Ensures the table borders are visible when printed */
    }

    .table th {
        background-color: #fff; /* Removes the background color */
        color: #000; /* Sets the text color to black */
    }

    .btn, .no-print, .search-bar{
        display: none; /* Hide elements that shouldn't be printed */
    }


@media (max-width: 768px) {
    .container {
        width: 95%;
        max-width: none;
    }
}
}
</style>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc"; 
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;      
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>


</head>
<body>
    <div class="container my-5">
        <h2>Admin Report</h2>
        <div class="btn-container">
        <a href="admin_page.php" class="btn cancel">Cancel</a>  
        <button class="btn print" onclick="window.print()">Print Report</button>
        <br><br>
        <table class="table border=1">
            
        <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search by farm or crop name...">
                <button type="submit" class="btn btn-search" onclick="searchTable()">Search</button>
            </div>
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>FARM NAME</th>
                    <th>AREA (hectars)</th>
                    <th>BARANGAY</th>
                    <th>CONTACT</th>
                    <th>CROP NAME</th>
                    <th>CROP STATUS</th>
                    <th>LATEST UPDATE</th>
             
                </tr>  
            </thead> 
            <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM farmer_acc ORDER BY barangay ASC";
                
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>

                        <td>$row[farmer_n]</td>
                        <td>$row[age]</td>
                        <td>$row[sex]</td>
                        <td>$row[farm_n]</td>
                        <td>$row[area]</td>
                        <td>$row[barangay]</td>
                        <td>$row[fcontact]</td>
                        <td>$row[crop_name]</td>
                        <td>$row[crop_status]</td>
                        <td>$row[last_update]</td>
                    
                    </tr>
                        ";
                    }
                    
                    ?>
                
            </tbody>
        </table>
    </div>

            <script>
       function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.querySelector(".table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
        var rowContainsFilter = false;

        // Check for Farmer Name (Column 0), Barangay (Column 5), and Crop Status (Column 8)
        for (var columnIndex of [0, 5, 8]) {
            td = tr[i].getElementsByTagName("td")[columnIndex];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rowContainsFilter = true;
                    break; // Stop checking other columns if a match is found
                }
            }
        }

        tr[i].style.display = rowContainsFilter ? "" : "none";
    }
}

    </script>
</body>
</html>
