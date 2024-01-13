<?php
session_start();
echo "
<html>
<head>
    <title>Liste des employés</title>
    <style>
    body{
      background-image: url(../img/gggg.jpg);
      background-size: cover;
      background-position: top center;
  }
  .tableau {
      border-collapse: collapse;
      width: 100%;
  }
    
  .tableau th, .tableau td {
      border: 1px solid #ccc;
      padding: 10px;
  }
    
  .tableau th {
      background-color: black;
      font-weight: bold;
      text-align: left;
      color: #fff;
  }
    
  .tableau tr:nth-child(even) {
      background-color: crimson;
      color:#fff;
  }
  
  .tableau tr {
      color:#fff;
  }
    
  .tableau tr:hover {
      background-color: #8e3e4a;
  }
    
  .tableau td:first-child {
      border-left: none;
  }
    
  .tableau td:last-child {
      border-right: none;
  }
    
  .tableau tbody tr:last-child td {
      border-bottom: none;
  }
  
  .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: crimson;
      color: #fff;
      border: none;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      border-radius: 4px;
  }
    
  .button:hover {
      background-color: #ADD8E6;
  }
    
  /* Style de la zone de texte */
  .textbox {
      width: 300px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }
    
  /* Style de l'étiquette */
  .label {
      display: inline-block;
      font-weight: bold;
      margin-bottom: 5px;
      
  }

  html, body {
      height: 100%;
      margin: 5;
      top:10px;
  }
    
  .container {
      
      justify-content: space-between;
      align-items: center;
  }
    
  .button,
  .textbox
   {
      margin-bottom: 10px;
  }
      h1{text-align: center;}
      </style>
    <script language=javascript>
    function Recherche(criter){
        tab=document.getElementById('Liste');

        for(i=1;i<tab.rows.length;i++)
        {
            tab.rows[i].style.display='none';
        }
        if(criter=='')
        {
            for(i=1;i<tab.rows.length;i++)
            {
            tab.rows[i].style.display='table-row';
            }
        }
        else
        {
            for(i=1;i<tab.rows.length;i++)
            {
            if(
                tab.rows[i].cells[0].innerHTML.toLowerCase().includes(criter.toLowerCase())
                || tab.rows[i].cells[1].innerHTML.toLowerCase().includes(criter.toLowerCase())
                || tab.rows[i].cells[2].innerHTML.toLowerCase().includes(criter.toLowerCase())
                || tab.rows[i].cells[3].innerHTML.toLowerCase().includes(criter.toLowerCase())
                )
                {
                    tab.rows[i].style.display='table-row';
                }
            }
        }
    }
    </script>
</head>
<body>
<div><h1>Solde De Mois Est : <span>".$_SESSION['soldems']."</span></h1></div>
<label class='label'><b>Recherche<b></label>
<input type='text' name='txtrecherche' class='textbox'
oninput='Recherche(this.value)'>
<div style='right:0 psition:absolute;' class='container'>
<input type='button' name='btnHom' class='button'
onclick=\"window.location= '../html/index.html';\" value='Home'>
<input type='button' name='btnNouveau' class='button'
onclick=\"window.location= 'play.php';\" value='Ajouter un Opération'>
<input type='button' name='btnNouveau' class='button'
id='btnExport' value='Impprimer'>
</div>   
<br>
<br>
<table id='Liste' class='tableau'>
    <tr>
        <th>Solde De Mois</th>
        <th>Mois</th>
        <th>Ans</th>
        <th>DateOp</th>
    </tr>";
    if (!isset($_SESSION['montant'])) {
        // Set session['montant'] to 0
        $_SESSION['montant'] = 0;
      }
      
      if (!isset($_SESSION['Tarif'])) {
        // Set session['montant'] to 0
        $_SESSION['Tarif'] = 0;
      }
//***************************************
// connection a la base de données
//***************************************
$servername="localhost";//nom de serveur mysql
$username="root"; //le nom d utilisaeur mysql
$password="";  //le mdp pour connecterau serveur
$dbname="gaming";  //nom de la base de donees
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("connection non établie : ".$conn->connect_error);
}
$conn->set_charset("utf8");

    $sql="select * from ms ";
    $resultat=$conn->query($sql);
    $nb=mysqli_num_rows($resultat);

        
        while ($row=$resultat->fetch_assoc()) {
            echo"<tr>
            <td>".htmlspecialchars($row['SoldeMs']).'</td>'.
            '<td>'.htmlspecialchars($row['Mois']).'</td>'.
            '<td>'.htmlspecialchars($row['Ans']).'</td>'.
            '<td>'.htmlspecialchars($row['DateOp']).'</td></tr>' ?>
            
            
           <?php
        }
        
      
      $conn->close();
  
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script type="text/javascript">
    $("body").on("click", "#btnExport", function () {
        // Ajout du style CSS pour le fond noir
        $('#Liste').css('background-color', '#000000'); // Couleur de fond noire

        html2canvas($('#Liste')[0], {
            scale: 2, // Augmentation de la résolution de capture
            useCORS: true, // Autoriser l'utilisation des ressources externes
            allowTaint: true, // Autoriser les ressources croisées (cross-origin)

            onrendered: function (canvas) {
                var data = canvas.toDataURL("image/jpeg", 1.0); // Utilisation du format JPEG avec une qualité maximale

                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }],
                    compress: true, // Activer la compression du fichier PDF
                    optimization: {
                        quality: 0.8 // Définir la qualité du fichier PDF (entre 0 et 1)
                    }
                };

                pdfMake.createPdf(docDefinition).download("pdfFile.pdf");

                // Restauration du style CSS initial
                $('#Liste').css('background-color', ''); // Réinitialiser la couleur de fond
            }
        });
    });
</script>