window.addEventListener("load", function () {
  if (window.location.href.includes("messege.php")) {
    if (localStorage.getItem("jwt")) {
      document.getElementById("formdib").style.display = "none";
      document.getElementById("chatting").style.display = "block";
    } else {
      const form = document.getElementById("myForm");
      form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission
        const formData = new FormData(form);
        console.log(formData);
        fetch("http://localhost/firstPHP/msg-api.php?action=addUser", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            localStorage.setItem("jwt", JSON.stringify(data));
            window.location.reload();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    }
    ///////////////////////////send msg user container//////////////////
    document.getElementById("sender").addEventListener("click", function () {
      let inputValue = document.getElementById("user_input").value;
      var newChat = document.createElement("p");
      newChat.textContent = `me::${inputValue}`;
      document.getElementById("chat_container").appendChild(newChat);
      document.getElementById("user_input").value = "";
      let jwt = JSON.parse(localStorage.getItem("jwt"));
      let load = {
        data: inputValue,
        jwt: jwt.id,
      };
      fetch("http://localhost/firstPHP/msg-api.php?action=user_send", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(load),
      })
        .then((response) => response.json())
        .then((data) => {})
        .catch((error) => {
          console.error("Error:", error);
        });
    });
    ////////////fetch admin chat/////////
    fetchAdminChat();
  }
  ///////////////////////////
  if (window.location.href.includes("admin-chatting.php")) {
    //////on change event////////////
    let fetched_data = [];
    this.setInterval(function () {
      const selectElement = document.getElementById("selector-id");
      // document.getElementById("selector-id").innerHTML = "";
      fetch("http://localhost/firstPHP/msg-api.php?action=adminui_user_list")
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          if (fetched_data.length != data.length) {
            document.getElementById("selector-id").innerHTML = "";
            fetched_data = data;
            let option1 = document.createElement("option");
            option1.text = "select chat";
            selectElement.appendChild(option1);
            data.forEach((item) => {
              const option = document.createElement("option");
              option.text = item["name"];
              option.value = item["id"];
              selectElement.appendChild(option);
            });
          }
        })
        .catch((error) => {
          console.error("There was a problem with the fetch operation:", error);
        });
    }, 1000);
    //////////////on change event appends users chats ///////
    var intervwl;
    document
      .getElementById("selector-id")
      .addEventListener("change", function () {
        clearInterval(intervwl);
        let id = document.getElementById("selector-id").value;
        console.log(id);
        intervwl = setInterval(function () {
          let load = {
            jwt: id,
          };
          fetch("http://localhost/firstPHP/msg-api.php?action=user_chat", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(load),
          })
            .then((response) => response.json())
            .then((data) => {
              console.log(data);
              if (!arraysAreEqual(data, before)) {
                document.getElementById("chat_container").innerHTML = "";
                before = [...data];
                // append(data);
                data.forEach(function (item) {
                  var newChat = document.createElement("p");
                  newChat.textContent = `user::${item}`;
                  document
                    .getElementById("chat_container")
                    .appendChild(newChat);
                });
              }
            })
            .catch((error) => {
              console.error("Error:", error);
            });
        }, 1000);
      });
    ///////////////////////////send msg user container//////////////////
    document.getElementById("sender").addEventListener("click", function () {
      let inputValue = document.getElementById("user_input").value;
      var newChat = document.createElement("p");
      newChat.textContent = `admin::${inputValue}`;
      document.getElementById("chat_container").appendChild(newChat);
      document.getElementById("user_input").value = "";
      // let jwt = JSON.parse(localStorage.getItem("jwt"));
      let id = document.getElementById("selector-id").value;
      // console.log(id + "idvalue");
      let load = {
        data: inputValue,
        jwt: id,
      };
      fetch("http://localhost/firstPHP/msg-api.php?action=admin_send", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(load),
      })
        .then((response) => response.json())
        .then((data) => {})
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }
  //////////////enter button//////////////////
  // Get references to the text input and sender button elements
  const textInput = document.getElementById("user_input");
  const senderButton = document.getElementById("sender");

  // Add an event listener to the text input for keypress events
  textInput.addEventListener("keypress", function (event) {
    // Check if the key pressed is the Enter key (key code 13)
    if (event.keyCode === 13) {
      // Trigger a click event on the sender button
      senderButton.click();
    }
  });

  // Add a click event listener to the sender button
  // senderButton.addEventListener("click", function () {
  //   alert("Button Clicked!");
  // });
});
////////////////functioncssssssssssss///////////
var before = [];
function fetchData(url) {
  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // console.log(data);
      return data;
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}
function fetchAdminChat() {
  this.setInterval(function () {
    let jwt = JSON.parse(localStorage.getItem("jwt"));
    let load = {
      jwt: jwt.id,
    };
    // console.log(load);
    fetch("http://localhost/firstPHP/msg-api.php?action=admin_chat", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(load),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (!arraysAreEqual(data, before)) {
          before = [...data];
          append(data);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }, 1000);
}
///////////appender to dom/////////////////
function append(data) {
  data.forEach(function (item) {
    var newChat = document.createElement("p");
    newChat.textContent = `siddu::${item}`;
    document.getElementById("chat_container").appendChild(newChat);
  });
}
///////////array equator///////////
function arraysAreEqual(arr1, arr2) {
  if (arr1.length !== arr2.length) {
    return false;
  }
  for (let i = 0; i < arr1.length; i++) {
    if (arr1[i] !== arr2[i]) {
      return false;
    }
  }
  return true;
}
