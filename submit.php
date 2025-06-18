 <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name    = htmlspecialchars(trim($_POST["name"] ?? ""));
  $email   = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
  $phone   = htmlspecialchars(trim($_POST["phone"] ?? ""));
  $message = htmlspecialchars(trim($_POST["message"] ?? ""));

  if ($name && $email && $phone && $message) {
    $to = "kabadepresley@gmail.com";
    $subject = "New Appointment Request from $name";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nReason:\n$message";

    $headers = "From: noreply@driftafrica.co.za\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Cc: yourpartner@example.com\r\n";    // Optional
    $headers .= "Bcc: backupinbox@example.com\r\n";   // Optional

    if (mail($to, $subject, $body, $headers)) {
      header("Location: thank-you.html");
      exit;
    } else {
      echo "❌ Message failed to send. Please try again later.";
    }
  } else {
    echo "⚠️ Please fill in all required fields.";
  }
} else {
  echo "⚠️ Invalid request method.";
}
?> 