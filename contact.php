<?php
$field_name = $_POST['name'];
$field_tel = $_POST['tel'];
$field_email = $_POST['email'];
$field_message = $_POST['message'];

$mail_to = 'nivelles@centrealpha.be';
$subject = 'Message d\'un visiteur du site web : '.$field_name;

// Create the email body
$body_message = "De: ". $field_name ."\n";
$body_message .= "Téléphone: ". $field_tel ."\n";
$body_message .= "E-mail: ". $field_email ."\n";
$body_message .= "Message:\n. $field_message;

// Set the appropriate headers
$headers = "From: ".$field_email."\r\n";
$headers .= "Reply-To: ".$field_email."\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";

// Encode the subject using mb_encode_mimeheader
$subject = mb_encode_mimeheader($subject, "UTF-8");

// Encode the body using mb_convert_encoding
$body_message = mb_convert_encoding($body_message, 'UTF-8');

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Merci pour votre message. Nous prendrons rapidement contact avec vous.');
		window.location = 'http://www.centrealpha.be/contact.html';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Le message n\'a pas pu être délivré. Merci de nous envoyer un mail à nivelles@centrealpha.be ou nous laisser un message au numéro +32 67 67 09 89.');
		window.location = 'http://www.centrealpha.be/contact.html';
	</script>
<?php
}
?>
