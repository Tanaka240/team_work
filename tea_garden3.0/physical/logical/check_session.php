<?php
  session_start();
  header('Content-Type: application/json');

  if(isset($_SESSION['home_address']) && !empty($_SESSION['home_address']) && isset($_SESSION['phone_number']) && !empty($_SESSION['phone_number'])){
    $response = [
      'status' => 'ok',
      'message' => '住所と電話番号が確認されました。',
    ];
  }
  else{
    $response = [
      'status' => 'error',
      'message' => '購入には住所と電話番号の登録が必要です。ユーザー情報から情報を更新してください。'
    ];
    http_response_code(403);
  }

  echo json_encode($response);
  exit;
?>