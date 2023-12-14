<!DOCTYPE html>
<html lang="en">

<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $farmer_n="";
    $age="";
    $sex="";
    $farm_n="";
    $area="";
    $barangay="";
    $fcontact="";
    $crop_name="";
    $crop_status="";
    $last_update="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:admin_page.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM farmer_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:admin_page.php');
            exit;
        }

        $farmer_n= $row["farmer_n"];
        $age= $row["age"];
        $sex= $row["sex"];
        $farm_n= $row["farm_n"];
        $area= $row["area"];
        $barangay= $row["barangay"];
        $fcontact= $row["fcontact"];
        $crop_name= $row["crop_name"];
        $crop_status= $row["crop_status"];
        $last_update= $row["last_update"];
    }
    else {

        $ID = $_POST["ID"];
        $farmer_n= $_POST["farmer_n"];
        $age= $_POST["age"];
        $sex= $_POST["sex"];
        $farm_n= $_POST["farm_n"];
        $area= $_POST["area"];
        $barangay= $_POST["barangay"];
        $fcontact= $_POST["fcontact"];
        $crop_name= $_POST["crop_name"];
        $crop_status= $_POST["crop_status"];
        $last_update= $_POST["last_update"];

        do {
            if ( empty($ID) || empty($farmer_n) || empty($age) || empty($sex) || empty($farm_n) || empty($area) || empty($barangay) || empty($fcontact) || empty($crop_name) || empty($crop_status) || empty($last_update)){
                $errorMessage = "ALL the fields are required";
                break;
            }

            $sql = "UPDATE farmer_acc " . 
            "SET farmer_n = '$farmer_n', age = '$age', sex = '$sex', farm_n = '$farm_n', area = '$area', barangay = '$barangay', fcontact = '$fcontact', crop_name = '$crop_name', crop_status = '$crop_status', last_update = '$last_update'" . 
            "WHERE ID = $ID";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'invalid query' . $conn->error;
                break;
            }
            header('location:admin_page.php');
            exit;


        } while (true);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Farmer</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: auto;
    padding: 2rem;
    background-color: #E5FDE6;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 1rem;
}

.form-control, .form-select {
    width:100%;
    padding: 10px;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.form-btn {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.btn-submit {
    background-color: #007bff;
}

.btn-cancel {
    background-color: #6c757d;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

.row {
    display: block;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.col-label {
    flex: 0 0 100%;
    width: 25%;
    text-align: left;
    padding-right: 10px;
    align-self: center;
}

.col-input {
    flex: 0 0 100%;
}

@media screen and (max-width: 576px) {
    .col-label, .col-input {
        width: 100%;
        text-align: left;
    }
    .col-label {
        margin-bottom: 0.5rem;
    }
}
    .btn-submit {
        width: 30%;
        padding: 11px;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 16px; /* Adjust font size as needed */
        cursor: pointer;
        text-decoration: none; /* Remove underline for Cancel link */
        display: inline-block; /* Adjust display */
        text-align: center;
        transition: background-color 0.2s ease-in-out;
        }

    .btn-cancel {
        width: 30%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 15px; /* Adjust font size as needed */
        cursor: pointer;
        text-decoration: none; /* Remove underline for Cancel link */
        display: inline-block; /* Adjust display */
        text-align: center;
        transition: background-color 0.2s ease-in-out;
        }

        .btn-submit {
            background-color: #28a745; /* Green color for Submit button */
            
        }

.btn-cancel {
            background-color: #d9534f; /* Darker shade for Cancel button */
}

    .btn-submit:hover {
    background-color: #218838; /* Darker shade for hover effect */
}

.btn-submit,
.btn-cancel {
    margin-left: 10px; /* Add space between buttons */
}

.btn-cancel:hover {
    background-color: #BE4643; /* Darker shade for hover effect */
}

        /* Additional styles for the button wrapper */
.button-wrapper {
    display: flex;
    justify-content: center; /* Align buttons to the center */
    margin-top: 20px; /* Add some space on top of the buttons */
}
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Update Farmer</h2>


        <form method="POST">
        <div class="row mb-3">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <label class="col-sm-3 col-form-label">Farmer Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farmer_n" required placeholder="Last, First, Initial" value="<?php echo $farmer_n; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="age" required placeholder="ex. 20" value="<?php echo $age; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">sex</label>
                <div class="col-sm-6">
                <select name="sex" class="form-control" required value="<?php echo $sex; ?>"><br>
                    <option value="male"> male </option>
                    <option value="female"> female </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_n" required placeholder="ex. Green Hills" value="<?php echo $farm_n; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Area (hectars)</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="area" required placeholder="ex. 500" value="<?php echo $area; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay</label>
                <div class="col-sm-6">
                <select name="barangay" class="form-control"  required value="<?php echo $barangay; ?>"><br>
                    <option value="Agusipan"> Agusipan </option>
                    <option value="Agutayan"> Agutayan </option>
                    <option value="Bagumbayan"> Bagumbayan </option>
                    <option value="Balabag"> Balabag </option>
                    <option value="Ban-ag"> Ban-ag </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="fcontact" required  value="<?php echo $fcontact; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Name</label>
                <div class="col-sm-6">
                <select name="crop_name" class="form-control"  value="<?php echo $crop_name; ?>"><br>
                <option value=""> select crop name </option>
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
                <label class="col-sm-3 col-form-label">Crop Status</label>
                <div class="col-sm-6">
                <select name="crop_status" class="form-control"  value="<?php echo $crop_status; ?>"><br>
                    <option value="seedling"> seedling </option>
                    <option value="sprouting"> sprouting </option>
                    <option value="ripening"> ripening </option>
                    <option value="harvesting"> harvesting </option>
                    <option value="withered"> withered </option>
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
            <div class="offset-sm-3 col-sm-6 d-grid">
            <div class="button-wrapper">
    <input type="submit" name="submit" value="Submit" class="btn btn-submit">
    <a class="btn btn-cancel" href="/AgriConnectN/admin_page.php" role="button">Cancel</a>
    </div>
    </div>

</body>
</html>
