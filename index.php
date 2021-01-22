<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Burger Code</title>
    <script src="assets/js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-3.3.7.css">
    <script src="assets/js/bootstrap-3.3.7.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  </head>
  <body>
    <div class="container site">

      <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span class="glyphicon glyphicon-cutlery"></span></h1>
      <a class="btn btn-warning" href="admin/index.php"><span class="glyphicon glyphicon-arrow-right"></span> Accéder à l'interface d'administration</a>
      <br><br>
      <?php
        require 'admin/database.php';
        echo '<nav>
            <ul class="nav nav-pills">';
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();
        foreach ($categories as $category) {
          if($category['id'] == '1'){
            echo '<li role="presentation" class="active"><a data-toggle="tab" href="#' . $category['id'] . '">' . $category['name'] . '</a></li>';
          } else{
            echo '<li role="presentation"><a data-toggle="tab" href="#' . $category['id'] . '">' . $category['name'] . '</a></li>';
          }
        }
        echo '</ul>
          </nav>';
        echo '<div class="tab-content">';

        foreach ($categories as $category) {
          if($category['id'] == '1'){
            echo '<div class="tab-pane active" id="' . $category['id'] . '">';
          } else{
            echo '<div class="tab-pane" id="' . $category['id'] . '">';
          }
          echo '<div class="row">';

          $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
          $statement->execute(array($category['id']));

          while($item = $statement->fetch()){
            echo '<div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <img src="img/' . $item['image'] . '" alt="" width="276px" height="244px">
                      <div class="price">' . number_format($item['price'], 2, '.', '') . '</div>
                        <div class="caption">
                          <h4>' . $item['name'] . '</h4>
                          <p>' . $item['description'] . '</p>
          <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                        </div>
                      </div>
                    </div>';
          }
          echo '</div>
              </div>';
        }
        Database::disconnect();
        echo '</div>';

      ?>

    </div>
  </body>
</html>
