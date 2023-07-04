<?php
function sendWithAttachments($to, $subject, $htmlMessage)
{
    $maxTotalAttachments = 2097152; 
    $boundary_text = "anyRandomStringOfCharactersThatIsUnlikelyToAppearInEmail";
    $boundary = "--" . $boundary_text . "\r\n";
    $boundary_last = "--" . $boundary_text . "--\r\n";

    $emailAttachments = "";
    $totalAttachmentSize = 0;
    echo print_r($_FILES);
    foreach ($_FILES as $file) {        
        if ($file['error'] == 0 && $file['size'] > 0) {
            $fileContents = file_get_contents($file['tmp_name']);
            $totalAttachmentSize += $file['size']; //size in bytes
            $emailAttachments .= "Content-Type: "
                . $file['type'] . "; name=\"" . basename($file['name']) . "\"\r\n"
                . "Content-Transfer-Encoding: base64\r\n"
                . "Content-disposition: attachment; filename=\""
                . basename($file['name']) . "\"\r\n"
                . "\r\n"                
                . chunk_split(base64_encode($fileContents))
                . $boundary;
        }
    }
    
    echo $totalAttachmentSize;
    if ($totalAttachmentSize == 0) {
        echo "Message not sent. Either no file was attached, or it was bigger than PHP is configured to accept.";
    }
    
    else if ($totalAttachmentSize > $maxTotalAttachments) {
        echo "Message not sent. Total attachments can't exceed " . $maxTotalAttachments . " bytes.";
    }
    
    else {
        $headers = "From: yourserver@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n"
            . "Content-Type: multipart/mixed; boundary=\"$boundary_text\"" . "\r\n";
        $body .= "If you can see this, your email client "
            . "doesn't accept MIME types!\r\n"
            . $boundary;

        $body .= $emailAttachments;

        $body .= "Content-Type: text/html; charset=\"utf-8\"\r\n"
            . "Content-Transfer-Encoding: 7bit\r\n\r\n"            
            . $htmlMessage . "\r\n"            
            . $boundary_last;
        echo $body;
        if (mail($to, $subject, $body, $headers)) {
            echo "<h2>Thanks!</h2>Form submitted to " . $to . "<br />";
        } else {
            echo 'Error - mail not sent.';
        }
    }
}
?>