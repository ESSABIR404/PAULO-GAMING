<?php
session_start();
class Ch
{
 public $SoldeCh;
 public $MoisCh;
 public $AnsCh;
 public $DateOpCh;

 function set_SoldeCh($SoldeCh) 
{
   
 $this->SoldeCh = $SoldeCh;
   
}
function get_SoldeCh()
{
 return $this->SoldeCh;
}

function set_AnsCh($AnsCh) 
{
   $this->AnsCh=$AnsCh ;
}

function get_AnsCh()
{
 return $this->AnsCh;
}

function set_MoisCh($MoisCh) 
{
 $this->MoisCh = $MoisCh;
 
}
function get_MoisCh()
{
 return $this->MoisCh;

}

function set_DateOpCh($DateOpCh) 
{
 $this->DateOpCh = $DateOpCh;
 
}
function get_DateOpCh()
{
 return $this->DateOpCh;

}
}

if ( isset( $_POST['btnEng'] ) )
	 {
        $Ch = new Ch();
	 
	$Ch->set_SoldeCh($_SESSION['charge']);
	$Ch->set_MoisCh(date('m'));
	$Ch->set_AnsCh(date('Y'));
	$Ch->set_DateOpCh(date('d/m/Y H:i:s'));



  $servername="localhost";//nom de serveur mysql
$username="root"; //le nom d utilisaeur mysql
$password="";  //le mdp pour connecterau serveur
$dbname="gaming";  //nom de la base de donees
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

    
    $sql="select count(*) from ch 
    where  Mois=".$Ch->get_MoisCh();
    $sth = $conn->prepare($sql);
    $sth->execute();
    $nb=$sth->fetchColumn();

    if($nb!=0) //si la date existe déja
    {
      $error = " solde Charge de Cette Mois a déjà été enregistré. ";
    }
    else{
      $timestamp = strtotime(date('d/m/Y H:i:s'));
      $dernierJourMois = date("t", $timestamp);
      $mois = date("m", $timestamp);
      $annee = date("Y", $timestamp);
      
      $dateFinMois = date("Y-m-d", mktime(0, 0, 0, $mois, $dernierJourMois, $annee));
      
        // Vérifier si la date donnée est égale à la fin du mois
        if ($Ch->get_DateOpCh() == $dateFinMois) {
            // Action spécifique à effectuer si la date est la fin du mois
            // Ajoutez votre code ici
            $sql="insert into ch (SoldeCh,Mois,Ans,DateOp)
            values
            (".$Ch->get_SoldeCh().",
            '".$Ch->get_MoisCh()."',
            '".$Ch->get_AnsCh()."',
            '".$Ch->get_DateOpCh()."')";
            $conn->exec($sql);
            $_SESSION['charge']=0;
        }
        else{
          $error = " c'est pas la fin de mois. ";
              }
      }

     
    }
      catch(PDOException $e){
          echo "connecion failed: ".$e->getMessage();
      }
      
      $conn=null;
    
}



if (!isset($_SESSION['charge'])) {
    // Set session['montant'] to 0
    $_SESSION['charge'] = 0;
  }
  if ( isset( $_POST['btnQuitter'] ) ){
    header('Status:301 Moved Permanently',false,301);
    header('Location:../html/index.html');
    exit();
  }
  if ( isset( $_POST['btnAjouter'] ) )
	 {
       
	 
	$elec=($_POST["elec"]);
	$location=($_POST["location"]);
	$wifi=($_POST["wifi"]);
	$autrecharge=($_POST["autrecharge"]);

    $T=$elec+$location+$wifi+$autrecharge;


    if (isset($_SESSION['charge'])) {
        $_SESSION['charge'] += $T;
      } else {
        $_SESSION['charge'] = $T;
    
    }


}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculateur de prix de durée de jeu vidéo</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url(../img/gggg.jpg);
    background-size: cover;
    background-position: top center;
    position: relative;
    z-index: -1;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    .form-container {
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      animation: fade-in 0.5s ease-in-out;
      width: 500px;
      background-color: rgba(0, 0, 0, 0);
    }

    

    .form-container label {
      display: block;
      margin-bottom: 20px;
    }

    
    .form-container select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    .form-container input[type="text"]{
      width: 96.5%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    .form-container input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
      background-color: #45a049;
    }

    .form-container .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .form-container .button-group button {
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-container .button-group button.add-button {
      background-color: crimson;
      color: #fff;
    }

    .form-container .button-group button.save-button {
      background-color: crimson;
      color: #fff;
    }
    .form-container .button-group button.liste-button {
      background-color: crimson;
      color: #fff;
    }
    .form-container .button-group button.home-button {
      background-color: crimson;
      color: #fff;
    }
    .montant {
      margin-top: 20px;
      
     
    }
    .tarif{
      margin-top: 20px;
    }
    h1{
      text-align: center;
      
    }
    span{
      color: crimson;
    }
    .error {
            color: red;
            margin-bottom: 15px;
            text-align:center;
        }
  </style>
</head>
<body>
  <div class="form-container">
    <h1><span>C</span>HARGE </h1>
    <form action="" method="post">
    <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
      <label for="elec">éléctricité :</label>
      <input type="text" name="elec" value="0">

      <label for="location">Location :</label>
      <input type="text" name="location" id="location" class="location" value="0">

      <label for="wifi">Wifi :</label>
      <input type="text" name="wifi" id="wifi" class="wifi" value="0">

      <label for="autrecharge">Autre Charge :</label>
      <input type="text" name="autrecharge" id="autre" class="autre" value="0">


      <div class="button-group">
        <button class="add-button" name="btnAjouter">Ajouter</button>
        <button class="liste-button" name="btnliste">Afficher La liste</button>
        <button class="home-button" name="btnQuitter">Quitter</button>
        <button class="save-button" name="btnEng">Enregistrer</button>
      </div>
    </form>
    <div class="charge">
  <p> Charge De Mois :<span><?php echo $_SESSION['charge']; ?></span> DH</p>
  </div>

</body>
</html>