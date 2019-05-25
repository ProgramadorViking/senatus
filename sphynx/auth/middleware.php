<?php
  require_once 'sphynx/bbdd/core.php';
  require_once 'vendor/autoload.php';
  use Firebase\JWT\JWT;

  class middleware extends Core {

    private static function getPDO() {
      $bd = new Core();
      return $bd->connect();
    }

    public static function auth() {

      $data = $data = json_decode(file_get_contents('php://input'));
      $token = $data->token;
      $key = 'appaloosa';
      try {
        $array = (array)JWT::decode($token,$key,array('HS256'));
        if ($array['iat']<time() && $array['exp']>time()) {
            $bd = middleware::getPDO();
            $query = "SELECT * FROM users WHERE id=".$array['data']->id;
            $result = $bd->query($query);
            if($result) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $resultSet[]=$row;
                }
                $verify=$resultSet[0];
                if($verify['token']==$array['data']->token) {
                    return true;
                } else {
                    var_dump($verify['token']);
                    var_dump($array['data']->token);
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
      }catch(\Firebase\JWT\ExpiredException $e){
          return false;
      } catch (\UnexpectedValueException $e) {
          return false;
      }
    }
  }
?>
