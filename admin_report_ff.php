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

    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        background-color: #006400;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #008000;
    }

    .table {
        width: 100%;
        margin-top: 15px;
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

    /* Print Styles */
    @media print {
        .no-print {
            display: none;
        }
        body {
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
        .search-bar {
            display: none;
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
        <a href="admin_page.php" class="btn no-print">Cancel</a>  
        <button class="no-print" onclick="window.print()">Print Report</button>
        <br><br>
        <table class="table" border="1">
            
        <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search by farm or crop name...">
                <button onclick="searchTable()">Search</button>
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
