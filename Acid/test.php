<?php

require_once 'Autoloader.php';

//Get bank Business Service
$service = new BankBusinessService();

//Get Checking Service
echo "Initial Checking balance is ". $service->getCheckingBalance() . "<br>";

//Get Checking Service
echo "Initial Saving balance is ". $service->getSavingBalance() . "<br>";

// Run a Bank Transaction
$service->transaction();

//Get Checking Balance
echo "New Checking balance is ". $service->getCheckingBalance() ."<br>";

//Get Checking Balance
echo "New Saving balance is ". $service->getSavingBalance() ."<br>";
