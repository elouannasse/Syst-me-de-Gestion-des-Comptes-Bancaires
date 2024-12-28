<?php 
$database=new Database();
$conn=$database->conn();

abstract class Account{
    protected $N_C;
    protected $Balance;

    public function __construct($N_C, $Balance){ 
        $this->N_C = $N_C;
        $this->Balance = $Balance;
    }
    
    
    public function affichChamps() {
        return "ID: " . $this->id . ", Numero: " . $this->N_C . ", Balance: " . $this->Balance; 
    }

    // public function deleteTable($id) {
    //     $query = "DELETE FROM Account WHERE id = ?";      
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute([$id]);
    // }
} 
?>






