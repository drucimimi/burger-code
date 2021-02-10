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
        <div class="col-12 mb-4">
          <p><a class="btn btn-warning" href="../index.php"><span class="fas fa-arrow-left"></span> Retour au site principal</a></p>
        </div>
        <div class="col-12">
        <h1><strong>Liste des items</strong> <a href="insert.php" class="btn btn-success btn-lg"> <span class="fas fa-plus"></span> Ajouter</a></h1>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Prix</th>
              <th>Catégorie</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php
              require 'database.php';
              $db = Database::connect();
              $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                      FROM items LEFT JOIN categories ON items.category = categories.id
                                      ORDER BY items.id DESC');
              while ($item = $statement->fetch()) {
                echo '<tr>';
                echo '<td>' . $item['name'] . '</td>';
                echo '<td>' . $item['description'] . '</td>';
                echo '<td>' . number_format((float)$item['price'],2, '.', '') . ' €' . '</td>';
                echo '<td>' . $item['category'] . '</td>';
                echo '<td width="300">';
                echo '<a class="btn btn-default border" href="view.php?id=' . $item['id'] . '"><span class="fas fa-eye"></span> Voir</a>';
                echo ' ';
                echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="fas fa-pencil-alt"></span> Modifier</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="fas fa-trash"></span> Supprimer</a>';
                echo '</td>';
                echo '</tr>';
              }
              Database::disconnect();
            ?>

          </tbody>
        </table>
        </div>
      </div>
    </div>
  </body>
</html>
