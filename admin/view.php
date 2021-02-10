<?php
  require 'database.php';

  if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
  }

  $db = Database::connect();
  $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                          FROM items LEFT JOIN categories ON items.category = categories.id
                          WHERE items.id = ?');
  $statement->execute(array($id));
  $item = $statement->fetch();
  Database::disconnect();

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
        <div class="col-sm-6">
          <h1><strong>Voir un item</strong></h1>
          <br>
          <form>
            <div class="form-group">
              <label for="">Nom: </label><?php echo ' ' . $item['name']; ?>
            </div>
            <div class="form-group">
              <label for="">Description: </label><?php echo ' ' . $item['description']; ?>
            </div>
            <div class="form-group">
              <label for="">Prix: </label><?php echo ' ' . number_format((float)$item['price'],2, '.', '') . ' €'; ?>
            </div>
            <div class="form-group">
              <label for="">Catégorie: </label><?php echo ' ' . $item['name']; ?>
            </div>
            <div class="form-group">
              <label for="">Image: </label><?php echo ' ' . $item['image']; ?>
            </div>
          </form>

          <br>

          <div class="form-actions">
            <a class="btn btn-primary" href="index.php"><span class="fas fa-arrow-left"></span> Retour</a>
          </div>

        </div>

        <div class="col-sm-6 site">
           <div class="bg-light">
            <img src="<?php echo '../assets/img/' . $item['image']; ?>" alt="" width="276px" height="244px">
            <div class="price"><?php echo ' ' . number_format((float)$item['price'],2, '.', '') . ' €'; ?></div>
            <div class="caption">
              <h4><?php echo $item['name']; ?></h4>
              <p><?php echo $item['description']; ?></p>
<a href="#" class="btn btn-order" role="button"><span class="fas fa-shopping-cart"></span> Commander</a>
            </div>
          </div>
        </div>


      </div>
    </div>
  </body>
</html>
