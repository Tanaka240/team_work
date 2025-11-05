<?php
  session_start();

  $key = mt_rand(0,3);
  $omikuji = [
    '大吉','吉','中吉','小吉'
  ];
  $omikuji_title = [
    'すべてが成就する至高の一日！',
    '幸運が満ちる良き一日！',
    '実り多き一日！',
    '今は蓄えの時、明日へ繋がる一日！'
  ];
  $omikuji_explanation = [
    '迷いなく進んでください。この最高の運気を静かに味わう格別の一杯が、さらなる幸福を引き寄せます。',
    '周囲との調和を大切に、感謝の気持ちを忘れずに過ごしましょう。温かい一杯が、日々の喜びを深めます。',
    '無理せず、計画通りに一歩ずつ進めば、必ず良い結果に繋がります。一息入れる時間を持つことが成功の鍵です。',
    '静かに今日一日の疲れを癒し、英気を養いましょう。温かいお茶が心の不安を和らげます。'
  ];

  // データベースの情報を取得
  require_once '../db_config.php' ;

  try{
    // データベースに接続
    $connect = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8' ;
    $pdo = new PDO($connect, DB_USER, DB_PASSWORD);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_search = $pdo -> query('select * from items where is_deleted=0 order by rand() limit 1');
    $today_tea = $sql_search -> fetchAll(PDO::FETCH_ASSOC);

    if(!empty($today_tea)){
      $_SESSION['omikuji'] = $omikuji[$key];
      $_SESSION['omikuji_title'] = $omikuji_title[$key];
      $_SESSION['omikuji_explanation'] = $omikuji_explanation[$key];
      $_SESSION['today_tea'] = $today_tea ;
      header('Location: ./view/teaGarden_todayTea-outScreen.php');
      exit();
    }
    else{
      header('Location: ./view/teaGarden_todayTea-inScreen.php');
      exit();
    }
  }
  catch(PDOException $e){
    header('Location: ./view/teaGarden_todayTea-inScreen.php');
    exit();
  }
?>