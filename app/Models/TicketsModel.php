<?php

declare(strict_types=1);

namespace CodeShred\Models;

class TicketsModel extends \CodeShred\Core\BaseDbModel {

    /**
     * Método que obtiene todos los tickets de la bd.
     * 
     * @return bool Colección de tickets del sistema.
     */
    public function getTickets(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM tickets");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Método que crea un ticket con los datos pasados como parámetro.
     * 
     * @param array $data Colección de datos del ticket.
     * @return bool True si lo almacena, false si no.
     */
    public function createTicket(array $data): bool {
        $stmt = $this->pdo->prepare('INSERT INTO tickets(ticket_email, ticket_subject, ticket_message) VALUES(:ticket_email, :ticket_subject, :ticket_message)');

        return $stmt->execute(['ticket_email' => $data['email'], 'ticket_subject' => $data['subject'], 'ticket_message' => $data['message']]);
    }

    /**
     * Método que actualiza el estado de resuelto de un ticket del sistema.
     * 
     * @param int $ticketId Número identificativo del ticket.
     * @return bool True si lo actualiza, false si no.
     */
    public function resolveTicket(int $ticketId): bool {
        $stmt = $this->pdo->prepare('UPDATE tickets SET ticket_resolved = :ticket_resolved WHERE id_ticket = :id_ticket');

        return $stmt->execute(['ticket_resolved' => true, 'id_ticket' => $ticketId]);
    }

    /**
     * Método que elimina un ticket del sistema.
     * 
     * @param int $ticketId Número identificativo del ticket.
     * @return bool True si lo elimina, false si no.
     */
    public function deleteTicket(int $ticketId): bool {
        $stmt = $this->pdo->prepare('DELETE FROM tickets WHERE id_ticket = :id_ticket');

        return $stmt->execute(['id_ticket' => $ticketId]);
    }
}
