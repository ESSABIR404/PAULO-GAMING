
<?php




class personne 
{
  // Properties
  public $Email;
  public $Objet;
  public $Message;

  // GET SET de id
  
  
  // GET SET de nom
  
  // GET SET de Email
  function set_Email($Email) 
  {
	  if($this->verifMail($Email)==true)
	  {
    $this->Email = $Email;
	  }
  }
  function get_Email()
  {
    return $this->Email;// 
  }
  // GET SET de telephone
  
  function set_Objet($N) 
  {
    $this->Objet = $N;
  }
  function get_Objet()
  {
    return $this->Objet;
  }
  function set_Message($N) 
  {
    $this->Message = $N;
  }
  function get_Message()
  {
    return $this->Message;
  }
  // methode de comparaison  de deux tableaux de caractères 
  function compare($T1, $T2)
  {
	  for($i=0; $i<count($T1); $i++)
	  {
		  for($j=0; $j<count($T2); $j++)
	  {
		  if($T1[$i]==$T2[$j])
			  {
				  return true;
			  }
	  }
	  }
	   // methode de verification de l'mail 
  }
 
  function verifMail($mail)
  {
  $carspecial="&é\(-è _çà)=+/\[|^]°{}+%*µ><:;,!£¤¨^?\"'\$";
  $TM=str_split($mail);
   $TC=str_split($carspecial);
   
	  if(strpos($mail,'@')==0 // @ à la première position
		  ||strpos($mail,'.')==0 // @ à la première position
		  ||strrpos($mail,'@')==strlen($mail)-1 // @ à la dérnière position
		  || substr_count($mail, '@')>1 // si l'email contient plus qu'un @
		  ||substr_count($mail, '@')==0 // si l'email ne contient aucun @
		  ||strrpos($mail,'.')==strlen($mail)-1 // . à la dérnière position
		  || strrpos($mail,'.')<strrpos($mail,'@')// si le dernier . est avant @
		  || substr_count($mail, '.@')>0 
		  || substr_count($mail, '@.')>0 
		  || $this->compare($TM, $TC)==true)	  
		  
		  {
			return false;
		  }
		  else
		  {
			return true;  
		  }
	  
  }
  
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpMiler/Exception.php';
require '../phpMiler/PHPMailer.php';
require '../phpMiler/SMTP.php';

//--------TEST UNITAIRE----------
 if ( isset( $_POST['btnenvoye'] ) )
	 {
	$employe = new personne();
	 
  $employe->set_Objet($_POST["txtobjet"]);
  $employe->set_Message($_POST["txtmessage"]);

 




  //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


//Server settings
$mail->isSMTP();                                            //Send using SMTP

$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through

$mail->SMTPAuth   = true;                                   //Enable SMTP authentication

$mail->Username   = 'essabir02yassine@gmail.com';                     //SMTP username
$mail->Password   = 'fqsgqogvzjpomnov';                               //SMTP password
$mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
$mail->Port       = "587";       

$mail->CharSet="utf-8";
//Recipients
$mail->setFrom('essabir02yassine@gmail.com');

$mail->addAddress('yassine1greenboys@gmail.com');               //Name is optional



//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject=$employe->get_Objet();


    $message = $employe->get_Message();

$mail->Body=$message;

if( $mail->send()){

    header('Status:301 Moved Permanently',false,301);
    header('Location:../html/index.html');
    exit();
  
}
else{
    echo"erreur";
}

 

    
}






    
?>
