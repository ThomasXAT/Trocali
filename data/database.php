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
        Identifiant VARCHAR(50) PRIMARY KEY,
        nom VARCHAR(50),
        prenom VARCHAR(50),
        email VARCHAR(50),
        administrateur BOOLEAN NOT NULL,
        mdp VARCHAR(100) NOT NULL);
        ");

    $article = $db->prepare("
    CREATE TABLE Article (
        identifiant INTEGER UNSIGNED PRIMARY KEY,
        titre VARCHAR(50) NOT NULL,
        type VARCHAR(50) NOT NULL
        CHECK (type = ‘Offre’ OR type = ‘Demande’),
        categorie VARCHAR(50),
        description VARCHAR(1000),
        moyenPaiement VARCHAR(50)
        CHECK (moyenPaiement = 'Argent' 
        OR moyenPaiement = 'Troc' 
        OR moyenPaiement = ‘Argent & Troc’),
        prix DOUBLE UNSIGNED,
        troc VARCHAR(1000),
        auteur VARCHAR(50) NOT NULL,
        datePublication TIMESTAMP NOT NULL,
        acheteur VARCHAR(50),
        dateAchat DATE,
        masque BOOLEAN,
        FOREIGN KEY (auteur) REFERENCES Utilisateur(Identifiant),
        FOREIGN KEY (acheteur) REFERENCES Utilisateur(Identifiant));
        ");

    $avis = $db->prepare("
    CREATE TABLE Avis (
        identifiant INTEGER UNSIGNED PRIMARY KEY,
        note INTEGER UNSIGNED NOT NULL 
        CHECK (Note BETWEEN 1 AND 10),
        description VARCHAR(50),
        datePublication DATE NOT NULL,
        redacteur VARCHAR(50) NOT NULL,
        cible VARCHAR(50) NOT NULL
        CHECK (cible != redacteur),
        FOREIGN KEY (redacteur) REFERENCES Utilisateur(Identifiant),
        FOREIGN KEY (cible) REFERENCES Utilisateur(Identifiant));
        ");

    $mot = $db->prepare("
    CREATE TABLE Mot (
        intitule VARCHAR(50) PRIMARY KEY);
        ");

    $etreSynonymeDe = $db->prepare("
    CREATE TABLE EtreSynonymeDe (
        mot VARCHAR(50),
        synonyme VARCHAR(50),
        PRIMARY KEY (Mot, Synonyme),
        FOREIGN KEY (mot) REFERENCES Mot(Intitule),
        FOREIGN KEY (synonyme) REFERENCES Mot(Intitule));
        ");

    $photo = $db->prepare("
    CREATE TABLE Photo (
        lien VARCHAR(100),
        article INTEGER UNSIGNED,
        PRIMARY KEY (lien),
        FOREIGN KEY (article) REFERENCES Article(Identifiant));
        ");

    $tables = [$utilisateur, $article, $avis, $mot, $etreSynonymeDe, $photo];
    foreach ($tables as $table) {
        $table->execute();
    }
    uploadWords("dicSynonymes.json");
}

function uploadWords($dic) {
    global $db;
    $list = json_decode(file_get_contents($dic), true);
    foreach (array_keys($list) as $word) {
        $statement= $db->prepare("INSERT INTO Mot (intitule) VALUES (?)");
        $statement->execute([$word]);
        foreach ($list[$word] as $synonym) {
            $statement= $db->prepare("INSERT INTO EtreSynonymeDe (mot, synonyme) VALUES (?, ?)");
            $statement->execute([$word, $synonym]);
        }
    }
}
?>