<?php
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$admin = new Socio($username);

$user_id= $request->getAttribute('id') != null ? $request->getAttribute('id') : null;
$user = new Persona($user_id);

if(isset($username) && isset($password) && ($admin->getAdmin() == "1" || $admin->getUser() == $user->getUser()) && $admin->getClave() == $password){
  if($request->getAttribute('id') != null){
    //user/{id} route
    if(isset($user->datos) && (is_array($user->datos) || is_object($user->datos))){
      $result = array('status' => true, 'result' => $user->datos);
    }
    else{
      $result = array('status' => false, 'result' => LANG_USER_NO_EXIST);
    }
    $response->write(json_encode($result));
    return $response;
  }
  else{
    $users_id = Persona::getAllId();
    if(is_array($users_id) || is_object($users_id)){
      $users = array();//Arreglo con datos de todos los usuarios
      foreach ($users_id as $user_id) {
        $user = new Persona($user_id);
        array_push($users,$user->datos);
      }
      $result = array('status' => true, 'result' => $users);
      $response->write(json_encode($result));
      return $response;
    }else{
      //no hay users
      $result = array('status' => false, 'result' => LANG_USERS_NO_EXIST);
      $response->write(json_encode("false"));
      return $response;
    }
  }
}
else{
  //falta de privilegios / user no encontrado
  $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
  $response->write(json_encode($result));
  return $response;
}
?>
