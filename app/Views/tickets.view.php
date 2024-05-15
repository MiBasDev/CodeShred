<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="cs-fl-col cs-fl-just-c tickets-page-container">
        <h1>Tickets</h1>
        <div class="tickets-container cs-fl-col">
            <?php
            if (isset($tickets) && !empty($tickets)) {
                foreach ($tickets as $ticket) {
                    ?>
                    <div class="tickets-card cs-fl-col cs-fl-just-c" id="tickets-card-<?php echo $ticket['id_ticket']; ?>">
                        <h2 class="ticket-subject cs-fl cs-fl-just-c">
                            <span class="fas fa-ticket-alt ticket-icon"></span>
                            <span class="cs-fl cs-fl-just-c cs-fl-align-c"><?php echo $ticket['ticket_subject']; ?></span>
                        </h2>
                        <div class="ticket-buttons">
                            <button class="ticket-resolve <?php echo $ticket['ticket_resolved'] == 1 ? 'button-success' : 'button-secondary'; ?>" id="ticket-<?php echo $ticket['id_ticket']; ?>" title="<?php echo $ticket['ticket_resolved'] == 1 ? 'Ticket resuelto' : 'Ticket sin resolver'; ?>">
                                <span class="fas <?php echo $ticket['ticket_resolved'] == 0 ? 'fa-cog' : 'fa-check'; ?>"></span>
                            </button>
                            <button class="button-warning button-ticket-delete" onclick="openDeletePopup(<?php echo $ticket['id_ticket']; ?>)" title="Eliminar ticket">
                                <span class="fas fa-trash-alt"></span>
                            </button>
                        </div>
                        <p class="ticket-message cs-fl">                         
                            <?php echo "\"" . $ticket['ticket_message'] . "\""; ?>
                        </p>
                        <div class="ticket-email">
                            <span>by: </span><i><?php echo $ticket['ticket_email']; ?></i>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class = "cs-fl-col">No hemos encontrado ningún ticket.</div>
                <?php
            }
            ?>
        </div>
    </div>
    <div id="popup-delete-ticket" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2>¿Seguro que quieres eliminar este ticket?</h2>
            </div>
            <div class="cs-fl-col">
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeletePopup()">Volver atrás</button>
                    <button type="submit" class="button-warning" id="popup-button-ticket-delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>