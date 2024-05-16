<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include '../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Tsany Aurellia Az Zahra</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        
    </style>
</head>
<body id="dashboard-body">
    <div id="body">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2596be;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="d-flex flex-column align-items-center justify-content-center">
            <img src="../assets/2.jpg" alt="" class="" style="width:500px;">
            <h1 class="text-center mt-3 header-text">Welcome!</h1>
            <p class="text-center user-name"><?php echo htmlspecialchars($_SESSION['fullname']); ?></p>
            <p class="text-center user-email"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </main>
        <footer class="text-center mt-5">
            <p>© 2024 Tsany Aurellia Az Zahra</p>
        </footer>
    </div>

</body>
</html>
