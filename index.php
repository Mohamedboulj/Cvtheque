<?php
require_once("./DBConnection.php");
include_once("./Candidat.php");
$db = new mysqli("localhost", "root", "root", "cvtheque");

function init(){
    global $fullname ;
    global $profil ;
    global $resume;
    global $candidat;
    global $content;

$fullname =null;
$profil =null;
// $resume = null;
$candidat = new Candidat();
}

$success = null;
$error = null;
init();
if(isset($_POST['save']) && $_FILES['resume']['size'] > 0){

$fullname =$_POST['fullname'];
$profil =$_POST['profil'];
if (isset($_FILES['resume'])){
   
    var_dump($_FILES['resume']);
    // $filePointer = fopen($_FILES['resume']['tmp_name'], 'r');
    // $fileData = fread($filePointer, filesize($_FILES['resume']['tmp_name']));
    // $fileData = addslashes($fileData);
    $filename = $_FILES['resume']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // // get the file extension
    // $extension = pathinfo($filename, PATHINFO_EXTENSION);

    //  the physical file on a temporary uploads directory on the server
    $file = $_FILES['resume']['tmp_name'];
}

    
if (count($candidat->errorMsg)==0 && move_uploaded_file($file, $destination)) {
    $myquery = "INSERT INTO candidat(Fullname, Profil, Resume) values ('$fullname','$profil','$destination')";
    if ($db->query($myquery) ){
        $success = "added with success"  ;
    init();
    }else{
        $error = "error of insertion"  ;
    }
}

}

require_once("./partials/header.php")
?>

<!-- main -->
<?php
            if (isset($error)) {
            echo "<div class='alert alert-danger'>",$error,"</div>";
            }

            if (isset($success)) {
            echo "<div class='alert alert-success'>",$success,"</div>";
            }
            ?>
<div class="card my-4">
    <div class="card-header">
        <h5 class="card-title text-center"> Ajouter mon profile </h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullname" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$fullname; ?>">
            </div>
            <?php 
                    if (isset($candidat->errorMsg["fullname"])) {
                    echo "<div class='alert alert-danger'>",$candidat->errorMsg['fullname'],"</div>";
                    }
                    ?>
            <div class="mb-3">
                <label for="profil" class="form-label">Profile</label>
                <input type="text" class="form-control" id="profil" name="profil" value="<?=$profil; ?>">
            </div>
            <?php 
                    if (isset($candidat->errorMsg["profil"])) {
                    echo "<div class='alert alert-danger'>",$candidat->errorMsg['profil'],"</div>";
                    }
            ?>
                <div class=" mb-3">
                    <label for="resume" class="form-label">curriculum vitae</label>
                    <input type="file" class="form-control" id="resume" name="resume" value="<?=$resume; ?> required">
                </div>
                <?php 
                    if (isset($candidat->errorMsg["resume"])) {
                    echo "<div class='alert alert-danger'>",$candidat->errorMsg['resume'],"</div>";
                    }
                    ?>
                <button type="submit" name="save" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>



<?php
    require_once "./partials/footer.php";
?>