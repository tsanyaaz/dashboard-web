<?php
include '../includes/config.php';
include '../includes/validate.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!validateFullName($fullname)) {
        $errors[] = "Nama Lengkap tidak valid.";
    }
    if (!validateEmail($email)) {
        $errors[] = "Email tidak valid.";
    }
    if (!validatePassword($password)) {
        $errors[] = "Password tidak valid.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Konfirmasi Password tidak sama.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $hashed_password);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Gagal menyimpan data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login-container">
        <div class="box-area">
            <h2 class="text-center">Register</h2>
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
                    <input type="text" name="fullname" class="form-control form-control-lg bg-light fs-6" placeholder="Full Name" required>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="confirm_password" class="form-control form-control-lg bg-light fs-6" placeholder="Re-Password" required>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-dark btn-lg">Register</button>
                </div>
                <div class="mt-3 text-center">
                    <a href="index.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
