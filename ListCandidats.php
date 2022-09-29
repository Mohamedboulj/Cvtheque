<?php
require("./partials/header.php");
require("./DbConnection.php");
require("./Candidat.php");

$db = new DBConnection("localhost", "root", "root", "cvtheque");
$candidat = new Candidat();
$result = $db->getAll($candidat::selectQuery);
$success = null;
$error = null;


if(isset($_POST['search'])){
    $search = '%'.$_POST['search'].'%';
    $fields = [$search,$search];
    $result= $db->search(Candidat::searchQuery,"ss", $fields);
    $_POST['search'] = null; 
}

?>
<?php
    if (isset($error)) {
       echo "<div class='alert alert-danger'>",$error,"</div>";
     }

      if (isset($success)) {
        echo "<div class='alert alert-success'>",$success,"</div>";
      }      
 ?>

<form action="" method="post" class="my-3">
    <div class="input-group">
        <input type="search" placeholder="Search" class="form-control" name="search">
        <button class="btn btn-warning btn-md" type="submit">Search</button>
    </div>
</form>


<div class="card my-3">
    <div class="card-header">
        <h5 class="card-title text-center">List of Candidats</h5>
    </div>
    <div class="card-body">


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Profil</th>
                    <th scope="col">Resume</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?=$row['Id'] ?></td>
                    <td><?=$row['Fullname'] ?></td>
                    <td><?=$row['Profil'] ?></td>
                    <td><a href="<?=$row['Resume'] ?> ">download resume</a> </td>
                    
                </tr>
                <?php 
            }
            ?>
            </tbody>
        </table>
    </div>
</div>





<?php
require("./partials/footer.php");
?>