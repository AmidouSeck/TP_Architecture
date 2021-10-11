<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<?php
    // get the database handler
    $dbengine   = 'mysql';
            $dbhost     = 'localhost';
            $dbuser     = 'mglsi_user';
            $dbpassword = 'passer';
            $dbname     = 'mglsi_news';
    $dbh = new PDO("".$dbengine.":host=$dbhost; dbname=$dbname", $dbuser,$dbpassword);; // function created in dbconnect, remember?
    // Fecth news
    include_once('/Applications/MAMP/htdocs/Tp Architecture/includes/functions.php');
    $news = fetchNews($dbh);
    $categories = getCategories($dbh);
    //ini_set('display_errors', 'on');
    //var_dump($categories);
?>
<div class="header">
<a href="login.php" style="float: right; background-color:white; padding:10px; border-radius: 10px; font-size:medium">
Se connecter
</a>
  <h1>MGLSI NEWS</h1>
  <div class="shine">
  <p class="pshine">Site d'actualités de mglsi <br><a href="https://codepen.io/grohit/">mglsinews.com</a></p>
  </div>
  
</div>


<div class="categorie">
<div class="column">
  <div class="card-header"><h2>Catégories</h2></div>
<div class="card">
      <h2>
        <a href="index.php">Tout</a>
      </h2>
    </div>
<?php if ( $categories && !empty($categories) ) :?>

<?php foreach ($categories as $key => $type) :?>

  
    <div class="card">
    <h2><a href="read-categories.php?id=<?= $type['id'] ?>"><?= stripslashes($type['libelle']) ?></a></h2>
    </div>
  

<?php endforeach?>
<?php endif?>
</div>
</div>

<?php if ( $news && !empty($news) ) :?>

<?php foreach ($news as $key => $article) :?>
    <div class="columns">
<h2><a href="read-news.php?id=<?= $article['id'] ?>"><?= stripslashes($article['titre']) ?></a></h2>
<p><?= stripslashes($article['contenu']) ?></p>
<div> <span class="badge">publié le <?= dateToFrench($article['dateCreation'], "l j F Y") ?> par <?= stripslashes($article['id']) ?></span></div>
</div>
<?php endforeach?>
<?php endif?>



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
  width: 80%;
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
  width: 70%;
  margin: 8px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  background-color: #f1f1f1;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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

.shine {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100px;
  background: #428bca;
}

.pshine {
  font-weight: 700;
  text-align: center;
  font-size: 40px;
  font-family: Hack, sans-serif;
  text-transform: uppercase;
  background: linear-gradient(90deg, #000, #fff, #000);
  letter-spacing: 5px;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  background-repeat: no-repeat;
  background-size: 80%;
  animation: shine 5s linear infinite;
  position: relative;
}

@keyframes shine {
  0% {
    background-position-x: -500%;
  }
  100% {
    background-position-x: 500%;
  }
}

/*  Checkout my other pens on  https://codepen.io/grohit/  */


</style>