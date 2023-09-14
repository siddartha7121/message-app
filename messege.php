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
          <title>messege_user</title>
</head>

<body>
          <div id="formdib" class="container bg-danger h-75">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                              <div class="col-4">
                                        <form id="myForm" method="POST">
                                                  <div class="mb-3">
                                                            <label for="form-text" class="form-label">USERNAME</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" name="user" placeholder="enter your name">
                                                            <div id="emailHelp" class="form-text">try to remember these
                                                            </div>
                                                  </div>
                                                  <div class="mb-3">
                                                            <label for="number" class="form-label">MOBILE number</label>
                                                            <input type="number" class="form-control" name="number" id="exampleInputMOBILENUMBER">
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">SAVE AND CHAT</button>
                                        </form>
                              </div>
                    </div>
          </div>
          <!-- <div id="result"></div> -->
          <div id="chatting">
                    <div class="chat-container">
                              <div class="chat-header">Siddarth_narayan</div>
                              <div id="chat_container" class="chat-messages">
                                        <!-- Chat messages go here -->
                              </div>
                              <div class="chat-input">
                                        <input id="user_input" type="text" class="message-input" placeholder="Type a message...">
                                        <button id="sender" class="send-button">&#9658;</button>
                              </div>
                    </div>
          </div>
          <!-- <script>
                    document.addEventListener("DOMContentLoaded", function() {
                              if (localStorage.getItem('jwt')) {
                                        document.getElementById('formdib').style.display =
                                                  'none'
                                        document.getElementById('chatting').style
                                                  .display = 'block'
                              } else {
                                        const form = document.getElementById("myForm");
                                        form.addEventListener("submit", function(e) {
                                                  e
                                                            .preventDefault(); // Prevent the default form submission

                                                  const formData = new FormData(
                                                            form);

                                                  fetch("http://localhost/firstPHP/msg-api.php", { // Use a relative path to the PHP script
                                                                      method: "POST",
                                                                      body: formData,
                                                            })
                                                            .then(response =>
                                                                      response
                                                                      .json())
                                                            .then(data => {
                                                                      localStorage
                                                                                .setItem('jwt',
                                                                                          JSON
                                                                                          .stringify(
                                                                                                    data
                                                                                          )
                                                                                )
                                                                      window.location
                                                                                .reload();
                                                            })
                                                            .catch(error => {
                                                                      // Handle any errors that occurred during the fetch
                                                                      console.error("Error:",
                                                                                error
                                                                      );
                                                            });
                                        });
                              }
                              ///////////////////////////chat container//////////////////
                              document.getElementById('sender').addEventListener('click',
                                        function() {
                                                  let inputValue = document.getElementById(
                                                            'user_input').value;
                                                  var newChat = document.createElement("p");
                                                  newChat.textContent = `me::${inputValue}`;
                                                  document.getElementById("chat_container")
                                                            .appendChild(newChat);
                                                  document.getElementById(
                                                            'user_input').value = ""
                                                  let jwt = JSON.parse(localStorage.getItem('jwt'));
                                                  let load = {
                                                            data: inputValue,
                                                            jwt: jwt.id,
                                                  };

                                                  fetch("http://localhost/firstPHP/msg-api2.php", {
                                                                      method: "POST",
                                                                      headers: {
                                                                                "Content-Type": "application/json",
                                                                      },
                                                                      body: JSON.stringify(
                                                                                load
                                                                      ),
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                      // console.log(data);
                                                                      // Assuming 'data' is an array
                                                                      if (data) {
                                                                                data.forEach(function(
                                                                                          item
                                                                                ) {
                                                                                          // Create a new paragraph element
                                                                                          var newChat =
                                                                                                    document
                                                                                                    .createElement(
                                                                                                              "p"
                                                                                                    );
                                                                                          // Set the text content of the paragraph
                                                                                          newChat.textContent =
                                                                                                    `siddu::${item}`;
                                                                                          // Append the paragraph element to the 'chat_container'
                                                                                          document.getElementById(
                                                                                                              "chat_container"
                                                                                                    )
                                                                                                    .appendChild(
                                                                                                              newChat
                                                                                                    );
                                                                                });
                                                                      }
                                                            })
                                                            .catch(error => {
                                                                      console.error("Error:",
                                                                                error
                                                                      );
                                                            });

                                        })
                    });
          </script> -->
</body>

</html>