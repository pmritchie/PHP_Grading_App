<?php 
class welcome extends AppController{

    public function __construct($parent){
        $this->parent=$parent;
        
    }
    public function index(){
        // get data from database
        $data = array();

        $data["grades"]= $this->parent->getModel("grades")->select("SELECT * FROM students;");
        $this->parent->getView("addForm");
        $this->parent->getView("welcome", $data);
        $this->parent->getView("footer");
    }
    public function addGrade(){

        $letter = $this->gradeConveter($_REQUEST["percent"]);
        // adds to database
        $this->parent->getModel("grades")->add("INSERT INTO students (studentname, studentpercent, studentlettergrade) 
            values(:studentname, :studentpercent, :studentlettergrade)",
            array(":studentname" => $_REQUEST["name"], ":studentpercent" => $_REQUEST["percent"], ":studentlettergrade" => $letter)
        );

        header("location:/welcome");
    }
    public function gradeConveter($percent){
        // function to convert percent to a letter grade
        $letterGrade = '';

        if ($percent > 89) {
            $letterGrade = 'A';
        } elseif ($percent > 79) {
            $letterGrade = 'B';
        } elseif ($percent >  69) {
            $letterGrade = 'C';
        } elseif ($percent > 59) {
            $letterGrade = 'D';
        } else {
            $letterGrade = 'F';
        }
        return $letterGrade; 
    }
    public function validateInputs(){
        // regex check the inputs
        $error = false;

        if(!preg_match("/^[\p{L}\s'.-]+$/", $_POST["name"])){
            $error = true;
            $_SESSION['errormsg'] = "You must only use letters for names.";
            header("location:/welcome");
        }
        if(!preg_match("/^([0-9]*|\d*\.\d{1}?\d*)$/", $_POST["percent"])){
            $error = true;
            $_SESSION['errormsg'] = "Grade percentage must be a positive number.";
            header("location:/welcome");
        }
        //check to see if it is an edit for first time post
        if($error == false && $_POST["id"]){
            $this->updateGrade();
        } elseif ($error == false) {
            $this->addGrade();
        }
    }

    public function delete(){
        //delete item
        $this->parent->getModel("grades")->delete("DELETE FROM students WHERE studentid = :studentid",
        array(":studentid" => $_REQUEST['studentid']));
        header("location:/welcome");
    }

    public function update(){
        //loads the edit form and fills input with needed values
        $data = array();
        $data["grades"]= $this->parent->getModel("grades")->select("SELECT * FROM students;");
        $data["student"] = $this->parent->getModel("grades")->select("SELECT * FROM students WHERE studentid = :studentid",
        array(":studentid" => $_REQUEST["studentid"]));
     
        $this->parent->getView("editForm",$data["student"][0]);
        $this->parent->getView("welcome",$data);
        $this->parent->getView("footer");
    }
    public function updateGrade(){
        //updates to database
        $letter = $this->gradeConveter($_POST["percent"]);
        $this->parent->getModel("grades")->select("UPDATE students SET studentname = :studentname, studentpercent = :studentpercent, studentlettergrade = :studentlettergrade
        WHERE studentid = :studentid", array(
            ":studentid" => $_POST["id"],
            ":studentname" => $_POST["name"],
            ":studentpercent" => $_POST["percent"],
            ":studentlettergrade" => $letter,
        ));
        header("location:/welcome");
    }

}

   
    

?>