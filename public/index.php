<?php
include '../includes/config.php';
include '../includes/validate.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!validateEmail($email)) {
        $errors[] = "Email tidak valid.";
    }
    if (!validatePassword($password)) {
        $errors[] = "Password tidak valid.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];

                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = "Password salah.";
            }
        } else {
            $errors[] = "Email tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login-container">
        <div class="box-area">
            <h2 class="text-center">Login</h2>
            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-dark btn-lg">Login</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
