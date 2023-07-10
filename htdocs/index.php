<?php
  require('functions.php');
  $db = mysqli_connect('mysql', 'root', 'root', 'staying_in_room');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }
  mysqli_set_charset($db, 'utf-8');
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
      <h1 class="text-center">在室状況管理システム</h1>
    </header>

    <main>
      <nav>
        <h3>MENU</h3>
        <ul>
          <li><a href="insert_teacher.php">教員登録</a></li>
          <li><a href="update_status.php">在室状況入力</a></li>
        </ul>
      </nav>

      <section class="container">
        <table class="table w-50">
          <thead>
            <tr>
              <th scope="col">教員氏名</th>
              <th scope="col">在室状況</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $records = mysqli_query($db, 'SELECT * FROM teacher');
            while ($data = mysqli_fetch_assoc( $records )): 
            ?>
            <tr>
              <td><?= h($data['teacher_name']); ?></td>
              <td>
                <?php if(h($data['status']) == 1) {
                  echo '在室';
                } else {
                  echo '離室';
                } ?>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </section>
    </main>

    <footer class="text-center">
		  © G8-1
    </footer>
    </div>
</body>
</html>