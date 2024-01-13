
<?php
class Operation 
{
  // Properties
  public $Poste;
  public $Nombre;
  public $Jeux;
  public $Nature;
  public $Play;
  public $DateOp;
  public $Tarif;



  function set_Poste($Poste) 
  {
    $this->Poste = $Poste;
  }
  function get_Poste()
  {
    return $this->Poste;
  }
  

  function set_Nombre($Nombre) 
  {
    $this->Nombre = $Nombre;
  }
  function get_Nombre()
  {
    return $this->Nombre;
  }


  function set_Jeux($Jeux) 
  {
    $this->Jeux = $Jeux;
  }
  function get_Jeux()
  {
    return $this->Jeux;
  }
  
  function set_Nature($Nature) 
  {
	  
    $this->Nature = $Nature;
	  
  }
  function get_Nature()
  {
    return $this->Nature;
  }

  function set_Play($Play) 
  {
	  $this->Play=$Play ;
  }
 
  function get_Play()
  {
    return $this->Play;
  }
  
  function set_DateOp($DateOp) 
  {
    $this->DateOp = $DateOp;
	
  }
  function get_DateOp()
  {
    return $this->DateOp;
  
  }

  function set_Tarif($Tarif) 
  {
    $this->Tarif = $Tarif;
	
  }
  function get_Tarif()
  {
    return $this->Tarif;
  
  }
}
   class Jr
   {
    public $SoldeJr;
    public $Jour;
    public $Mois;
    public $DateOpJr;


    function set_SoldeJr($SoldeJr) 
  {
	  
    $this->SoldeJr = $SoldeJr;
	  
  }
  function get_SoldeJr()
  {
    return $this->SoldeJr;
  }

  function set_Jour($Jour) 
  {
	  $this->Jour=$Jour ;
  }
 
  function get_Jour()
  {
    return $this->Jour;
  }
  
  function set_Mois($Mois) 
  {
    $this->Mois = $Mois;
	
  }
  function get_Mois()
  {
    return $this->Mois;
  
  }

  function set_DateOpJr($DateOpJr) 
  {
    $this->DateOpJr = $DateOpJr;
	
  }
  function get_DateOpJr()
  {
    return $this->DateOpJr;
  
  }
   }
   class Ms
   {
    public $SoldeMs;
    public $MoisMS;
    public $Ans;
    public $DateOpMs;

    function set_SoldeMs($SoldeMs) 
  {
	  
    $this->SoldeMs = $SoldeMs;
	  
  }
  function get_SoldeMs()
  {
    return $this->SoldeMs;
  }

  function set_Ans($Ans) 
  {
	  $this->Ans=$Ans ;
  }
 
  function get_Ans()
  {
    return $this->Ans;
  }
  
  function set_MoisMs($MoisMs) 
  {
    $this->MoisMs = $MoisMs;
	
  }
  function get_MoisMs()
  {
    return $this->MoisMs;
  
  }

  function set_DateOpMs($DateOpMs) 
  {
    $this->DateOpMs = $DateOpMs;
	
  }
  function get_DateOpMs()
  {
    return $this->DateOpMs;
  
  }
   }
session_start();


