<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="text-center mb-4">
                <h1 class="fw-bold">CFPT COIFFURE</h1>
                <p class="text-muted">Espace de connexion</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h4 mb-4">Se connecter</h2>

                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label"> Adresse e-mail </label>

                            <input type="email" class="form-control" id="email" name="email" autocomplete="username"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"> Mot de passe </label>

                            <input type="password" class="form-control" id="password" name="password"
                                autocomplete="current-password" required />
                        </div>
                        <button type="submit" class="btn btn-dark w-100">
                            Se connecter
                        </button>
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Vous n'avez pas encore de compte ?
                                <a href="/register" class="text-dark fw-bold">
                                    Créer un compte
                                </a>
                            </p>
                        </div>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= escape($error) ?></div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>