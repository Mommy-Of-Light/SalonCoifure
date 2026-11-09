<div class="admin-dashboard">

    <div class="container py-5">

        <!-- En-tête -->
        <div class="dashboard-header mb-5">
            <div>
                <span class="dashboard-label">ESPACE DE GESTION</span>
                <h1>Administration</h1>
                <p>
                    Bienvenue, <?= escape($firstName) ?>.
                    Gérez l'ensemble de votre salon depuis cet espace.
                </p>
            </div>

            <div class="dashboard-date">
                <span>CFPT COIFFURE</span>
                <small>Genève · Suisse</small>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row g-3 mb-5">

            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <span class="stat-icon">♙</span>
                    <div>
                        <span class="stat-label">Gestion</span>
                        <h3>Clients</h3>
                        <p>Comptes et informations clients</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <span class="stat-icon">✂</span>
                    <div>
                        <span class="stat-label">Équipe</span>
                        <h3>Coiffeurs</h3>
                        <p>Les membres de votre équipe</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stat-card">
                    <span class="stat-icon">◷</span>
                    <div>
                        <span class="stat-label">Organisation</span>
                        <h3>Horaires</h3>
                        <p>Ouvertures et fermetures</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Rubriques -->
        <div class="section-heading">
            <div>
                <span class="dashboard-label">GESTION DU SALON</span>
                <h2>Vos espaces de travail</h2>
            </div>
        </div>

        <div class="row g-4">

            <!-- Clients -->
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/admin/clients" class="admin-card">
                    <div class="admin-card-icon">♙</div>
                    <div class="admin-card-content">
                        <h3>Clients</h3>
                        <p>Consulter, rechercher et gérer les comptes clients.</p>
                    </div>
                    <span class="card-arrow">→</span>
                </a>
            </div>

            <!-- Coiffeurs -->
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/admin/barbers" class="admin-card">
                    <div class="admin-card-icon">✂</div>
                    <div class="admin-card-content">
                        <h3>Coiffeurs</h3>
                        <p>Gérer les comptes et les informations des six coiffeurs.</p>
                    </div>
                    <span class="card-arrow">→</span>
                </a>
            </div>

            <!-- Prestations -->
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/admin/services" class="admin-card">
                    <div class="admin-card-icon">◇</div>
                    <div class="admin-card-content">
                        <h3>Prestations</h3>
                        <p>Modifier les services, les durées et les tarifs.</p>
                    </div>
                    <span class="card-arrow">→</span>
                </a>
            </div>

            <!-- Rendez-vous -->
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/admin/appointments" class="admin-card">
                    <div class="admin-card-icon">▦</div>
                    <div class="admin-card-content">
                        <h3>Rendez-vous</h3>
                        <p>Consulter et gérer les réservations du salon.</p>
                    </div>
                    <span class="card-arrow">→</span>
                </a>
            </div>

            <!-- Horaires -->
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/admin/schedule" class="admin-card">
                    <div class="admin-card-icon">◷</div>
                    <div class="admin-card-content">
                        <h3>Horaires et absences</h3>
                        <p>Gérer les horaires, les congés et les fermetures.</p>
                    </div>
                    <span class="card-arrow">→</span>
                </a>
            </div>

        </div>

        <!-- Pied de page -->
        <div class="dashboard-footer">
            <span>CFPT COIFFURE</span>
            <span>Espace d'administration</span>
        </div>

    </div>
</div>