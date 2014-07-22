<?php
class Login {
    public function Logon($user,$password,$id=false) {
        $user = strtolower(trim($user));
        if (!ereg("^[a-zA-Z0-9' ]{1,255}$",$user)) {
            return false;
        }
        if ($id===false) {
            $password = md5($password);
            $sql = mysql_query("SELECT usuario,password,id,email,nombres,apellidop,permisos FROM usuarios WHERE usuario = '$user' AND password = '$password'");
        }
        else {
            if (!ereg("^[a-zA-Z0-9' ]{1,255}$",$id)) {
                $id = 0;
            }
            $password = mysql_real_escape_string($password);
            $sql = mysql_query("SELECT usuario,password,id,email,nombres,apellidop,permisos FROM usuarios WHERE usuario = '$user' AND password = '$password' AND id = '$id'");
        }
        if (mysql_num_rows($sql)>=1) {
            $row=mysql_fetch_assoc($sql);
            mysql_free_result($sql);
            $this->SetSession($row);
            return true;
        }
        $this->LogOut();
        return false;
    }
    private function SetSession($array) {
        setcookie("username", $array["usuario"], time() + 3600, "/");
        setcookie("hash", $array["password"], time() + 3600, "/");
        setcookie("user", $array["id"], time() + 3600, "/");
        setcookie("lgcorreo", $array["email"], time() + 3600, "/");
        setcookie("lgnombres", $array["nombres"], time() + 3600, "/");
        setcookie("lgapellidos", $array["apellidop"], time() + 3600, "/");
        setcookie("lgpermisos", $array["permisos"], time() + 3600, "/");
        return true;
    }
    public function LogOut() {
        setcookie("username", $array["usuario"], time() + 3600, "/");
        setcookie("hash", $array["password"], time() + 3600, "/");
        setcookie("user", $array["id"], time() + 3600, "/");
        setcookie("lgcorreo", $array["email"], time() + 3600, "/");
        setcookie("lgnombres", $array["nombres"], time() + 3600, "/");
        setcookie("lgapellidos", $array["apellidop"], time() + 3600, "/");
        setcookie("lgpermisos", $array["permisos"], time() + 3600, "/");
        return true;
    }
    public function Check() {
        if ($this->Logon($_COOKIE["username"],$_COOKIE["hash"],$_COOKIE["user"])) {
            return true;
        }
        return false;
    }
}
class lagc{
    public function check($val1, $val2){
        if($val1==$val2){ $fin = " checked"; }
        else { $fin = ""; }
        return $fin;
    }
    public function select($val1, $val2){
        if($val1==$val2){ $fin = " selected"; }
        else { $fin = ""; }
        return $fin;
    }
}
?>