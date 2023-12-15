<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Page</title>
    <style>
body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
}

.container {
    width: 100%; /* or max-width if you want to limit the width */
    max-width: 900px; /* Adjust the max-width as needed */
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px; /* Or adjust as needed for spacing from the top */
    padding: 1rem;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    overflow: hidden;
}


.table {
    width: 100%;
    max-width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.table th {
    background-color: #006400;
    color: white;
    padding: 10px;
    border: 1px solid #ddd;
}

.table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tr:hover {
    background-color: #ddd; /* Lighter grey background when hovered */
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    background-color: #5cb85c;
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.btn:hover {
    background-color: #449d44;
}

.btn-sm {
    padding: 5px 10px;
    font-size: 0.875rem;
}

/* Additional styling for logout and report buttons */
.btn-logout,
.btn-report {
    margin: 0.5rem 0;
    align-self: flex-start; /* Aligns the button to the start of the flex item line */
}

/* This will center the content and restrict the table's width */
.table-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Heading styles */
h2 {
    margin-top: 0;
    padding-top: 20px; /* Add some padding at the top of the header */
    text-align: center;
}

/* For the responsive design */
@media (max-width: 768px) {
    .table-container {
        width: 100%;
        overflow-x: auto; /* Enables horizontal scrolling for smaller devices */
    }
}
</style>
</head>
<body>
    <div class="container my-5">
        <h2>List of Farmers in AGUTAYAN</h2>
        <br>
        <a href="Agutayan_report.php" class="btn"> Create Report </a>
        <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>FARM NAME</th>
                    <th>BARANGAY</th>
                    <th>CONTACT</th>
                    <th>CROP NAME</th>
                    <th>CROP STATUS</th>
                    <th>LATEST UPDATE</th>
                    <th>ACTION</th>
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

                    // Only fetch records with barangay = 'Agusipan'
                    $sql = "SELECT * FROM farmer_acc WHERE barangay = 'Agutayan'";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['farmer_n']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['sex']}</td>
                            <td>{$row['farm_n']}</td>
                            <td>{$row['barangay']}</td>
                            <td>{$row['fcontact']}</td>
                            <td>{$row['crop_name']}</td>
                            <td>{$row['crop_status']}</td>
                            <td>{$row['last_update']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/AgriConnectN/Agutayan_update.php?ID={$row['ID']}'>Update</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a href="logout_form.php" class="btn logout">Logout</a>  
</body>
</html>
