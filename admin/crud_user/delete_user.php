<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "../config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM utilisateur WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variable 
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: ../utilisateur.php");
            exit();
        } else{
            echo "Oops! une erreur est survenue, veuillez réessayer plus tard s'il vous plait.";
        }
    }
     
    // Close statement
    $stmt->close();
    
   
    $mysqli->close();
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
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
    <title>Suppression</title>
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
                    <h2 class="mt-5 mb-3">Supprimer l'utilisateur</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Êtes-vous sûr(e) de  bien vouloir supprimer cet utlisateur?</p>
                            <p>
                                <input type="submit" value="Oui" class="btn btn-danger">
                                <a href="../utlisateur.php" class="btn btn-secondary ml-2">Non</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
