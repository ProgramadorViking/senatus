<?php
  function error($code,$message) {
    $data['errorCode']=$code;
    $data['errorMessage']=$message;
    header('Content-Type: application/json');
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode($data);
  }
?>
