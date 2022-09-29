<?php
include ("./functions.php");
/**
 * Book : manage candidat

 */
class Candidat{
    const insertQuery = "INSERT INTO candidat(Fullname, Profil, Resume) values(?,?,?)";
    const selectQuery = "SELECT * FROM candidat";
    const selectByIdQuery = "SELECT * FROM candidat WHERE id=?";
    const searchQuery = "SELECT *  FROM candidat WHERE Fullname like ? OR Profil like ";
    private int $id;
    private string $fullname;
    private string $profil;
    private string $resume;
    public  $errorMsg =[];

    public function setId(int $id){
       $this->id = $id;
    }

    public function setTitle(string $fullname){
        try {
         $this->fullname = checkField("fullname", $fullname, 1);   
        } catch (Exception $e) {
            $this->errorMsg["fullname"] = $e->getMessage();
        }
         
      
    }

    public function setProfil(string $profil){
        try {
        $this->profil = checkField("profil", $profil, 2);    
        } catch (Exception $e) {
            $this->errorMsg["profil"] = $e->getMessage();
        }
        
    }
    
    
    
    public function getFile(string $name){
        $tmpName = $_FILES['$name']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);
        return $content ;
        
    }

    public function getId(){
        return $this->id;
    } 
    
    public function getTitle(){
        return $this->fullname;
    }
    
    public function getProfil(){
        return $this->profil;
    } 
    

    
   
    function Query() :string{
        return "INSERT INTO candidat(fullname, Profil, Resume) values(?,?,?)";
    }

    function getFields(): array{
        return [$this->getTitle(),$this->getProfil(),$this->getFile()];
    }

}