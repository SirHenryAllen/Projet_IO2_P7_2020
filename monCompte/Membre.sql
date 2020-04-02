create table Membre (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
nom VARCHAR (100),
prenom VARCHAR (100),
pseudo VARCHAR(100),
mail VARCHAR(80),
pwd NVARCHAR(64)
)


INSERT INTO Membre VALUES
(id, nom, prenom, pseudo, mail, pwd);