 <?php
require_once 'Autoloader.php';
class SavingAccountDataService
{
    private $db;
    
    function __construct($db)
    {
        $this->db = $db;
    }
    
    function getBalance()
    {
        $stmt = $this->db->prepare('SELECT BALANCE FROM saving');
        $stmt->execute();
        if($stmt->rowCount() == 0)
        {
            return -1;
        }
        else
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $balance = $row['BALANCE'];
            return $balance;
        }
    }
    function updateBalance($balance)
    {
        $stmt = $this->db->prepare('UPDATE saving SET BALANCE = :balance');
        $stmt->bindParam(':balance', $balance);
        $stmt->execute();
        if($stmt->rowCount() == 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}