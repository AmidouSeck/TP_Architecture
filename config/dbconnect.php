
<?php
        $pdo = null;
        function connect_to_db()
        {
            $dbengine   = 'mysql';
            $dbhost     = 'localhost';
            $dbuser     = 'mglsi_user';
            $dbpassword = 'passer';
            $dbname     = 'mglsi_news';

            try{
                $pdo = new PDO("".$dbengine.":host=$dbhost; dbname=$dbname", $dbuser,$dbpassword);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
         
       return $pdo;
            }  
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        ?>        
