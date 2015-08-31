<?php

include './classes/database.php';
class User extends Database
{
    private $table_name = 'user';
    
    private $Username;
    private $Password;
    public $Date;

    
    public function addUser($username, $password)
    {
        $aData['success'] = false;
        $this->Username = $username;
        $this->Password = $password;
        $sql = "SELECT COUNT(Username) AS num FROM user WHERE username = :username";
        $this->query($sql);
        $this->bind(':username', $username);
        $this->execute();
        $row = $this->fetch();
        
        if($row['num'] > 0){
            $aData['Exists'] = 'The username already exist';
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
            $sql = "INSERT INTO user (Username, Password, Date) VALUES (:username, :password, :date)";
            $this->query($sql);
            $this->bind(':username', $username);
            $this->bind(':password', $passwordHash);
            $this->bind(':date', date("Y-m-d H:i:s"));

            $result = $this->execute();

            if($result == true){
                $this->login($username, $password);
                $aData['success'] = true;
            }
        }
        echo json_encode($aData);
        exit;

    }
    
    public function login($username, $password)
    {
        $aData['success'] = false;
        $sql = "SELECT id, username, password FROM user WHERE username = :username";
        $this->query($sql);
        $this->bind(':username', $username);
        $this->execute();
        $user = $this->fetch();
        if ($user) {
            $validPassword = password_verify($password, $user['password']);
        
            if ($validPassword == true) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = time();
                $aData['success'] = true;
            } else{
                $aData['Exists'] = 'password do not match';
            } 
        } else {
            $aData['Exists'] = 'No such user';
        } 
            echo json_encode($aData);
            exit;
        
   }
   
   public function loggedin()
   {
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
            return true;
        }
        else{
            return false;
        }
    }
}
