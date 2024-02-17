<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add custom styles here */
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Register</h4>
          </div>
          <div class="card-body">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" required>
                <div class="error-message text-danger" id="name-error"></div>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" required>
                <div class="error-message text-danger" id="email-error"></div>
              </div>
              <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" required>
                <div class="error-message text-danger" id="address-error"></div>
              </div>
              <div class="form-group">
                <label for="contact">Contact No:</label>
                <input type="tel" class="form-control" id="contact" required>
                <div class="error-message text-danger" id="contact-error"></div>
              </div>
              <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" required>
                <div class="error-message text-danger" id="dob-error"></div>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" required>
                <div class="error-message text-danger" id="password-error"></div>
              </div>
              <button type="submit" class="btn btn-primary btn-block" onclick="registration();">Register</button>
            <hr>
            <div class="text-center mt-3">
              <p>Already have an account? <a href="login.php">Go to Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>