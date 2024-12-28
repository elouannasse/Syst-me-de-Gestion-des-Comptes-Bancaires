<?php
class CurrentAccount extends Account {  
    private $retraits;
    
   private $database;
    private $conn;
    public function __construct($N_C, $Balance, $retraits) {
        parent::__construct($N_C, $Balance);
        $this->N_C = $N_C;    
        $this->Balance = $Balance;    
        $this->retraits = $retraits;
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
        
        $query = "INSERT INTO CurrentAccount(Retrait, Account_id) VALUES (:retrait,:account_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':retrait' => $this->retraits,
            ':account_id' => $lastid
        ]);
    }
}





?>