<?php
// Include config file
//ini_set('display_errors', 'on');
require_once "../config.php";
 
// Define variables and initialize with empty values
$nom_utilisateur = $mot_de_passe = $role = $prenom = $nom =  "";
$nom_utilisateur_err = $mot_de_passe_err = $role_err = $prenom_err = $nom_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate salary
    $input_nom_utilisateur = trim($_POST['nom_utilisateur']);
    if(empty($input_nom_utilisateur)){
        $nom_utilisateur_err = "Entrez le nom d'utilisateur.";     
    } else{
        $nom_utilisateur = $input_nom_utilisateur;
    }

    // Validate salary
    $input_mot_de_passe = trim($_POST["mot_de_passe"]);
    if(empty($input_mot_de_passe)){
        $mot_de_passe_err = "Entrez le mot de passe.";     
    } elseif(!ctype_digit($input_mot_de_passe)){
        $mot_de_passe_err = "Entrez un mote de passe valide.";
    } else{
        $mot_de_passe = $input_mot_de_passe;
    }

    $input_role = trim($_POST["roles"]);
    if(empty($input_role)){
        $role_err = "Entrez le rôle.";
    } else{
        $role = $input_role;
    }

    // Validate name
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Entrez le prénom.";
    } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $prenom_err = "Entrer un prénom valide.";
    } else{
        $prenom = $input_prenom;
    }
    
    // Validate address
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Entrez le nom.";     
    } else{
        $nom = $input_nom;
    }
    
    // Check input errors before inserting in database
    if(empty($nom_utlisateur_err) && empty($mot_de_passe_err) && empty($role_err) && empty($prenom_err) && empty($nom_err)){
        // Prepare an update statement
        $sql = "UPDATE utilisateur SET nom_utilisateur=?, mot_de_passe=?, roles=?, prenom=?, nom=? WHERE id=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nom_utilisateur, $param_mot_de_passe, $param_role, $param_prenom, $param_nom);
            
            // Set parameters
            $param_nom_utilisateur = $nom_utilisateur;
            $param_mot_de_passe = $mot_de_passe;
            $param_role = $role;
            $param_prenom = $prenom;
            $param_nom = $nom;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../utilisateur.php");
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
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM utilisateur WHERE id = ?";
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
                    $nom_utilisateur = $row["nom_utilisateur"];
                    $mot_de_passe = $row["mot_de_passe"];
                    $role = $row["roles"];
                    $prenom = $row["prenom"];
                    $nom = $row["nom"];
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
                    <h2 class="mt-5">Modifier l'utilisateur</h2>
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prenom; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <input name="nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Identifiant</label>
                            <input type="text" name="nom_utilisateur" class="form-control <?php echo (!empty($nom_utilisateur_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom_utilisateur; ?>">
                            <span class="invalid-feedback"><?php echo $nom_utilisateur_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="text" name="mot_de_passe" class="form-control <?php echo (!empty($mot_de_passe_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mot_de_passe; ?>">
                            <span class="invalid-feedback"><?php echo $mot_de_passe_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Rôle</label>
                            <input type="text" name="roles" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
                            <span class="invalid-feedback"><?php echo $role_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Modifier">
                        <a href="../utilisateur.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
