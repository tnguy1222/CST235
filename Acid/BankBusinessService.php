<?php
require_once 'Autoloader.php';
class BankBusinessService
{
    function getCheckingBalance()
    {
        $servername = Database::$dbservername;
        $username = Database::$dbusername;
        $password = Database::$dbpassword;
        $dbname = Database::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $checking = new CheckAccountDataService($db);
        $balanceChecking = $checking->getBalance();
        
        $db = null;
        
        return $balanceChecking;
    }
    
    function getSavingBalance()
    {
        $servername = Database::$dbservername;
        $username = Database::$dbusername;
        $password = Database::$dbpassword;
        $dbname = Database::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $saving = new SavingAccountDataService($db);
        $balanceSaving = $saving->getBalance();
        
        $db = null;
        
        return $balanceSaving;
    }
    
    function transaction()
    {
        $servername = Database::$dbservername;
        $username = Database::$dbusername;
        $password = Database::$dbpassword;
        $dbname = Database::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $db->beginTransaction();
        
        $checking = new CheckAccountDataService($db);
        $balanceChecking = $checking->getBalance();
        $okChecking = $checking->updateBalance($balanceChecking - 100);
        
        $saving = new SavingAccountDataService($db);
        $balanceSaving = $saving->getBalance();
        $okSaving = $saving->updateBalance($balanceSaving + 100);
        
        if($okChecking && $okSaving)
        {
            $db->commit();
        }
        else
        {
            $db->rollBack();
        }
        
        $db = null;
    }
}