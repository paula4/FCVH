<?php
/**
* localidad class.
* Class to manage localidades.
**/
class Localidad
{
  const TABLE = 'localidad';
  private $con;
  public $datos; //array with object data
  private $id,$loca_nomb,$loca_cpos;
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
    $sql = "SELECT * FROM $table WHERE loca_id = '$id'";
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['loca_id'];
      $this->loca_nomb = $this->datos['loca_nomb'];
      $this->loca_cpos = $this->datos['loca_cpos'];
      return true;
    }
    return false;
  }
  public function setNombre($value){
    $this->loca_nomb = $value;
  }
  public function setCPos($value){
    $this->loca_cpos = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT loca_id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['loca_id']);
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
    return $this->loca_nomb;
  }
  public function getCPos(){
    return $this->loca_cpos;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $loca_nomb = $this->con->real_escape_string($this->loca_nomb);
    $loca_cpos = $this->con->real_escape_string($this->loca_cpos);
    $sql =  "INSERT INTO $table
            (  loca_nomb,   loca_cpos)
    VALUES  ('$loca_nomb','$loca_cpos')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $loca_nomb = $this->con->real_escape_string($this->loca_nomb);
    $loca_cpos = $this->con->real_escape_string($this->loca_cpos);
    $sql = "UPDATE $table SET
    loca_nomb = '$loca_nomb',
    loca_cpos  = '$loca_cpos'
    WHERE loca_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE loca_id = '$id'";
    return $this->con->query($sql);
  }
}
?>
