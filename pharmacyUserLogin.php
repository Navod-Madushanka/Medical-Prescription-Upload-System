<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
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
            <h4>Admin Login</h4>
          </div>
          <div class="card-body">
              <div class="form-group">
              <div class="error-message text-danger" id="login-error"></div>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" required>
                <div class="error-message text-danger" id="email-error"></div>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" required>
                <div class="error-message text-danger" id="password-error"></div>
              </div>
              <button type="submit" class="btn btn-primary btn-block" onclick="login('pharmacyLogin_process.php', 'prescriptions.php');">Login</button>
            <hr>
            <div class="text-center">
              <a href="#" class="btn btn-link">Forgot Password?</a>
            </div>
            <div class="text-center mt-3">
              <p>Don't have an account? <a href="registration.php">Register Here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>