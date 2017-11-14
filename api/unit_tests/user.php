<?php
header("Content-Type: text/plain");
require_once('../core/provincia.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
foreach (Provincia::getAllId() as $prov_id) {
  $prov = new Provincia($prov_id);
  echo $prov->getNombre()." id = ".$prov->getId().PHP_;
}

$user = new Socio();
$user->setPersId('2');
$user->setStad('casada');
$user->setUser('paulixtuturrita2');//1 or 0 or '1' or '0'
$user->setClave('lalala');
$user->setGrupId('1');
$user->setCateId('2');
$user->setAdmin('3');
echo $user->dbInsert() ? "Persona creado correctamente".PHP_EOL : "Error al crear el persona".PHP_EOL;

$user = new Socio(1);
$user->setPersId('1');
$user->setStad('soasdasd');
$user->setUser('pablito');//1 or 0 or '1' or '0'
$user->setClave('asdasd');
$user->setGrupId('3');
$user->setCateId('1');
$user->setAdmin('0');
echo $user->dbUpdate() ? "Usuario actualizado correctamente".PHP_EOL : "Error al actualizar el usuario".PHP_EOL;

$user = new Socio(1);
echo $user->dbDelete() ? "Usuario eliminado correctamente".PHP_EOL : "Error al eliminar el usuario".PHP_EOL;
?>
