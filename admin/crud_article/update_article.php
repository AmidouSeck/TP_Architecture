<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$titre = $contenu = $categorie = "";
$titre_err = $contenu_err = $categorie_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_titre = trim($_POST["titre"]);
    if(empty($input_titre)){
        $titre_err = "Entrez le titre.";
    } elseif(!filter_var($input_titre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $titre_err = "Entrez un titre valide.";
    } else{
        $titre = $input_titre;
    }
    
    // Validate address address
    $input_contenu = trim($_POST["contenu"]);
    if(empty($input_contenu)){
        $contenu_err = "Entrez le contenu.";     
    } else{
        $contenu = $input_contenu;
    }
    
    // Validate salary
    $input_categorie = trim($_POST["categorie"]);
    if(empty($input_categorie)){
        $categorie_err = "Entrez la catégorie.";     
    } elseif(!ctype_digit($input_categorie)){
        $categorie_err = "Entrez une catégorie valide.";
    } else{
        $categorie = $input_categorie;
    }
    
    // Check input errors before inserting in database
    if(empty($titre_err) && empty($contenu_err) && empty($categorie_err)){
        // Prepare an update statement
        $sql = "UPDATE Article SET titre=?, contenu=?, categorie=? WHERE id=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssi", $param_titre, $param_contenu, $param_categorie, $param_id);
            
            // Set parameters
            $param_titre = $titre;
            $param_contenu = $contenu;
            $param_categorie = $categorie;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../principale.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Preparation du statement
        $sql = "SELECT * FROM Article WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $titre = $row["titre"];
                    $contenu = $row["contenu"];
                    $categorie = $row["categorie"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
               echo "Oops! Something went wrong. Please try again later.";
              
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Modifier l'article</h2>
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $titre; ?>">
                            <span class="invalid-feedback"><?php echo $titre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contenu</label>
                            <textarea name="contenu" class="form-control <?php echo (!empty($contenu_err)) ? 'is-invalid' : ''; ?>"><?php echo $contenu; ?></textarea>
                            <span class="invalid-feedback"><?php echo $contenu_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Catégorie</label>
                            <input type="text" name="categorie" class="form-control <?php echo (!empty($categorie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $categorie; ?>">
                            <span class="invalid-feedback"><?php echo $categorie_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Modifier">
                        <a href="../principale.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
