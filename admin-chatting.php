<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
          <link rel="stylesheet" href="./chat.css">
          <script src="./chat.js"></script>
          <title>messege_admin</title>
</head>

<body>

          <div class="chat-container">
                    <div id="selector-div" class="chat-header">
                              <select id="selector-id">
                                        <option>select chat</option>
                              </select>
                    </div>
                    <div id="chat_container" class="chat-messages">
                              <!-- Chat messages go here -->
                    </div>
                    <div class="chat-input">
                              <input id="user_input" type="text" class="message-input" placeholder="Type a message...">
                              <button id="sender" class="send-button">&#9658;</button>
                    </div>
          </div>