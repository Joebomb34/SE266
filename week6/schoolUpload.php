<?php
   include_once __DIR__ . '\model\Schools.php';
   include_once __DIR__ . '\include\functions.php';

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    //define the upload directory
    define("UPLOAD_DIRECTORY", "upload");

    if (isset ($_FILES['fileToUpload'])) 
    {

        $path = getcwd() . DIRECTORY_SEPARATOR . UPLOAD_DIRECTORY;

        //concatinating the filename that was uploaded to out path
        $targetFilename = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        //grab the file name of the file that was stored on the server
        $tmpName = $_FILES['fileToUpload']['tmp_name'];

        //moveing the uploaded file to the place i will access it from
        move_uploaded_file($tmp_name, $targetFilename);

        //redirect to schoolSearch.php
        header ('Location: schoolSearch.php');

        //*******************************************************************//
        //************     TODO     *****************************************//
        // 
        // upload the file to "upload" directory and then call insertSchoolsFromFile 
        //      *** Make sure that the upload directory is writeable!
        //
        // redirect to search.php
        //
        //*******************************************************************//

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
}
?>


<?php
    include_once __DIR__ . '\include\footer.php';
?>