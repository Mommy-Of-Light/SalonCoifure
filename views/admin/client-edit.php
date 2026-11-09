<div class="container py-5">

    <div class="mb-4">
        <a href="/admin/clients/<?= (int)$client['id'] ?>"
           class="text-dark text-decoration-none">
            ← Retour aux détails du client
        </a>
    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white p-3">
            <h4 class="mb-0">Modifier un client</h4>
        </div>

        <div class="card-body p-4">

            <p class="text-muted">
                Modifiez les informations personnelles du client.
            </p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= escape($error) ?>
                </div>
            <?php endif; ?>

            <form
                action="/admin/clients/<?= (int)$client['id'] ?>/edit"
                method="POST"
            >

                <div class="mb-3">
                    <label for="first_name" class="form-label">
                        Prénom *
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="first_name"
                        name="first_name"
                        value="<?= escape($client['first_name']) ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">
                        Nom *
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="last_name"
                        name="last_name"
                        value="<?= escape($client['last_name']) ?>"
                        required
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
                        value="<?= escape($client['email']) ?>"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Téléphone
                    </label>

                    <input
                        type="tel"
                        class="form-control"
                        id="phone"
                        name="phone"
                        value="<?= escape($client['phone'] ?? '') ?>"
                    >
                </div>

                <button type="submit" class="btn btn-dark">
                    Enregistrer les modifications
                </button>

                <a
                    href="/admin/clients/<?= (int)$client['id'] ?>"
                    class="btn btn-outline-secondary ms-2"
                >
                    Annuler
                </a>

            </form>

        </div>
    </div>

</div>