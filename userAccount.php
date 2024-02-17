<?php

session_start();

require_once("MySQL.php");
if (isset($_SESSION["userId"])){
    ?>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pharmacy Web Application</title>
            <style>
                
            </style>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <a class="navbar-brand" href="#">Your Logo</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="userAccount.php">My Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">My Account</h1>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                    <table id="drugTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Drug Names</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $userId = $_SESSION["userId"];
                    $quary = "SELECT drug.name, drug.qty, drug.price, quotation.prescription_id FROM user INNER JOIN prescription ON user.id = prescription.user_id INNER JOIN quotation ON prescription.id = quotation.prescription_id INNER JOIN drug ON quotation.id = drug.quotation_id WHERE user.id = '$userId'";
    
                    $result = MySQL::search($quary);

                    if($result && $result->num_rows > 0){
                        $names = "";
                        $price = 0;
                        $qty = 0;
                        $prescriptionId;
                        while($row = mysqli_fetch_array($result)){
                            $names .= $row["name"].", ";
                            $price += $row["price"];
                            $qty += $row["qty"];
                            $prescriptionId = $row['prescription_id'];
                        }
                        echo "<tr>";
                                echo "<td>" . $names . "</td>";
                                echo "<td>" . $qty . "</td>";
                                echo "<td>" . $price . "</td>";
                                echo "<td>";
                                    echo "<button onclick=\"userQuotationUpdate('1', '$prescriptionId')\">Accept</button>";
                                    echo "<button onclick=\"userQuotationUpdate('2', '$prescriptionId')\">Reject</button>";
                                echo "</td>";
                        echo "</tr>";
                    }

                    ?>
                     <tbody>
                     </tbody>
                </table>
                    </div>
                </div>
            </div>
            <script src="script.js"></script>
        </body>
        </html>
    <?php
}

?>