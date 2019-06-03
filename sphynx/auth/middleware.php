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
      $array = middleware::arrayToken();
      try {
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
                  //només verifica el token creat al login sigui correcte
                    return true;
                    //fem per mirar la base de dades si es tot correcte...

                } else {
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

    public static function hasPermission($action,$table) {
      $array = middleware::arrayToken();
      switch($action) {
        case 'Read': $act = 0; break;
        case 'Add': $act = 1; break;
        case 'Edit': $act = 2; break;
        case 'Delete': $act = 3; break;
      }
      try {
        $bd = middleware::getPDO();
        $query = "SELECT count(users.id) total FROM users, roles, permissions_roles, permissions
                  WHERE users.role_id = roles.id AND roles.id = permissions_roles.role_id AND permissions_roles.permission_id = permissions.id AND
                  users.id = ".$array['data']->id. " AND permissions.action =".$act." AND permissions.table = '".$table."'";
        $result = $bd->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $resultSet[]=$row;
        }
        $verify=$resultSet[0];
        return $verify['total']!=0;

        return true;
      } catch(\Firebase\JWT\ExpiredException $e){
          return false;
      } catch (\UnexpectedValueException $e) {
          return false;
      }
    }

    public static function arrayToken() {
      $data = json_decode(file_get_contents('php://input'));
      $token = $data->token;
      $key = 'appaloosa';
      $array = (array)JWT::decode($token,$key,array('HS256'));
      return $array;
    }
  }
?>
