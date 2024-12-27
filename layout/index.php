<?php

require_once "../database/databaseConnect.php";
include_once "../classes/Account.php";         
include_once "../classes/CurrentAccount.php";

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
            <form method="POST" action="index.php">
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
            <form method="POST">
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

    <!-- Compte Business -->
    <div class="card mb-4">
        <div class="card-header">Compte Business</div>
        <div class="card-body">
            <form method="POST">
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

</body>
</html>

