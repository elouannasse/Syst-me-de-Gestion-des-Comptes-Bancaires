 <?php 

class BusinessAccount extends Account {  
    private $frais;
    
   private $database;
    private $conn;
    public function __construct($N_C, $Balance, $frais) {
        parent::__construct($N_C, $Balance);
        $this->N_C = $N_C;    
        $this->Balance = $Balance;    
        $this->frais = $frais;
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
        
        $query = "INSERT INTO besinnessaccount(fraix	, Account_id) VALUES (:Fraix,:account_id)";  
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':Fraix' => $this->frais, 
            ':account_id' => $lastid
        ]);
    }
}





?>



