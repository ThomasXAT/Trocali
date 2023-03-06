<?php
$host = "lakartxela.iutbayonne.univ-pau.fr";
$port = "3306";
$name = "tjorge_bd";
$user = "tjorge_bd";
$pass = "tjorge_bd";
try
{
    $db = new PDO("mysql:host=$host;dbname=$name;charset=utf8;port=$port", $user, $pass);
}
catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

function generateDatabase() {
    global $db;
    $utilisateur = $db->prepare("
    CREATE TABLE Utilisateur (
        identifiant VARCHAR(50) PRIMARY KEY,
        nom VARCHAR(50),
        prenom VARCHAR(50),
        email VARCHAR(50),
        administrateur BOOLEAN NOT NULL,
        mdp VARCHAR(100) NOT NULL);
        ");

    $article = $db->prepare("
    CREATE TABLE Article (
        identifiant INTEGER UNSIGNED AUTO_INCREMENT,
        titre VARCHAR(50) NOT NULL,
        type VARCHAR(50) NOT NULL
        CHECK (type = 'Offre' OR type = 'Demande'),
        categorie VARCHAR(50),
        description VARCHAR(1000),
        moyenPaiement VARCHAR(50)
        CHECK (moyenPaiement = 'Argent' 
        OR moyenPaiement = 'Troc' 
        OR moyenPaiement = 'Argent & Troc'),
        prix DOUBLE UNSIGNED,
        troc VARCHAR(1000),
        auteur VARCHAR(50) NOT NULL,
        datePublication TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        acheteur VARCHAR(50),
        dateAchat DATE,
        masque BOOLEAN,
        PRIMARY KEY (identifiant),
        FOREIGN KEY (auteur) REFERENCES Utilisateur(identifiant),
        FOREIGN KEY (acheteur) REFERENCES Utilisateur(identifiant));
        ");

    $avis = $db->prepare("
    CREATE TABLE Avis (
        identifiant INTEGER UNSIGNED AUTO_INCREMENT,
        note INTEGER UNSIGNED NOT NULL 
        CHECK (Note BETWEEN 1 AND 10),
        description VARCHAR(50),
        datePublication DATE NOT NULL,
        redacteur VARCHAR(50) NOT NULL,
        cible VARCHAR(50) NOT NULL,
        CHECK (redacteur != cible),
        PRIMARY KEY (identifiant),
        FOREIGN KEY (redacteur) REFERENCES Utilisateur(identifiant),
        FOREIGN KEY (cible) REFERENCES Utilisateur(identifiant))
        ");

    $mot = $db->prepare("
    CREATE TABLE Mot (
        identifiant INTEGER UNSIGNED AUTO_INCREMENT,
        intitule VARCHAR(50),
        PRIMARY KEY (identifiant));
        ");

    $etreSynonymeDe = $db->prepare("
    CREATE TABLE EtreSynonymeDe (
        identifiant INTEGER UNSIGNED AUTO_INCREMENT,
        mot INTEGER UNSIGNED,
        synonyme INTEGER UNSIGNED,
        PRIMARY KEY (identifiant),
        FOREIGN KEY (mot) REFERENCES Mot(identifiant),
        FOREIGN KEY (synonyme) REFERENCES Mot(identifiant));
        ");

    $photo = $db->prepare("
    CREATE TABLE Photo (
        lien VARCHAR(500),
        article INTEGER UNSIGNED,
        PRIMARY KEY (lien),
        FOREIGN KEY (article) REFERENCES Article(identifiant));
        ");

    $panier = $db->prepare("
    CREATE TABLE Panier (
        utilisateur VARCHAR(50),
        article INTEGER UNSIGNED,
        PRIMARY KEY (article, utilisateur),
        FOREIGN KEY (article) REFERENCES Article(identifiant),
        FOREIGN KEY (utilisateur) REFERENCES Utilisateur(identifiant));
    ");

    $notification = $db->prepare("
    CREATE TABLE Notification (
    	identifiant INTEGER UNSIGNED AUTO_INCREMENT,
        utilisateur VARCHAR(50),
        texte VARCHAR(250),
        articleRef INTEGER UNSIGNED,
        PRIMARY KEY (identifiant),
        FOREIGN KEY (utilisateur) REFERENCES Utilisateur(identifiant)
        FOREIGN KEY (articleRef) REFERENCES Article(identifiant));
    ");

    $tables = [$utilisateur, $article, $avis, $mot, $etreSynonymeDe, $photo, $panier, $notification];

    foreach ($tables as $table) {
        $table->execute();
    }
}

function uploadWords($dic) {
    global $db;
    $list = json_decode(file_get_contents($dic), true);
    foreach (array_keys($list) as $word) {
        $statement= $db->prepare("INSERT INTO Mot (intitule) VALUES (?)");
        $statement->execute([$word]);
    }
}

function uploadSynonyms($dic) {
    global $db;
    $list = json_decode(file_get_contents($dic), true);
    foreach (array_keys($list) as $word) {
        $idWord = $db->prepare("SELECT identifiant FROM Mot WHERE intitule = ?");
        $idWord->execute([$word]);
        $idWord = $idWord->fetch();
        $idWord = $idWord["identifiant"];
        foreach ($list[$word] as $synonym) {
            $idSynonym = $db->prepare("SELECT identifiant FROM Mot WHERE intitule = ?");
            $idSynonym->execute([$synonym]);
            $idSynonym = $idSynonym->fetch();
            $idSynonym = $idSynonym["identifiant"];
            $statement= $db->prepare("INSERT INTO EtreSynonymeDe (mot, synonyme) VALUES (?, ?)");
            $statement->execute([$idWord, $idSynonym]);
        }
    }
}
?>