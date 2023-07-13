<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Real-Time Chat Application</title>
</head>

<body>
  <header>
    <h1>Real-Time Chat Application</h1>
  </header>
  <p>Welcome, <?php echo $_SESSION['username']; ?></p>
  <div class="container">
    <div class="chat-window">
      <div class="chat-area">
        <div class="chat-messages">
          <!-- Chat Messages -->
        </div>
      </div>
      <div class="user-input">
        <input type="text" id="message-input" placeholder="Type your message...">
        <button id="send-button">Send</button>
      </div>
    </div>
  </div>

  <script src="../js/script.js"></script>
</body>

</html>