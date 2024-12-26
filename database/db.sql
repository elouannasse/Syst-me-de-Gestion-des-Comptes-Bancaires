create database Banck;
CREATE TABLE Account(
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Numero_de_compte VARCHAR(20) UNIQUE,
    Balance FLOAT
)
CREATE TABLE SavingsAccount(
	id INT AUTO_INCREMENT PRIMARY KEY,
    Taux_Interet VARCHAR(5),
    account_id INT,
    FOREIGN KEY (account_id) REFERENCES account(Id)
)
CREATE TABLE CurrentAccount(
	id INT AUTO_INCREMENT PRIMARY KEY,
    Retrait FLOAT,
    Account_id INT,
    FOREIGN KEY (Account_id) REFERENCES account(Id)
    
)
CREATE TABLE BesinnessAccount(
	id INT AUTO_INCREMENT PRIMARY KEY,
    Fraix FLOAT,
    Account_id INT,
    FOREIGN KEY (Account_id) REFERENCES account(Id)
    
)