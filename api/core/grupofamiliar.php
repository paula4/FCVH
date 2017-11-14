<?php
/**
* grupofamiliar class.
* Class to manage grupo familar.
**/
class GrupoFamiliar
{
  const TABLE = 'grupofamiliar';
  private $con;
  public $datos; //array with object data
  private $id,$grup_nomb;
  function __construct($id = null)
  {
    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();
  }
  /* set methods */
  public function setId($id){
    $id = $this->con->real_escape_string($id);
    $table = $this->con->real_escape_string(self::TABLE);
    $sql = "SELECT * FROM $table WHERE grup_id = '$id'";
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['grup_id'];
      $this->grup_nomb = $this->datos['grup_nomb'];
      return true;
    }
    return false;
  }
  public function setNombre($value){
    $this->grup_nomb = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT grup_id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['grup_id']);
      }
      return $toreturn;
    }
    else{
      return false;
    }
  }
  public function getId(){
    return $this->id;
  }
  public function getNombre(){
    return $this->grup_nomb;
  }

  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $grup_nomb = $this->con->real_escape_string($this->grup_nomb);
    $sql =  "INSERT INTO $table
            (  grup_nomb)
    VALUES  ('$grup_nomb')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $grup_nomb = $this->con->real_escape_string($this->grup_nomb);
    $sql = "UPDATE $table SET
    grup_nomb = '$grup_nomb'
    WHERE grup_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE grup_id = '$id'";
    return $this->con->query($sql);
  }
}
?>
