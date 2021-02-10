<?php
  require 'database.php';

  if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
  }

  if(!empty($_POST)){
    /*$id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();*/
    header("Location: index.php");
  }

  function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Burger Code</title>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-4.6.0.css">
    <script src="../assets/js/bootstrap-4.6.0.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
  </head>

  <body>
    <h1 class="text-logo"><span class="fas fa-utensils"></span> Burger Code <span class="fas fa-utensils"></span></h1>
    <div class="container admin">
      <div class="row">
        <h1><strong>Supprimer un item</strong></h1>
        <br>
        <form class="form" role="form" action="delete.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <p class="alert alert-warning">Etes-vous sûr de vouloir supprimer ?</p>
          <div class="form-actions">
            <button type="submit" class="btn btn-warning">Oui</button>
            <a class="btn btn-default" href="index.php">Non</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
