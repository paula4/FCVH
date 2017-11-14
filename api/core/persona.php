<?php
/**
* Socio class.
* Class to manage personas.
**/
class Persona
{
  const TABLE = 'personas';
  private $con;
  public $datos; //array with object data
  private $id,$pers_nomb,$pers_apell,$pers_ndni,$pers_dire,$pers_telf,$pers_telc,$pers_mail;
  function __construct($id = null)
  {
    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();//al destruir el usuario cierra la conexión con la db.
  }
  /* set methods */
  public function setId($id){
    $table = $this->con->real_escape_string(self::TABLE);
    if(is_int($id) || is_numeric($id)){//search by id
      $id = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE pers_id = '$id'";
    }
    else{//search by user
      $username = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE pers_mail = '$username'";
    }
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['pers_id'];
      $this->pers_nomb = $this->datos['pers_nomb'];
      $this->pers_apell = $this->datos['pers_apell'];
      $this->pers_ndni = $this->datos['pers_ndni'];
      $this->pers_dire = $this->datos['pers_dire'];
      $this->pers_telf = $this->datos['pers_telf'];
      $this->pers_telc = $this->datos['pers_telc'];
      $this->pers_mail = $this->datos['pers_mail'];
      return true;
    }
    return false;
  }
  public function setNombre($value){
    $this->pers_nomb= $value;
  }
  public function setApellido($value){
    $this->pers_apell = $value;
  }
  public function setDNI($value){
    $this->pers_ndni = $value;
  }
  public function setDireccion($value){
    $this->pers_dire = $value;
  }
  public function setTelf($value){
    $this->pers_telf = $value;
  }
  public function setTelc($value){
    $this->pers_telc = $value;
  }
  public function setMail($value){
    $this->pers_mail = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT pers_id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['pers_id']);
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
    return $this->pers_nomb;
  }
  public function getApellido(){
    return $this->pers_apell;
  }
  public function getDNI(){
    return $this->pers_ndni;
  }
  public function getDireccion(){
    return $this->pers_dire;
  }
  public function getTelf(){
    return $this->pers_telf;
  }
  public function getTelc(){
    return $this->pers_telc;
  }
  public function getMail(){
    return $this->pers_mail;
  }
  /* db actions methods */
  public function getlastId(){
    return $this->con->insert_id;
  }
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $pers_nomb = $this->con->real_escape_string($this->pers_nomb);
    $pers_apell = $this->con->real_escape_string($this->pers_apell);
    $pers_ndni = $this->con->real_escape_string($this->pers_ndni);
    $pers_dire = $this->con->real_escape_string($this->pers_dire);
    $pers_telf = $this->con->real_escape_string($this->pers_telf);
    $pers_telc = $this->con->real_escape_string($this->pers_telc);
    $pers_mail = $this->con->real_escape_string($this->pers_mail);
    $sql =  "INSERT INTO $table
            (  pers_nomb,   pers_apell,   pers_ndni,   pers_dire,   pers_telf,   pers_telc,   pers_mail)
    VALUES  ('$pers_nomb','$pers_apell','$pers_ndni','$pers_dire','$pers_telf','$pers_telc','$pers_mail')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $pers_nomb = $this->con->real_escape_string($this->pers_nomb);
    $pers_apell = $this->con->real_escape_string($this->pers_apell);
    $pers_ndni = $this->con->real_escape_string($this->pers_ndni);
    $pers_dire = $this->con->real_escape_string($this->pers_dire);
    $pers_telf = $this->con->real_escape_string($this->pers_telf);
    $pers_telc = $this->con->real_escape_string($this->pers_telc);
    $pers_mail = $this->con->real_escape_string($this->pers_mail);
    $sql = "UPDATE $table SET
    pers_nomb = '$pers_nomb',
    pers_apell = '$pers_apell',
    pers_ndni    = '$pers_ndni',
    pers_dire     = '$pers_dire',
    pers_telf = '$pers_telf',
    pers_telc    = '$pers_telc',
    pers_mail    = '$pers_mail'
    WHERE pers_id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE pers_id = '$id'";
    return $this->con->query($sql);
  }
}
?>
