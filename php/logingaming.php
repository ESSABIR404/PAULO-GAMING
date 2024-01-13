<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les informations de connexion
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations de connexion dans la base de données
    $sql = "SELECT * FROM Utilisateurs WHERE UserName = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Démarrer la session et stocker le nom d'utilisateur
        session_start();
        $_SESSION['username'] = $username;

        // Redirection vers la page de bienvenue
        header("Location: ../html/index.html");
        exit();
    } else {
        // Message d'erreur en cas d'informations de connexion incorrectes
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>

        body {
            background-image: url(../img/gggg.jpg);
            background-size: cover;
            background-position:  center;
            background-attachment:fixed;
 
    
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    margin: 0;
    padding: 0;
    
    
}

.container {
    
    flex-direction:column;
    max-width: 400px;
    margin: 80px auto;
    padding: 70px;
    border-radius: 15px;
    text-align: center;
    border-top-left-radius: 8px;
            border-top-right-radius:  8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    
    

}


.error {
    color: red;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 15px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 25px;
    border: 1px;
    border-radius: 30px;
    outline:none;
    font-size: 16px;
    background-color: rgba(0, 0, 0, 0);
}
h4 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    color: #f5f6f7;
}
.btn {
    display: block;
    width: 105%;
    padding: 12px 20px;
    margin-top: 20px;
    border: none;
    border-radius: 30px;
    background-color: crimson;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}
h1{
    color:#fff;
    
    
}
.h{
    margin-left:20px
}
span{
    color:crimson;
}
.btn:hover {
    background-color:  #8e3e4a;
}

    </style>
</head>
<body>
<div class="h">
<h1><span>E</span>SSABIR <span>G</span>AMES</h1>
</div>
    <div class="container">
    
        
        <h1><span>L</span>OGIN</h1>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>
