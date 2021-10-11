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
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    </head>
    <body style='background:#fff;'>
        <div id="content">
            <!-- tester si l'utilisateur est connecté -->
            <a class="btn btn-primary" style="float: right; margin:5px" href='principale.php?deconnexion=true'><span class="fa fa-sign-out">Déconnexion</span></a>
            <?php
                session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("Location:../login.php");
                   }
                }
                else if($_SESSION['username'] !== ""){
                    $user = $_SESSION['username'];
                    // afficher un message
                    echo "Bonjour $user, vous êtes connecté";
                }
            ?>
            
        </div>


        <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Liste des articles</h2>
                        <a href="../admin/crud_article/create_article.php" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Ajouter un article</a>
                    </div>
                    <?php
                    // Include config file
                    define('DB_SERVER', 'localhost');
                    define('DB_USERNAME', 'root');
                    define('DB_PASSWORD', 'root');
                    define('DB_NAME', 'mglsi_news');
                    
                    /* Attempt to connect to MySQL database */
                    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM Article";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead class=thead-dark>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Titre</th>";
                                        echo "<th>Contenu</th>";
                                        echo "<th>Catégotie</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['titre'] . "</td>";
                                        echo "<td>" . $row['contenu'] . "</td>";
                                        echo "<td>" . $row['categorie'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="../admin/crud_article/read_article.php?id='. $row['id'] .'" class="mr-3" title="Voir" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="../admin/crud_article/update_article.php?id='. $row['id'] .'" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="../admin/crud_article/delete_article.php?id='. $row['id'] .'" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
    </body>
</html>
