<?php

require_once "../database/databaseConnect.php";
include_once "../classes/Account.php";         
include_once "../classes/CurrentAccount.php";
include_once "../classes/BusnissAcout.php ";
include_once "../classes/savingsAcout.php";

$database=new Database();
$conn=$database->conn();
echo "Connected successfully"; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Comptes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="mb-4">Gestion des Comptes Bancaires</h2>

    <!-- Compte Courant -->
    <div class="card mb-4">
        <div class="card-header">Compte Courant</div>     
        <div class="card-body">
            <form method="POST" action="index.php" >
                <input type="hidden" name="action" value="current"> 
                <div class="mb-3">
                    <label>Numéro de Compte:</label>
                    <input type="text" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Balance:</label>
                    <input type="number" name="balance" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Retrait:</label>
                    <input type="text" name="retrait" class="form-control" required>
                </div>
                <button type="submit" name="sub
                mit2" class="btn btn-primary">Créer Compte Courant</button>  
            </form>
        </div>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
 
        if($_POST['action'] == 'current') {
             $numero= $_POST['numero'];
            $balance= $_POST['balance'];
            $retrait= $_POST['retrait'];
            echo "Compte Courant créé avec succès";
            $xs = new CurrentAccount($numero, $balance, $retrait);
           
            $xs->ajouter();
        }
    }
    
    ?>

    <!-- Compte Épargne -->

    <div class="card mb-4">
        <div class="card-header">Compte Épargne</div>
        <div class="card-body">
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="saving">
                <div class="mb-3">
                    <label>Numéro de Compte:</label>
                    <input type="text" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Balance:</label>
                    <input type="number" name="balance" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Taux d'intérêt:</label>
                    <input type="text" name="taux" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer Compte Épargne</button>
            </form>
        </div>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if($_POST['action'] == 'saving') {
             $numero= $_POST['numero'];
            $balance= $_POST['balance'];
            $retrait= $_POST['taux'];
            echo "Compte Courant créé avec succès";
            $xs = new savingsaccount($numero, $balance, $retrait);
           
            $xs->ajouter();  
        }
    }
    
    ?>

    <!-- Compte Business -->
    <div class="card mb-4">
        <div class="card-header">Compte Business</div>
        <div class="card-body">
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="business">
                <div class="mb-3">
                    <label>Numéro de Compte:</label>
                    <input type="text" name="numero" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Balance:</label>
                    <input type="number" name="balance" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Frais:</label>
                    <input type="number" name="frais" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer Compte Business</button>
            </form>
        </div>
    </div>

    <?php


    if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if($_POST['action'] == 'business') {
             $numero= $_POST['numero'];
            $balance= $_POST['balance'];
            $frais= $_POST['frais'];
            echo "Compte Courant créé avec succès";
            $xs = new BusinessAccount($numero, $balance, $frais);
           
            $xs->ajouter();
        }
    }

    ?>
    <!-- Supprimer un compte -->
    <div class="card mb-4">
        <div class="card-header">Supprimer un Compte</div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="action" value="delete">
                <div class="mb-3">
                    <label>ID du Compte:</label>
                    <input type="number" name="id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Supprimer</button>  
            </form>
        </div>
    </div>
    <style>
    table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .bouton-modifier {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        margin-right: 5px;
    }

    .bouton-supprimer {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }
</style>

<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Numéro</th>
        <th>Balance</th>
        <th>Détails</th>
        <th>Actions</th>
    </tr>
    <?php
    $sql = "SELECT * FROM accounts ORDER BY id DESC";
    try {
        $result = $conn->query($sql);
        
        if($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['numero']) . "</td>";
                echo "<td>" . number_format($row['balance'], 2) . " €</td>";
                echo "<td>";
                switch($row['type']) {
                    case 'Courant':
                        echo "Retrait: " . htmlspecialchars($row['retrait']) . " €";
                        break;
                    case 'Épargne':
                        echo "Taux: " . htmlspecialchars($row['taux']) . "%";
                        break;
                    case 'Business':
                        echo "Frais: " . htmlspecialchars($row['frais']) . " €";
                        break;
                }
                echo "</td>";
                echo "<td>";
                // Bouton Modifier
                echo "<form method='POST' style='display: inline;'>";
                echo "<input type='hidden' name='action' value='edit'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='hidden' name='type' value='" . $row['type'] . "'>";
                echo "<button type='submit' class='bouton-modifier'>Modifier</button>";
                echo "</form>";
                
                // Bouton Supprimer
                echo "<form method='POST' style='display: inline;'>";
                echo "<input type='hidden' name='action' value='delete'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='bouton-supprimer'>Supprimer</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align: center;'>Aucun compte trouvé</td></tr>";
        }
    } catch(PDOException $e) {
        echo "<tr><td colspan='6' style='text-align: center; color: red;'>Erreur : " . $e->getMessage() . "</td></tr>";
    }
    ?>
</table>
   
    
</body>
</html>

