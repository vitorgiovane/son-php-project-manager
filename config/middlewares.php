<?php

$after = [];

$middlewares = [
  "before" => [
    function ($container) {
      session_start();
    },
    function ($container) {
      header("Content-Type: text/plain");
    }
  ],
  "after" => [
    function ($container) {
      echo json_encode(["message" => "After"]);
    },
    function ($container) {
      echo json_encode(["message" => "After 2"]);
    }
  ]
];
