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

    <!-- <script src="../js/script.js"></script> -->

        <!-- Add this script tag at the end of your HTML body section -->
    <script>
    // Function to fetch new messages from the server
    function fetchNewMessages() {
        // Make an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_new_messages.php", true); // Replace "get_new_messages.php" with your actual PHP file to fetch new messages
        xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
            // If the request is successful, handle the response
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);
            // Update the chat interface with the new messages
            updateChatInterface(response.messages);
            }else{
                console.log("Error: " + xhr.status + " - " + xhr.statusText);
            }
        }
        };
        xhr.send();
    }

    // Call the fetchNewMessages function every 5 seconds (adjust the interval as needed)
    setInterval(fetchNewMessages, 3000); // 5000 milliseconds = 5 seconds

    function updateChatInterface(messages) {
        // Get the chat container element
        var chatContainer = document.querySelector('.chat-messages'); // Replace "chat-container" with your actual chat container element's class

        // Clear the chat container before appending new messages
        chatContainer.innerHTML = '';

        // Loop through the new messages and append them to the chat container
        for (var i = 0; i < messages.length; i++) {
            var message = messages[i];
            var messageElement = document.createElement("div");
            messageElement.className = "message";
            messageElement.textContent = message.MESSAGE; // Assuming the message content is stored in the 'MESSAGE' field of the message object
            chatContainer.appendChild(messageElement);
        }
  }
    </script>



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