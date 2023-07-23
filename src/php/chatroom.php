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
    <p>Welcome</p> <p id="current_session_user"><?php echo $_SESSION['username']; ?></p>
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


    <script>
    // Function to send a message using AJAX
    function sendMessage(user, message) {
        // Check if user and message are valid before proceeding
        if (!user || !message) {
            console.error('Invalid user or message data');
            return;
        }

        var xhr = new XMLHttpRequest();
        var url = "insert_message.php"; // Update this if the PHP file is in a different location

        // Create the data to be sent in the POST request
        var data = new FormData();
        data.append('user', user);
        data.append('message', message);
        //console.log(data);

        // Configure the AJAX request
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // The message was sent successfully
                    console.log(xhr.responseText);
                    // You can update the chat interface here to show the sent message
                    // For example, update the chat window with the newly sent message
                } else {
                    // Handle any errors if the message couldn't be sent
                    console.error('Error sending message: ' + xhr.status);
                }
            }
        };

        // Send the request with the message data
        xhr.send(data);
    }

    // Function to handle sending a message
    function handleMessageSend() {
        var sender = document.getElementById("current_session_user").innerHTML;
        var messageInput = document.getElementById("message-input");
        var message = messageInput.value.trim();
        if (message !== '') {
            const chatMessages = document.querySelector('.chat-messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message');
            messageElement.textContent = message;
            chatMessages.appendChild(messageElement);
            messageInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
            sendMessage(sender, message); // Send the message to the database using AJAX
        }
    }

    // Add event listeners to handle the "click" event for the "Send" button and the "keydown" event for the input field
    document.getElementById("send-button").addEventListener("click", handleMessageSend);
    document.getElementById("message-input").addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            handleMessageSend();
        }
    });
</script>


</body>

</html>