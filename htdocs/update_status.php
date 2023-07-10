<?php
  require('functions.php');
  $db = mysqli_connect('mysql', 'root', 'root', 'staying_in_room');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }
  mysqli_set_charset($db, 'utf-8');
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST["status"]; 
    $teacher_id = $_POST["teacher_id"]; 
    mysqli_query($db, "UPDATE teacher SET status = {$status} WHERE teacher_id = {$teacher_id} ");
    header('Location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title></title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>
  <div id="wrapper" class="w-75 mx-auto p-3">
    <header>
      <h1 class="text-center">在室状況変更</h1>
    </header>

    <main>
      <form class="mb-4" method="post">
        <p>
          先生名：
          <select name="teacher_id" id="teacher">
          <?php
            $records = mysqli_query($db, 'SELECT * FROM teacher');
            while ($data = mysqli_fetch_assoc( $records )): 
          ?>
          <option value="<?=h($data['teacher_id']);?>"><?=h($data['teacher_name']);?></option>
          <?php endwhile; ?>
          </select>
        </p>
        <p>
          在室状況：
          <label>
            <input type="radio" name="status" value="1" 
              <?php 
                if($data['teacher_id'] == 1) {
                  echo 'checked';
                };
              ?>>
            在室
          </label>
          <label>
            <input type="radio" name="status" value="0" 
              <?php 
                if($data['teacher_id'] == 0) {
                  echo 'checked';
                };
              ?>>
            離室
          </label>
        </p>
        <a href="index.php"><input class="btn btn-secondary btn-back" value='戻る'></a>
        <input class="btn btn-primary" type="submit" value="送信">
      </form>
    </main>

    <footer class="text-center">
		  © Ebina Kai
    </footer>
    </div>
</body>
</html>