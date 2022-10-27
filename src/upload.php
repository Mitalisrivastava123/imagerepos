<?php 
session_start();

if(!isset($_SESSION["images"]))
{
    $_SESSION["images"]=[];
}

?>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<?php
if(isset($_POST["submit"]))
{
    array_push($_SESSION["images"],$target_file);
}
if(isset($_POST["sessiondestroy"]))
{
  $_SESSION["images"]=[];
}
// print_r($_SESSION["images"]);

echo "<h3>Image Gallery</h3>";
echo "<p> This page displays the list of uploaded images</p>";
echo "<table border='1px'>";
foreach($_SESSION["images"] as $k => $v)
{

  echo '<tr><img src="'.$_SESSION["images"][$k].'"></tr>';
 


}

echo "</table>";


?>