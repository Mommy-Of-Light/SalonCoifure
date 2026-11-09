<div class="container py-5">

    <div class="mb-4">
        <a href="/admin/clients" class="text-dark text-decoration-none">
            ← Retour à la liste des clients
        </a>
    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white p-3">
            <h4 class="mb-0">Détails du client</h4>
        </div>

        <div class="card-body p-4">

            <div class="mb-4">
                <h5 class="text-muted">Informations personnelles</h5>
                <hr>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Identifiant :</div>
                <div class="col-md-8">
                    <?= escape($client['id']) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Prénom :</div>
                <div class="col-md-8">
                    <?= escape($client['first_name']) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nom :</div>
                <div class="col-md-8">
                    <?= escape($client['last_name']) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">E-mail :</div>
                <div class="col-md-8">
                    <?= escape($client['email']) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Téléphone :</div>
                <div class="col-md-8">
                    <?= escape($client['phone'] ?? 'Non renseigné') ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Date d'inscription :</div>
                <div class="col-md-8">
                    <?= date('d.m.Y', strtotime($client['created_at'])) ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Statut :</div>
                <div class="col-md-8">
                    <?php if ((int) $client['is_active'] === 1): ?>
                        <span class="badge bg-success">Actif</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Inactif</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-4">

                <a href="/admin/clients/<?= (int) $client['id'] ?>/edit" class="btn btn-dark">
                    Modifier le client
                </a>

                <form action="/admin/clients/<?= (int) $client['id'] ?>/toggle-status" method="POST" class="d-inline"
                    onsubmit="return confirm('Confirmer cette action ?')">
                    <?php if ((int) $client['is_active'] === 1): ?>

                        <button type="submit" class="btn btn-danger">
                            Désactiver le compte
                        </button>

                    <?php else: ?>

                        <button type="submit" class="btn btn-success">
                            Réactiver le compte
                        </button>

                    <?php endif; ?>
                </form>

            </div>
        </div>
    </div>

</div>