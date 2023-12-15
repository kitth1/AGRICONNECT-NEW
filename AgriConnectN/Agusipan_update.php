<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $crop_name="";
    $crop_status="";
    $last_update="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:Agusipan_page.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM farmer_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:Agusipan_page.php');
            exit;
        }
        $farm_n= $row["farm_n"];
        $crop_name= $row["crop_name"];
        $crop_status= $row["crop_status"];
        $last_update= $row["last_update"];
    }
    else {

        $ID = $_POST["ID"];
        $farm_n= $_POST["farm_n"];
        $crop_name= $_POST["crop_name"];
        $crop_status= $_POST["crop_status"];
        $last_update= $_POST["last_update"];

        do {
            if ( empty($ID) || empty($crop_name) || empty($crop_status) || empty($last_update)){
                $errorMessage = "ALL the fields are required";
                break;
            }

            $sql = "UPDATE farmer_acc " . 
            "SET crop_name = '$crop_name', crop_status = '$crop_status', last_update = '$last_update'" . 
            "WHERE ID = $ID";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'invalid query' . $conn->error;
                break;
            }
            header('location:Agusipan_page.php');
            exit;


        } while (true);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Farm</title>
    
    <style>
       /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    display: flex;
    justify-content: center;
    padding-top: 50px; /* Adjust the padding as needed */
}

.container {
    width: 100%; /* Allow the container to grow as needed */
    margin: auto;
    padding: 40px; /* Increase padding for more space inside the container */
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-control {
    width: 100%;
    padding: 15px; /* More padding for larger input fields */
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px; /* Larger font size for better readability */
}

.btn {
    padding: 10px 20px; /* More padding for larger buttons */
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-size: 16px; /* Larger font size for buttons */
    margin-right: 10px; /* Adjust spacing between buttons */
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
    border: none;
}

.btn-outline-primary {
    background-color: transparent;
    color: #4CAF50;
    border: 1px solid #4CAF50;
}

.btn:hover, .btn-outline-primary:hover {
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
        max-width: none; /* Allow the container to fill the screen */
    }
}
    </style>
</head>
<body>
<div class="container">
        <h2>Update FARM & FARMER</h2>
        <br>
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_n" placeholder="Farm Name" value="<?php echo htmlspecialchars($farm_n); ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="crop_name" placeholder="Crop Name" value="<?php echo htmlspecialchars($crop_name); ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Status</label>
                <div class="col-sm-6">
                <select name="crop_status" class="form-control">
                <option value="seedling" <?php echo $crop_status == 'seedling' ? 'selected' : ''; ?>>Seedling</option>
                <option value="sprouting" <?php echo $crop_status == 'sprouting' ? 'selected' : ''; ?>>Sprouting</option>
                <option value="ripening" <?php echo $crop_status == 'ripening' ? 'selected' : ''; ?>>Ripening</option>
                <option value="harvesting" <?php echo $crop_status == 'harvesting' ? 'selected' : ''; ?>>Harvesting</option>
                <option value="withered" <?php echo $crop_status == 'withered' ? 'selected' : ''; ?>>Withered</option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Latest Update</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="last_update" required placeholder="" value="<?php echo $last_update; ?>">
                </div> 
            </div>
            <div class="row mb-3">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-outline-primary" href="/AgriConnectN/Agusipan_page.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>