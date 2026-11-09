<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">CFPT COIFFURE</h2>
                        <p class="text-muted">Créer un compte client</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <?= escape($error) ?>
                        </div>
                    <?php endif; ?>

                    <form action="/register" method="POST">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">
                                    Prénom *
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="first_name"
                                    name="first_name"
                                    value="<?= escape($old['first_name'] ?? '') ?>"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">
                                    Nom *
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="last_name"
                                    name="last_name"
                                    value="<?= escape($old['last_name'] ?? '') ?>"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                Téléphone
                            </label>
                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                value="<?= escape($old['phone'] ?? '') ?>"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Adresse e-mail *
                            </label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="<?= escape($old['email'] ?? '') ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Mot de passe *
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                minlength="12"
                                required
                            >
                            <div class="form-text">
                                12 caractères minimum.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label">
                                Confirmer le mot de passe *
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="password_confirm"
                                name="password_confirm"
                                minlength="12"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-2">
                            Créer mon compte
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0">
                            Déjà un compte ?
                            <a href="/login" class="text-dark fw-bold">
                                Se connecter
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>