<div class="admin-dashboard">
    <div class="container py-5">

        <!-- En-tête -->
        <div class="mb-4">
            <a href="/admin" class="text-secondary text-decoration-none">
                ← Retour au tableau de bord
            </a>

            <div class="mt-4">
                <span class="dashboard-label">ADMINISTRATION</span>
                <h1 class="fw-bold mt-2">Gestion des clients</h1>
                <p class="text-secondary">
                    Consultez et recherchez les clients du salon.
                </p>
            </div>
        </div>

        <!-- Recherche -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <form method="GET" action="/admin/clients">
                    <div class="row g-3">

                        <div class="col-md-9">
                            <input type="search" name="search" class="form-control"
                                placeholder="Rechercher un nom, prénom ou e-mail..." value="<?= escape($search) ?>">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-dark w-100">
                                Rechercher
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <!-- Liste des clients -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    Liste des clients
                    <span class="badge bg-dark ms-2">
                        <?= count($clients) ?>
                    </span>
                </h5>
            </div>

            <div class="card-body p-0">

                <?php if (empty($clients)): ?>

                    <div class="text-center py-5">
                        <h5>Aucun client trouvé</h5>
                        <p class="text-secondary mb-0">
                            Aucun client ne correspond à votre recherche.
                        </p>
                    </div>

                <?php else: ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Nom</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Inscription</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($clients as $client): ?>

                                    <tr>
                                        <td class="ps-4 fw-semibold">
                                            <a href="/admin/clients/<?= (int) $client['id'] ?>" class="text-dark fw-bold">
                                                <?= escape($client['first_name'] . ' ' . $client['last_name']) ?>
                                            </a>
                                        </td>

                                        <td>
                                            <?= escape($client['email']) ?>
                                        </td>

                                        <td>
                                            <?= escape($client['phone'] ?? 'Non renseigné') ?>
                                        </td>

                                        <td>
                                            <?= date('d.m.Y', strtotime($client['created_at'])) ?>
                                        </td>

                                        <td>
                                            <?php if ((int) $client['is_active'] === 1): ?>
                                                <span class="badge bg-success">
                                                    Actif
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    Désactivé
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>