if ( isset( $_POST['btnEng'] ) )
	 {
	$Jr = new Jr();
	 
	$Jr->set_SoldeJr($_SESSION['montant']);
	$Jr->set_Jour(date('d'));
	$Jr->set_Mois(date('m'));
	$Jr->set_DateOpJr(date('d/m/Y H:i:s'));

  $Ms = new Ms();
  $Ms->set_SoldeMs($_SESSION['soldems']);
	$Ms->set_MoisMs(date('m'));
	$Ms->set_Ans(date('Y'));
	$Ms->set_DateOpMs(date('d/m/Y H:i:s'));

  $servername="localhost";//nom de serveur mysql
$username="root"; //le nom d utilisaeur mysql
$password="";  //le mdp pour connecterau serveur
$dbname="gaming";  //nom de la base de donees
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

    
    $sql="select count(*) from Jr 
    where Jours=".$Jr->get_Jour()." and Mois=".$Jr->get_Mois();
    $sth = $conn->prepare($sql);
    $sth->execute();
    $nb=$sth->fetchColumn();

    if($nb!=0) //si la date existe déja
    {
      $error = " solde de Cette Jour a déjà été enregistré. ";
    }
    else{

        $sql="insert into Jr (SoldeJr,Jours,Mois,DateOp)
        values
        (".$Jr->get_SoldeJr().",
        '".$Jr->get_Jour()."',
        '".$Jr->get_Mois()."',
        '".$Jr->get_DateOpJr()."')";
        $conn->exec($sql);
        $_SESSION['montant']=0;
        $_SESSION['Tarif']=0;

      $timestamp = strtotime($Jr->get_DateOpJr());
      $dernierJourMois = date("t", $timestamp);
      $mois = date("m", $timestamp);
      $annee = date("Y", $timestamp);
      
      $dateFinMois = date("Y-m-d", mktime(0, 0, 0, $mois, $dernierJourMois, $annee));
      
        // Vérifier si la date donnée est égale à la fin du mois
        if ($Jr->get_DateOpJr() == $dateFinMois) {
            // Action spécifique à effectuer si la date est la fin du mois
            // Ajoutez votre code ici
            $sql="insert into ms (SoldeMs,Mois,Ans,DateOp)
            values
            (".$Ms->get_SoldeMs().",
            '".$Ms->get_MoisMs()."',
            '".$Ms->get_Ans()."',
            '".$Ms->get_DateOpMs()."')";
            $conn->exec($sql);
            $_SESSION['soldems']=0;
        }
        else{
          $error = " solde de Cette Mois a déjà été enregistré. ";
              }
              $error = " solde de Cette Jour enregistré avec succeé. ";
      }

     
    }
      catch(PDOException $e){
          echo "connecion failed: ".$e->getMessage();
      }
      
      $conn=null;
    
}
//--------TEST UNITAIRE----------
 if ( isset( $_POST['btnAjouter'] ) )
	 {
	$Op = new Operation();
	 
	$Op->set_Poste($_POST["poste"]);
	$Op->set_Nombre($_POST["nombre"]);
	$Op->set_Jeux($_POST["jeux"]);
	$Op->set_Nature($_POST["nature"]);
	$Op->set_Play($_POST["play"]);
	$Op->set_DateOp(date('d/m/Y H:i:s'));

  $play=$Op->get_Play();
  $jeux=$Op->get_Jeux();
  $nature=$Op->get_Nature();
  $nombre=$Op->get_Nombre();

  
  if($play=="Playstation4"){
    if($jeux=="fifa" || $jeux=="pro" || $jeux="Autre"){
      if($nature=="1H"){
        $op= $nombre * 12 ;
      }
      if($nature=="30min"){
        $op= $nombre * 6 ;
      }
    }
    if($jeux=="fifa"){
      if($nature=="match5"){
        $op= $nombre * 3 ;
      }
      if($nature=="match6"){
        $op= $nombre * 4 ;
      }
      if($nature=="match7"){
        $op= $nombre * 5 ;
      }
      if($nature=="match10"){
        $op= $nombre * 6 ;
      }
    }
    if($jeux=="pro"){
      if($nature=="match5"){
        $op= $nombre * 2 ;
      }
      if($nature=="match6"){
        $op= $nombre * 3 ;
      }
      if($nature=="match7"){
        $op= $nombre * 4 ;
      }
      if($nature=="match10"){
        $op= $nombre * 5 ;
      }
    }
 
}
$Op->set_Tarif($op);


$servername="localhost";//nom de serveur mysql
$username="root"; //le nom d utilisaeur mysql
$password="";  //le mdp pour connecterau serveur
$dbname="gaming";  //nom de la base de donees
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

    $sql="insert into Op (Tarif,Poste,Nombre,Jeux,Nature,Play,DateOp)
        values
        (".$Op->get_Tarif().",
        '".$Op->get_Poste()."',
        '".$Op->get_Nombre()."',
        '".$Op->get_Jeux()."',
        '".$Op->get_Nature()."',
        '".$Op->get_Play()."',
        '".$Op->get_DateOp()."')";
        $conn->exec($sql);
  



// Début de la session

// Initialisation d'une variable de session
$_SESSION['Tarif'] = $Op->get_Tarif() ;

  $montant = $_SESSION['Tarif'];

  // Mettre à jour la variable de session avec le montant augmenté
  if (isset($_SESSION['montant'])) {
    $_SESSION['montant'] += $montant;
  } else {
    $_SESSION['montant'] = $montant;
  }
  if (isset($_SESSION['montant'])){
  $_SESSION['soldems'] += $_SESSION['montant'];}
}
catch(PDOException $e){
    echo "connecion failed: ".$e->getMessage();
}

