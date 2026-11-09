<div class="container py-5">

    <div
        style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 24px;">
        <h1>Gestion des coiffeurs</h1>

        <div style="display: flex; flex-direction: row; gap: 10px; align-items: center;">
            <a href="/admin/barbers/create" class="btn btn-dark">
                + Ajouter un coiffeur
            </a>

            <a href="/admin" class="btn btn-outline-dark">
                Retour au tableau de bord
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Liste des coiffeurs</h5>

            <?php if (empty($barbers)): ?>

                <p class="text-muted">
                    Aucun coiffeur n'est enregistré pour le moment.
                </p>

            <?php else: ?>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">

                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date de création</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($barbers as $barber): ?>

                                <tr>
                                    <td>
                                        <?= escape($barber['first_name'] . ' ' . $barber['last_name']) ?>
                                    </td>

                                    <td>
                                        <?= escape($barber['email']) ?>
                                    </td>

                                    <td>
                                        <?= escape($barber['phone'] ?? '-') ?>
                                    </td>

                                    <td>
                                        <?= escape($barber['created_at']) ?>
                                    </td>

                                    <td>
                                        <?php if ((int) $barber['is_active'] === 1): ?>
                                            <span class="badge bg-success">Actif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/admin/barbers/<?= (int) $barber['id'] ?>/edit" class="btn btn-sm btn-dark">
                                            Modifier
                                        </a>

                                        <form action="/admin/barbers/<?= (int) $barber['id'] ?>/toggle-status" method="POST"
                                            style="display: inline;" onsubmit="return confirm('Confirmer cette action ?')">
                                            <?php if ((int) $barber['is_active'] === 1): ?>

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Désactiver
                                                </button>

                                            <?php else: ?>

                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Réactiver
                                                </button>

                                            <?php endif; ?>
                                        </form>
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