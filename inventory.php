<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Page</title>

    <style>
        /* General reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
}

/* Main container styles */
.container {
    width: 80%;
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1rem;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

/* Typography */
h2 {
    text-align: center;
    margin-bottom: 1rem;
    color: #333;
}

/* Table Styles */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 0.5rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #4CAF50;
    color: white;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Form Styles */
.form-control {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.select-wrapper {
    position: relative;
}

.select-wrapper::after {
    content: '▼';
    position: absolute;
    top: 0;
    right: 10px;
    pointer-events: none;
    color: #333;
    font-size: 16px;
    line-height: 38px;
}

select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2rem;
}

/* Button Styles */
.btn,
.form-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
    display: inline-block;
}

/* Specific styles for the submit button */
.submit-btn {
    background-color: #4CAF50; /* Green */
    color: white;
}

.submit-btn:hover {
    background-color: #45a049; /* Darker green */
}

/* Specific styles for the cancel button */
.cancel-btn {
    background-color: #f44336; /* Red */
    color: white;
}

.cancel-btn:hover {
    background-color: #d32f2f; /* Darker red */
}

.d-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 10px;
}

/* For medium screens and up, use flexbox to put buttons in a row */
@media (min-width: 768px) {
    .d-md-flex {
        display: flex;
        justify-content: flex-end;
    }
    
    .gap-2 {
        gap: 0.5rem; /* Adjust the gap between buttons */
    }
    
    .justify-content-md-end {
        justify-content: flex-end;
    }
}

    </style>

</head>
<body>
    <div class="container my-5">
        <h2></h2>
        <a href="admin_page.php" class="form-btn submit-btn"> Back to admin page </a>
        <a href="print_report.php" class="form-btn submit-btn"> Print Report </a>

        <br>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>CROP / SEED NAME</th>
                    <th>QUANTITY</th>
                    <th>DATE RECEIVED</th>
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

                    $sql = "SELECT * FROM distribute ORDER BY fname ASC";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>

                        <td>$row[fname]</td>
                        <td>$row[cropseed_n]</td>
                        <td>$row[quantity]</td>
                        <td>$row[date]</td>
                        <td>
                        <a class='form-btn submit-btn' href='/AgriConnectN/update_inventory.php?ID=$row[ID]'> Update </a>
                        </td>
                    </tr>
                        ";
                    }
                    
                    ?>

            </tbody>
        </table>
    </div>  
</body>
</html>

<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "faccount";
 
     $conn = new mysqli($servername, $username, $password, $dbname);

    $ID="";
    $fname="";
    $cropseed_n="";
    $quantity="";
    $date="";

    $errorMessage = "";
    $successMasage = "";

    // ... (previous code)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fname= $_POST["fname"];
    $cropseed_n= $_POST["cropseed_n"];
    $quantity= $_POST["quantity"];
    $date= $_POST["date"];

    // ... (rest of the POST data fetching)

    if ( empty($fname) || empty($cropseed_n) || empty($quantity) || empty($date))  {
        echo "ALL the fields are required";
    } else {

        $stmt = $conn->prepare("INSERT INTO distribute (fname, cropseed_n, quantity, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $cropseed_n, $quantity, $date);
    
        if ($stmt->execute()) {
            header('location:inventory.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    }

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to inventory</title>
</head>
<body>
    <div class="container my-5">
        <h2>Add to Inventory</h2>


        <form method="POST">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farmer Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="fname" required placeholder="Last, First, Initial" value="<?php echo $fname; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop/Seed Name</label>
                <div class="col-sm-6">
                <div class="select-wrapper">
                <select name="cropseed_n" class="form-control"  value="<?php echo $cropseed_n; ?>"><br>
                <option value=""> Select Crop Name </option>
                    <option value="Eggplant"> Eggplant (Talong) </option>
                    <option value="Bitter Gourd"> Bitter Gourd (Ampalaya) </option>
                    <option value="Okra"> Okra </option>
                    <option value="Rice"> Rice (Bigas) </option>
                    <option value="Corn"> Corn (Mais)</option>
                    <option value="String Beans"> String Beans (Sitaw) </option>
                    <option value="Squash"> Squash (Kalabasa)</option>
                    <option value="Sweet Potato"> Sweet Potato (Kamote) </option>
                    <option value="Tomato"> Tomato </option>
                    <option value="Peppers"> Peppers (Sili) </option>
                    <option value="Cabbage"> Cabbage (Repolyo) </option>
                    <option value="Onion"> Onion (Sibuyas) </option>
                    <option value="Garlic">Garlic (bawang) </option>
                    <option value="Grapes"> Grapes (Ubas) </option>
                    <option value="Banana"> Banana (Saging)</option>
                    <option value="Papaya"> Papaya </option>
                    <option value="Strawberry"> Strawberry </option>
                    <option value="Melon"> Melon </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="quantity" required placeholder="ex. 100" value="<?php echo $quantity; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Process</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="date" required value="<?php echo $date; ?>">
                </div> 
            </div>
            <div class="row mb-3">
    <div class="col-sm-6 offset-sm-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <input type="submit" name="submit" value="Submit" class="form-btn submit-btn">
        <a class="form-btn cancel-btn" href="/AgriConnectN/inventory.php" role="button">Cancel</a>
    </div>
</div>
            </div>
        </form>
    </div>

</body>
</html>

