
<!--used layout from the class site folder-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>SE 266 - PHP</title>
<style>

p.a {
  
}


body {
  font-family: "Times New Roman", Times, serif;
  font-size: "16px;";
  margin-left: 20px;
  margin-right: 10px;
}
.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  cursor: pointer;
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.show {
  display: block;
}

li {
  font-family: "Times New Roman", Times, serif;
  font-size: "16px;";
}
</style>
</head>
<body>

<div class="navbar">
  
  <div class="dropdown">
    <button class="dropbtn" onclick="dropDown()">Assignments
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
      <a href="C:\xampp\htdocs\SE266\week1\index.php">Assignment 1</a>
      <a href="C:\xampp\htdocs\SE266\week2.B\index.php">Assignment 2</a>
      <a href="C:\xampp\htdocs\SE266\week3\index.php">Assignment 3</a>
      <a href="../">Assignment 4</a>
      <a href="../">Assignment 5</a>
      <a href="../">Assignment 6</a>
      <a href="../">Assignment 7</a>
      <a href="../">Assignment 8</a>
      <a href="../">Assignment 9</a>
      <a href="../">Assignment 10</a>
    </div>
  </div> 
  <a href="C:\xampp\htdocs\SE266\week2.A\ClassSite\index.php">Home</a>
  <a href="C:\xampp\htdocs\SE266\week2.A\ClassSite\thingsILike.php">Things I Like</a>
  <a href="C:\xampp\htdocs\SE266\week2.A\ClassSite\php_resources.php">PHP Resources</a>
  <a href="C:\xampp\htdocs\SE266\week2.A\ClassSite\github_resources.php">Git Resources</a>
  <a href="https://github.com/Joebomb34/SE266">My GitHub Repo</a>
</div>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropDown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>