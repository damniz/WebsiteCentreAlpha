<?php
require __DIR__ . '/recaptcha-config.php';

// Show an alert and go back to the contact page.
function back_to_contact($message) { ?>
	<script type="text/javascript">
		alert(<?php echo json_encode($message); ?>);
		window.location = 'contact.html';
	</script>
<?php
	exit;
}

// Remove line breaks so a value cannot inject extra mail headers.
function single_line($value) {
	return trim(str_replace(["\r", "\n"], ' ', $value));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: contact.html');
	exit;
}

$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$verify = curl_exec($ch);
curl_close($ch);
$captcha_success = json_decode($verify)->success ?? false;

if (!$captcha_success) {
	back_to_contact('Merci de cocher la case "Je ne suis pas un robot" avant d\'envoyer le formulaire.');
}

$field_name = single_line($_POST['name'] ?? '');
$field_tel = single_line($_POST['tel'] ?? '');
$field_email = single_line($_POST['email'] ?? '');
$field_message = trim($_POST['message'] ?? '');

if ($field_name === '' || $field_message === '' || !filter_var($field_email, FILTER_VALIDATE_EMAIL)) {
	back_to_contact('Merci de remplir votre nom, une adresse e-mail valide et votre message.');
}

$mail_to = 'nivelles@centrealpha.be';
// The sender must be on our own domain (SPF), the visitor goes in Reply-To.
$mail_from = 'Site web Centre Alpha <nivelles@centrealpha.be>';
$subject = 'Message d\'un visiteur du site web : '.$field_name;

// Create the email body
$body_message = "De: ". $field_name ."\n";
$body_message .= "Téléphone: ". $field_tel ."\n";
$body_message .= "E-mail: ". $field_email ."\n";
$body_message .= "Message:"."\n\n". $field_message;

// Set the appropriate headers
$headers = "From: ".$mail_from."\r\n";
$headers .= "Reply-To: ".$field_email."\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";

// Encode the subject using mb_encode_mimeheader
$subject = mb_encode_mimeheader($subject, "UTF-8");

// Encode the body using mb_convert_encoding
$body_message = mb_convert_encoding($body_message, 'UTF-8');

$mail_status = mail($mail_to, $subject, $body_message, $headers, '-fnivelles@centrealpha.be');

if ($mail_status) {
	back_to_contact('Merci pour votre message. Nous prendrons rapidement contact avec vous.');
}
else {
	back_to_contact('Le message n\'a pas pu être délivré. Merci de nous envoyer un mail à nivelles@centrealpha.be ou nous laisser un message au numéro +32 67 67 09 89.');
}
