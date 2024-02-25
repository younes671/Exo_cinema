<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>Cinéma</title>
</head>
<body>
    <div class="navbar navbar-expand-lg">
        <div class="container-fluid">
                    <a class="navbar-brand">
                        
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                    </button>
                            <div class="logo-box">
                                <i class="fa-solid fa-clapperboard"></i>
                                <p class="text-logo">CinéMax</p>
                            </div>
                            <div class="loupe">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div class="user">
                                <i class="fa-solid fa-user"></i>
                            </div>
                    </a>
                    <nav class="collapse navbar-collapse color-style" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=listFilms" class="nav-link">Films</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=listActeurs" class="nav-link">Liste Acteurs</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=listRealisateur" class="nav-link">Liste realisateur</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=listGenreFilm" class="nav-link">Genre film</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=listRole" class="nav-link">Role acteurs</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?action=modifyActeur" class="nav-link">Role acteurs</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

    <main>
    <?= $content ?>
    </main>
    <footer>
        <div class="footer">
            <div class="logo-box">
                <i class="fa-solid fa-clapperboard"></i>
                <p class="text-logo">CinéMax</p>
            </div>
        </div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'integrity='sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4'crossorigin='anonymous'></script>
    </footer>
</body>
</html>