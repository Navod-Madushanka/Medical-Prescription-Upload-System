<?php
session_start();
if (isset($_SESSION["userId"]) ){
    ?>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pharmacy Web Application</title>
            <style>
                .prescription-img {
                    border-radius: 10px; /* Rounded borders for images */
                }
                .imageDiv{
                    height: 200px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                    border: 1px solid #ccc;
                }
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
                        <h1 class="mb-4">Upload Prescription</h1>
                    </div>
                </div>

                <div class="row justify-content-center align-content-center">
                    <div class="col-1 imageDiv" onclick="openImageChooser(1);"></div>
                    <div class="offset-1 col-1 imageDiv" onclick="openImageChooser(2);"></div>
                    <div class="offset-1 col-1 imageDiv" onclick="openImageChooser(3);"></div>
                    <div class="offset-1 col-1 imageDiv" onclick="openImageChooser(4);"></div>
                    <div class="offset-1 col-1 imageDiv" onclick="openImageChooser(5);"></div>

                    <!-- Invisible inputs -->
                    <input type="file" id="imageInput1" style="display: none;">
                    <input type="file" id="imageInput2" style="display: none;">
                    <input type="file" id="imageInput3" style="display: none;">
                    <input type="file" id="imageInput4" style="display: none;">
                    <input type="file" id="imageInput5" style="display: none;">
                </div>

                <!-- Upload details form -->
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" id="notes" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity:</label>
                            <input type="text" class="form-control" id="qty">
                        </div>
                        <div class="form-group">
                            <label for="deliveryAddress">Delivery Address:</label>
                            <input type="text" class="form-control" id="deliveryAddress">
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="uploadPrescription();">Submit</button>
                    </div>
                </div>
            </div>
            <script src="script.js"></script>
        </body>
        </html>
    <?php
}else{
    ?>
    <script>
        window.location = 'login.php';
    </script>
    <?php
}
?>
