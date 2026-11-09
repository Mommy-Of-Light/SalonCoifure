<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- Nom du salon -->
        <a class="navbar-brand fw-bold" href="/">
            CFPT <span class="text-secondary">COIFFURE</span>
        </a>

        <!-- Bouton pour les petits écrans -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Ouvrir le menu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
            </ul>

            <ul class="navbar-nav">

                <?php if (isset($_SESSION['user'])): ?>

                    <li class="nav-item">
                        <span class="nav-link text-white">
                            Bonjour,
                            <?= escape($_SESSION['user']['first_name']) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/logout">
                            Déconnexion
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            Connexion
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>