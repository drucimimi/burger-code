<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Burger Code</title>
    <script src="assets/js/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.6.0.css">
    <script src="assets/js/bootstrap-4.6.0.js"></script>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  </head>
  <body>
    <div class="container site">

      <h1 class="text-logo"><span class="fas fa-utensils"></span> Burger Code <span class="fas fa-utensils"></span></h1>
      <a class="btn btn-warning" href="admin/index.php"><span class="fas fa-arrow-right"></span> Accéder à l'interface d'administration</a>
      <br><br>
      <?php
        require 'admin/database.php';
        echo '<nav class="navbar navbar-expand-md" role="navigation">
                <ul class="nav nav-pills" role="tablist">';
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();
        foreach ($categories as $category) {
          if($category['id'] == '1'){
            echo '<li role="presentation" class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" href="#' . $category['name'] . '" id="' . $category['name'] . '-tab" aria-selected="true" aria-controls="' . $category['name'] . '">' . $category['name'] . '</a></li>';
          } else{
            echo '<li role="presentation" class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" href="#' . $category['name'] . '" id="' . $category['name'] . '-tab" aria-selected="false" aria-controls="' . $category['name'] . '">' . $category['name'] . '</a></li>';
          }
        }
        echo '</ul>
          </nav>';
        echo '<div class="tab-content">';

        foreach ($categories as $category) {
          if($category['id'] == '1'){
            echo '<div class="tab-pane active" id="' . $category['name'] . '" role="tabpanel" aria-labelledby="' . $category['name'] . '-tab">';
          } else{
            echo '<div class="tab-pane" id="' . $category['name'] . '" role="tabpanel" aria-labelledby="' . $category['name'] . '-tab">';
          }
          echo '<div class="row">';

          $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
          $statement->execute(array($category['id']));

          while($item = $statement->fetch()){
            echo '<div class="col-md-6 col-lg-4">
                    <div class="bg-light mb-4">
                      <img src="assets/img/' . $item['image'] . '" alt="" width="276px" height="244px">
                      <div class="price">' . number_format($item['price'], 2, '.', '') . '</div>
                        <div class="caption">
                          <h4>' . $item['name'] . '</h4>
                          <p>' . $item['description'] . '</p>
          <a href="#" class="btn btn-order" role="button"><span class="fas fa-shopping-cart"></span> Commander</a>
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
