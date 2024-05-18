<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class TicketsController extends \CodeShred\Core\BaseController {

    /**
     * Método que enseña la vista de tickets.
     * 
     * @return void
     */
    function showTickets(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de inicio de la página
        $data['title'] = 'codeShred - Admin | Tickets';
        $data['section'] = '/tickets';
        $data['css'] = 'tickets';

        // Obtenemos los tickets
        $model = new \CodeShred\Models\TicketsModel();
        $data['tickets'] = $model->getTickets();

        // Enseñamos la vista de tickets
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'admin/tickets.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa un me gusta de manera asíncrona.
     * 
     * @return void
     */
    public function resolveTicket(): void {
        if ($_SESSION['user']['user_rol'] == UsersController::ADMIN) {
            // Decodificamos los datos enviados en la petición
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            // Guardamos las variables
            $ticketId = intval($data['ticketId']);

            // Creamos el modelo
            $model = new \CodeShred\Models\TicketsModel();
            // Borramos el ticket
            $isDeleted = $model->resolveTicket($ticketId);

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isDeleted ? 'resolved' : 'not resolved';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "marcado como resuelto" : "intentado marcar como resuelto") . " al ticket con ID " . $ticketId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            echo json_encode(['success' => false, 'action' => 'Intento de hackeo']);
        }
    }

    /**
     * Método que procesa el borrado de un post de manera asíncrona.
     * 
     * @return void
     */
    public function deleteTicket(): void {
        if ($_SESSION['user']['user_rol'] == UsersController::ADMIN) {
            // Decodificamos los datos enviados en la petición
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            // Guardamos las variables
            $ticketId = intval($data['ticketId']);

            // Creamos el modelo
            $model = new \CodeShred\Models\TicketsModel();
            // Borramos el ticket
            $isDeleted = $model->deleteTicket($ticketId);

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al ticket con ID " . $ticketId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            // Enviamos el resultado al front
            echo json_encode(['success' => false, 'action' => 'Intento de hackeo']);
        }
    }
}
