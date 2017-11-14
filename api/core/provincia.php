<?php
/**
* Option class.
* Class to manage provincias.
**/
class Provincia
{
  const TABLE = 'provincia';
  private $con;
  public $datos; //array with object data
  private $id,$prov_nombre;
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
    $sql = "SELECT * FROM $table WHERE prov_id = '$id'";
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['prov_id'];
      $this->prov_nombre = $this->datos['prov_nomb'];
      return true;
    }
    return false;
  }
  public function setNombre($value){
    $this->prov_nombre = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT prov_id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['prov_id']);
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
    return $this->prov_nombre;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $prov_nombre = $this->con->real_escape_string($this->prov_nombre);
    $sql =  "INSERT INTO $table
            (prov_nombre)
    VALUES  ('$prov_nombre')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $prov_nombre = $this->con->real_escape_string($this->prov_nombre);
    $sql = "UPDATE $table SET
    prov_nombre     = '$prov_nombre'
    WHERE prov_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE prov_id = '$id'";
    return $this->con->query($sql);
  }
}
?>
