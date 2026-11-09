<?php

namespace BastienJcln\SalonCoifure\Controllers;

use BastienJcln\SalonCoifure\Core\Database;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BarberDashboardController extends BaseController
{
    public function dashboard(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'SELECT
                a.id,
                a.start_at,
                a.end_at,
                a.total_duration,
                a.total_price,
                a.status,
                c.first_name AS client_first_name,
                c.last_name AS client_last_name,
                c.phone AS client_phone
            FROM appointments a
            INNER JOIN users c ON c.id = a.client_id
            WHERE a.barber_id = :barber_id
            ORDER BY a.start_at ASC'
        );

        $stmt->execute([
            'barber_id' => $_SESSION['user']['id'],
        ]);

        $appointments = $stmt->fetchAll();

        return $this->view->render($response, 'barber/dashboard.php', [
            'title' => 'Espace coiffeur',
            'withMenu' => true,
            'barber' => $_SESSION['user'],
            'appointments' => $appointments,
        ]);
    }
}