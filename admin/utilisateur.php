<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    </head>
    <body style='background:#fff;'>
        <!--<div id="content">
             tester si l'utilisateur est connecté
            <a class="btn btn-primary" style="float: right; margin:5px" href='principale.php?deconnexion=true'><span class="fa fa-sign-out">Déconnexion</span></a>
            
            
        </div>-->

        <div class="container">
  <ul class="nav nav-tabs">
    <li style="margin: 5%" class="active"><a href="principale.php">Articles</a></li>
    <li style="margin: 5%"><a href="#">Utilisateurs</a></li>
  </ul>
</div>

        <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Liste des utilisateurs</h2>
                        <a href="crud_user/create_user.php" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
                    </div>
                    <?php
                    
                    define('DB_SERVER', 'localhost');
                    define('DB_USERNAME', 'root');
                    define('DB_PASSWORD', 'root');
                    define('DB_NAME', 'mglsi_news');
                    
                    /* Attempt to connect to MySQL database */
                    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                    // Attempt select query execution
                    $sql = "SELECT * FROM utilisateur";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead class=thead-dark>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Prénom</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Identifiant</th>";
                                        echo "<th>Rôle</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['prenom'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['nom_utilisateur'] . "</td>";
                                        echo "<td>" . $row['roles'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="crud_user/read_user.php?id='. $row['id'] .'" class="mr-3" title="Voir" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="crud_user/update_user.php?id='. $row['id'] .'" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="crud_user/delete_user.php?id='. $row['id'] .'" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connexion
                    $mysqli->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
    </body>
</html>
