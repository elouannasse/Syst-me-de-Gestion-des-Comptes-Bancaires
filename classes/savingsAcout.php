<?php 
class SavingsAccount extends Account{
    private $taux;
    private $database;
    private $conn;
    public function __construct($N_C, $Balance, $saving) {
        parent::__construct($N_C, $Balance);
        $this->N_C = $N_C;    
        $this->Balance = $Balance;    
        $this->saving = $saving; 
        $database = new Database();   
        $this->conn = $database->conn();  
    }

    
    public function ajouter() {
        $query = "INSERT INTO account(numero_de_compte, Balance) VALUES (:numero,:balance)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':numero' => $this->N_C,
            ':balance' => $this->Balance 
        ]);
        
        $lastid = $this->conn->lastInsertId();
        
        $query = "INSERT INTO savingsaccount(taux_Interet, Account_id) VALUES (:Taux_Interet	,:account_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':Taux_Interet' => $this->saving,
            ':account_id' => $lastid
        ]);
    }
}






    



?>