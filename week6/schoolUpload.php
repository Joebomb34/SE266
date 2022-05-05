<?php

    include_once __DIR__ . '\model\Schools.php';

    include_once __DIR__ . '\include\functions.php';

   // Set up configuration file and create database
    $configFile = __DIR__ . '\model\dbconfig.ini';
    try 
    {
        $schoolDatabase = new Schools($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    } 

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

   
    //define the upload directory
    define("UPLOAD_DIRECTORY", "upload");

    if (isset ($_FILES['fileToUpload'])) 
    {

        $path = getcwd() . DIRECTORY_SEPARATOR . UPLOAD_DIRECTORY;
        
        
        //grab the file name of the file that was stored on the server
        $tmpName = $_FILES['fileToUpload']['tmp_name'];
        
        //concatinating the filename that was uploaded to out path
        $targetFilename = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        //moving the uploaded file to the place i will access it from
        move_uploaded_file($tmpName, $targetFilename);
        
        $schoolFile = $schoolDatabase->insertSchoolsFromFile($targetFilename);

    }

    include_once __DIR__ . "\include\header.php"; 

?>  
    <h2>Upload File</h2>
    <p>
        Please specify a file to upload and then be patient as the upload may take a while to process.
    </p>

    <form action="schoolUpload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload">
            

    </form>    

<?php
    //  If $_FILES['fileToUpload'] is set, we were successful in uploading the file
if (isset ($_FILES['fileToUpload'])) {
    echo "<h2>File successfully uploaded! 😀</h2>";

    header ('Location: schoolSearch.php');
}
?>


<?php
    include_once __DIR__ . '\include\footer.php';
?>