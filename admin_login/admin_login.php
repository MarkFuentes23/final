<?php
session_start();
include '../config/db_connect.php';  // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Check if remember me is set

    // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, role, profile_pic FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);  // Check both username and email
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Ensure we check against 'password_hash'
    if ($user && password_verify($password, $user['password_hash'])) {
        // Regenerate session to prevent session fixation
        session_regenerate_id(true);

        // Start a new session and set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = htmlspecialchars($user['username']); // Sanitize for session use
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];  // Add user_id to session for profile access
        $_SESSION['profile_pic'] = $user['profile_pic'] ?? '/assets/img/default_profile.png';  // Ensure the profile picture is set

        // Set secure cookie attributes if remember me is checked
        if ($remember) {
            setcookie("username", $username, time() + (86400 * 30), "/", "", false, true); // 30 days expiration, httponly
        } else {
            // Clear the cookie if remember me is not checked
            setcookie("username", "", time() - 3600, "/");
        }

        // Redirect user based on role
        if ($user['role'] == 'admin') {
            header("Location: /index.php");  // Admin can access everything
            exit();
        } elseif ($user['role'] == 'manager') {
            header("Location: /sub-modules/logistic1/dashboard.php");  // Redirect to Logistic 1 Dashboard
            exit();
        } elseif ($user['role'] == 'driver') {
            header("Location: /sub-modules/logistic1/vehicle-reservation/driver-only.php");  // Redirect to Logistic 2 Dashboard
            exit();
        } elseif ($user['role'] == 'user') {
            header("Location: /sub-modules/logistic1/vehicle-reservation/user-only.php");  // Only allow access to track.php
            exit();
        } else {
            header("Location: /index.php");  // Default redirection for other users
            exit();
        }
    } else {
        $error = "Invalid username or password";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var toastHTML = '<div class=\"toast show align-items-center text-bg-danger\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" style=\"position: fixed; top: 20px; right: 20px; z-index: 1050;\">' +
                                    '<div class=\"d-flex\">' +
                                    '<div class=\"toast-body\">$error</div>' +
                                    '<button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>' +
                                    '</div>' +
                                    '</div>';
                    document.body.insertAdjacentHTML('beforeend', toastHTML);
                    var toastElement = document.querySelector('.toast');
                    var toast = new bootstrap.Toast(toastElement);
                    toast.show();
                });
              </script>"; // Display error toast if login fails
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/admin_css/login.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="card">
        <!-- Display Logo -->
             <div class="title-box">
                <img src="/assets/img/paradise_logo.png" alt="Paradise Logo" class="logo">
                <h3 class="text-center">PARADISE HOTEL</h3>
            </div>
            <form action="/admin_login/admin_login.php" method="POST">

                  <hr>
            <!-- Email input with icon -->
            <div class="mb-3 input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="text" class="form-control" name="username" placeholder="Username or Email" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
            </div>

            <!-- Password input with key and eye icon -->
            <div class="mb-3 input-group password-container">
                <span class="input-group-text">
                    <i class="fas fa-key"></i>
                </span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <span class="toggle-password" id="togglePassword" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i> <!-- Eye icon stays in place -->
                </span>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember" <?php if(isset($_COOKIE['username'])) echo "checked"; ?>>
                <label class="form-check-label" for="rememberCheck">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>

        <div class="mt-2 text-center">
            <a href="/admin_login/admin_reset_pass.php">Forgot Password?</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var icon = document.getElementById('togglePassword').querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
