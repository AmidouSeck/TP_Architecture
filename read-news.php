<?php //ini_set('display_errors', 'on');
include_once('/Applications/MAMP/htdocs/Tp Architecture/includes/functions.php'); ?>
<html>
<head>
    <title>Bienvenue</title>
    <!--<link rel="stylesheet" type="text/css" href="design/style.css">-->
</head>
<body> 
    <div class="container">

        <div class="welcome">
            <a href="index.php">Retour à l'accueil</a>
        </div>

        <div class="news-box">

            <div class="news">
                <?php
                //ini_set('display_errors', 'on');
                    // get the database handler
                    $dbh = connect_to_db(); // function created in dbconnect, remember?

                    $id_article = (int)$_GET['id'];

                    if ( !empty($id_article) && $id_article > 0) {
                        //var_dump($id_article);
                        // Fecth news
                        $article = getAnArticle( $id_article, $dbh );
                        $article = $article[0];
                    }else{
                        $article = false;
                        echo "<strong>Wrong article!</strong>";
                    }

                    //$other_articles = getOtherArticles( $id_article, $dbh );

                ?>

                <?php if ( $article && !empty($article) ) :?>
                    <div class="columns">
                <h2><?= stripslashes($article->titre) ?></h2>
                <span>publié le <?= dateToFrench( $article->dateCreation, "l j F Y, H:i") ?> par <?= stripslashes($article->id) ?></span>
                
                   <p><?= stripslashes($article->contenu) ?></p> 
                </div>
            <?php else:?>

                <?php endif?>
                <div class="footer">
            Amidou Seck &copy; <?= date("Y") ?> - Tous droits réservés.
        </div>
            </div>

        </div>

        

    </div>
</body>


<style>
    * {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 100%;
  text-align: center;
  padding: 0 10px;
}

.categorie {
  width: 25%;
  float: right;
  margin-left: 10px;
  margin-top: 15px;
}

.columns {
  float: left;
  width: auto;
  padding: 20px;
  text-align: center;
  margin-left: 20%;
  margin-right: 20%;
  border-radius: 10px;
  color: white;
  margin-top: 10%;
  margin-bottom: 20%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  background-color: #428bca;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.footer {
    width: 100%;
  padding: 20px;
  text-align: center;
  margin: auto;
}
/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}

.card-header {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  text-align: center;
  color: white;
  background-color: #428bca;
}

.header {
  padding: 40px;
  text-align: center;
  background: #428bca;
  color: white;
  font-size: 30px;
}

/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
</style>
</html>