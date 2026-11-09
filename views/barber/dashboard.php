<div class="container py-5">

    <div class="mb-4">
        <h1>Espace coiffeur</h1>

        <p class="text-muted">
            Bienvenue <?= escape($barber['first_name'] . ' ' . $barber['last_name']) ?> !
            Voici votre espace personnel CFPT COIFFURE.
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-4">Mes rendez-vous</h5>

            <?php if (empty($appointments)): ?>

                <p class="text-muted">
                    Vous n'avez aucun rendez-vous pour le moment.
                </p>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-striped align-middle">

                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Téléphone</th>
                                <th>Date et heure</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th>Statut</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($appointments as $appointment): ?>

                                <tr>

                                    <td>
                                        <?= escape(
                                            $appointment['client_first_name'] . ' ' .
                                            $appointment['client_last_name']
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= escape($appointment['client_phone'] ?? '-') ?>
                                    </td>

                                    <td>
                                        <?= date('d.m.Y H:i', strtotime($appointment['start_at'])) ?>
                                    </td>

                                    <td>
                                        <?= (int) $appointment['total_duration'] ?> min
                                    </td>

                                    <td>
                                        <?= number_format((float) $appointment['total_price'], 2, '.', "'") ?> CHF
                                    </td>

                                    <td>
                                        <?= escape($appointment['status']) ?>
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