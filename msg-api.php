<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
          if ($_GET['action'] == 'addUser') {
                    $jsonData = file_get_contents('users.json');
                    $array = json_decode($jsonData, true);
                    $object = array(
                              'user' => isset($_POST['user']) ? $_POST['user'] : '',
                              'number' => isset($_POST['number']) ? intval($_POST['number']) : 0,
                              'user_chat' => [],
                              'admin_chat' => []
                    );
                    $array[] = $object;
                    $x = count($array);
                    $jsonData = json_encode($array);
                    file_put_contents('users.json', $jsonData);
                    $response = [
                              "user" => $_POST['user'],
                              "id" => $x - 1
                    ];
                    header("Content-Type: application/json");
                    echo json_encode($response);
          }
          // //////////////send msg add here send back response//////////////
          if ($_GET['action'] == 'user_send') {
                    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    header("Content-Type: application/json");
                    $jsonDataFile = file_get_contents('users.json');
                    $array = json_decode($jsonDataFile, true);
                    $rawPostData = file_get_contents("php://input");
                    // Check if the data is not empty
                    if (!empty($rawPostData)) {
                              // Parse the JSON data
                              $jsonData = json_decode($rawPostData, true);

                              if ($jsonData !== null) {
                                        // Successfully parsed JSON data
                                        $id = $jsonData['jwt'];
                                        $userChat = $array[$id]['user_chat'];
                                        $userChat[] = $jsonData['data'];
                                        $array[$id]['user_chat'] = $userChat;
                                        $array[$id]['admin_chat'] = [];
                                        $jsonArray = json_encode($array);
                                        file_put_contents('users.json', $jsonArray);
                                        // echo json_encode(json_decode(file_get_contents('users.json'), true)[$id]['admin_chat']);
                              } else {
                                        http_response_code(400); // Bad Request
                                        echo json_encode(["error" => "Invalid JSON data"]);
                              }
                    } else {
                              http_response_code(400); // Bad Request
                              echo json_encode(["error" => "No data received"]);
                    }
          }
          // //////////////admin action send msg add here //////////////
          if ($_GET['action'] == 'admin_send') {
                    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    header("Content-Type: application/json");
                    $jsonDataFile = file_get_contents('users.json');
                    $array = json_decode($jsonDataFile, true);
                    $rawPostData = file_get_contents("php://input");
                    // Check if the data is not empty
                    if (!empty($rawPostData)) {
                              // Parse the JSON data
                              $jsonData = json_decode($rawPostData, true);

                              if ($jsonData !== null) {
                                        // Successfully parsed JSON data
                                        $id = $jsonData['jwt'];
                                        $userChat = $array[$id]['admin_chat'];
                                        $userChat[] = $jsonData['data'];
                                        $array[$id]['admin_chat'] = $userChat;
                                        $array[$id]['user_chat'] = [];
                                        $jsonArray = json_encode($array);
                                        file_put_contents('users.json', $jsonArray);
                                        // echo json_encode(json_decode(file_get_contents('users.json'), true)[$id]['admin_chat']);
                              } else {
                                        http_response_code(400); // Bad Request
                                        echo json_encode(["error" => "Invalid JSON data"]);
                              }
                    } else {
                              http_response_code(400); // Bad Request
                              echo json_encode(["error" => "No data received"]);
                    }
          }
          /////////////////////////admin msgs api//////////////////
          if ($_GET['action'] == 'admin_chat') {
                    header("Content-Type: application/json");
                    $jsonDataFile = file_get_contents('users.json');
                    $array = json_decode($jsonDataFile, true);
                    $rawPostData = file_get_contents("php://input");
                    $jsonData = json_decode($rawPostData, true);
                    if ($array) {
                              $data = $array[$jsonData['jwt']]['admin_chat'];
                              // $array[$jsonData['jwt']]['admin_chat'] = [];
                              // $jsonArray = json_encode($array);
                              // file_put_contents('users.json', $jsonArray);
                              echo json_encode($data);
                    } else {
                              http_response_code(500); // Set an appropriate HTTP status code (e.g., 500 Internal Server Error)
                              echo json_encode(array("error" => "Failed to load data from users.json"));
                    }
          }
          ///////////////admin recieve user msges by api messeges/////////////////////
          if ($_GET['action'] == 'user_chat') {
                    header("Content-Type: application/json");
                    $jsonDataFile = file_get_contents('users.json');
                    $array = json_decode($jsonDataFile, true);
                    $rawPostData = file_get_contents("php://input");
                    $jsonData = json_decode($rawPostData, true);
                    if ($array) {
                              $data = $array[$jsonData['jwt']]['user_chat'];
                              // $array[$jsonData['jwt']]['admin_chat'] = [];
                              // $jsonArray = json_encode($array);
                              // file_put_contents('users.json', $jsonArray);
                              echo json_encode($data);
                    } else {
                              http_response_code(500); // Set an appropriate HTTP status code (e.g., 500 Internal Server Error)
                              echo json_encode(array("error" => "Failed to load data from users.json"));
                    }
          }
}
///////////////////////admins ui apis///////////////////
if ($_GET['action'] == 'adminui_user_list') {
          header("Content-Type: application/json");
          $jsonDataFile = file_get_contents('users.json');
          $array = json_decode($jsonDataFile, true);
          if ($array) {
                    $resultArray = array();
                    $arrayLength = count($array);
                    // $selectorArray = [];
                    for ($i = 0; $i < $arrayLength; $i++) {
                              $item = $array[$i];
                              if (isset($item['user_chat']) && $item['user_chat'] != []) {
                                        // $resultArray[$i] = $item;
                                        $person = array(
                                                  "id" => $i,
                                                  "user_chat" => $item['user_chat'],
                                                  "name" => $item['user']
                                        );
                                        $resultArray[] = $person;
                              }
                    }
                    echo json_encode($resultArray);
          } else {
                    http_response_code(500); // Set an appropriate HTTP status code (e.g., 500 Internal Server Error)
                    echo json_encode(array("error" => "Failed to load data from users.json"));
          }
}
