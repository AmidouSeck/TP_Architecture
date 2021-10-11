<?php 
    require __DIR__.'/../config/dbconnect.php'; 

    function fetchNews( $conn )
    {

        $request = $conn->prepare(" SELECT id, titre, contenu, dateCreation FROM Article ORDER BY dateCreation DESC ");
        return $request->execute() ? $request->fetchAll() : false; 
    }

    function getAnArticle( $id_article, $conn )
    {

        $request =  $conn->prepare(" SELECT id,  titre, contenu, dateCreation FROM Article  WHERE id = ? ");
        return $request->execute(array($id_article)) ? $request->fetchAll() : false; 
    }

    function getCategories( $conn )
    {
        $request =  $conn->prepare(" SELECT id, libelle FROM Categorie ");
        return $request->execute() ? $request->fetchAll() : false; 
    }

    function getACategorie( $id_categorie, $conn )
    {
        $request =  $conn->prepare(" SELECT id,  titre, contenu, dateCreation FROM Article  WHERE categorie = ? ");
        return $request->execute(array($id_categorie)) ? $request->fetchAll() : false; 
    }
    
    function dateToFrench($date, $format) 
    {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
    }
?>