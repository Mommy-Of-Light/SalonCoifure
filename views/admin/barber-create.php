<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ajouter un coiffeur</h1>

        <a href="/admin/barbers" class="btn btn-outline-dark">
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-4">Informations du coiffeur</h5>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= escape($error) ?>
                </div>
            <?php endif; ?>

            <form action="/admin/barbers/create" method="POST">

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required minlength="12">
                    <small class="text-muted">
                        Minimum 12 caractères.
                    </small>
                </div>

                <button type="submit" class="btn btn-dark">
                    Créer le compte coiffeur
                </button>

            </form>

        </div>
    </div>

</div>