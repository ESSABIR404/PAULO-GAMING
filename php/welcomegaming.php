<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url(../img/go.jpg);

   
        }
        
.header-container {
    height: 20px;
    display: flex;
    align-items: center;
    cursor: pointer;
  transition: width 0.11s ease-in-out;

    
}
.header-container:hover {
    height: 150px;

}
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: rgba(0, 0, 9, 0.5);
}

nav ul li a:hover {
    background-color: rgba(0, 0, 0, 0.7);
}
        .image-container {
            
            justify-content: space-between;
        }
        
        .image-container img {
            
            max-width: 400px;
            height: auto;
        }
    
        .image img{
    border-radius: 10px;
}
.image{
    display: inline-block;
    padding: 50px; 
}
.image h4{
    font-size: xx-large;
    color: antiquewhite;
    margin-left: 130px;
}
.button-container{
    padding-top:20px;
}
    </style>
</head>
<body>
    <header>
    <div class="header-container">
      <div class="button-container">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href=../html/index.html>Play</a></li>
                <li><a href="#">Charge</a></li>
                <li><a href="#">Jour</a></li>
                <li><a href="#">Mois</a></li>
                <li><a href="#">Archive</a></li>
            </ul>
        </nav>
        </div>
    </div>
    </header>
    <div class="image-container">
        <div class="image">
        <img src="../img/g.jpg" alt="Image 1">
       <h4>Home</h4>
        </div>
        <div class="image">
        <img src="../img/gg.jpg" alt="Image 2">
        <h4>Play</h4>
        </div>
        <div class="image">
        <img src="../img/ggg.jpg" alt="Image 3">
        <h4>Charge</h4>
        </div>
        <div class="image">
        <img src="../img/gggg.jpg" alt="Image 4">
        <h4>Jour</h4>
        </div>
        <div class="image">
        <img src="../img/gg.jpg" alt="Image 5">
        <h4>Mois</h4>
        </div>
    </div>
</body>
</html>