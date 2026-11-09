<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifier un coiffeur</h1>

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

            <form action="/admin/barbers/<?= (int) $barber['id'] ?>/edit" method="POST">

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        value="<?= escape($barber['first_name']) ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        value="<?= escape($barber['last_name']) ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input
                        type="tel"
                        name="phone"
                        class="form-control"
                        value="<?= escape($barber['phone'] ?? '') ?>"
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Adresse e-mail</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= escape($barber['email']) ?>"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-dark">
                    Enregistrer les modifications
                </button>

                <a href="/admin/barbers" class="btn btn-outline-secondary">
                    Annuler
                </a>

            </form>

        </div>
    </div>

</div>  