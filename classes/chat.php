<?php
require_once './classes/database.php';

class Chat extends Database
{
    private $table_name = 'message';
    
    public $UserId;
    public $Message;
    public $Date;

    
    public function getMessages()
    {
        $query = "SELECT * FROM $this->table_name as m INNER JOIN user as u ON m.UserId=u.Id ORDER BY m.Id ASC";
        
        $this->query($query);
        $aResult = $this->fetchAll();
     
        //echo json_encode($aResult);
        //exit;
        
        return $aResult;
    }
    
    public function addMessage($userid, $message)
    {
        $query = "INSERT INTO message (UserId, Message, Date) VALUES (:UserId, :Message, :Date)";
        $this->query($query);
        
        $this->bind(':UserId', $userid);
        $this->bind(':Message', $message);
        $this->bind(':Date', date("Y-m-d H:i:s"));
        
        $this->execute();
        
        return true;
    }
    
}