$conn=null;
}

if (isset($_SESSION['montant'])) {
  $_SESSION['montant'] =  $_SESSION['montant'] ;
}
if ( isset( $_POST['btnliste'] ) ){
        header('Status:301 Moved Permanently',false,301);
        header('Location:listeOp.php');
        exit();
}
if ( isset( $_POST['btnQuitter'] ) ){
  header('Status:301 Moved Permanently',false,301);
  header('Location:../html/index.html');
  exit();
}

if (!isset($_SESSION['montant'])) {
  // Set session['montant'] to 0
  $_SESSION['montant'] = 0;
}

if (!isset($_SESSION['Tarif'])) {
  // Set session['montant'] to 0
  $_SESSION['Tarif'] = 0;
}

if (!isset($_SESSION['soldems'])) {
  // Set session['montant'] to 0
  $_SESSION['soldems'] = 0;
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
    <h1><span>P</span>LAY </h1>
    <form action="" method="post">
    <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
      <label for="poste">Poste :</label>
      <select name="poste" id="poste">
        <option value="poste1">Poste1</option>
        <option value="poste2">Poste2</option>
        <option value="poste3">Poste3</option>
        <option value="poste4">Poste4</option>
        <option value="poste5">Poste5</option>
      </select>

      <label for="nombre">Nombre d'heures de jeu :</label>
      <input type="text" name="nombre" id="nombre" class="nombre">

      <label for="jeux">Jeux :</label>
      <select name="jeux" id="jeux">
        <option value="fifa">Fifa</option>
        <option value="pro">Pro</option>
        <option value="autre">Autre</option>
      </select>

      <label for="nature">Nature du jeu :</label>
      <select name="nature" id="nature">
        <option value="match5">Match 5 Min</option>
        <option value="match6">Match 6 Min</option>
        <option value="match7">Match 7 Min</option>
        <option value="match10">Match 10 Min</option>
        <option value="1H">1H</option>
        <option value="30min">30Min</option>
      </select>

      <label for="play">Type de joueur :</label>
      <select name="play" id="play">
        <option value="Playstation4">Playstation4</option>
      </select>

      <div class="button-group">
        <button class="add-button" name="btnAjouter">Ajouter</button>
        <button class="liste-button" name="btnliste">Afficher La liste</button>
        <button class="home-button" name="btnQuitter">Quitter</button>
        <button class="save-button" name="btnEng">Enregistrer</button>
      </div>
    </form>
    <div class="tarif">
  <p> Tarif D'operation est :<span><?php echo $_SESSION['Tarif']; ?></span> DH</p>
  </div>
    <div class="montant">
  <p> Solde De Jour est :<span><?php echo $_SESSION['montant']; ?></span> DH</p>
  </div>
  </div>

</body>
</html>
