<!DOCTYPE html>
<html lang="fr">
    <body>
        <header>
            <h1 style='color:red'>Trocali</h1>
        </header>
        <main>
            <?php
            include "index.php";


            $req = $bdd->prepare("SELECT * FROM Playlist");
            $req->execute();
            $resultat = $req->fetchAll();
            echo "<br>";
            foreach ($resultat as $rows) {
                $contenu = 
                    "<!DOCTYPE html>
                        <html lang='fr'>
                        <body>
                            <header>
                                <h1 style='color:red'>Trocali</h1>
                            </header>
                            <main>
                                <h2>".$rows[1]."</h2>";
                $req = $bdd->prepare("SELECT * FROM Musique INNER JOIN Tuple ON Musique.id_musique = Tuple.id_musique WHERE id_playlist = ".$rows[0]);
                $req->execute();
                $resultat2 = $req->fetchAll();
                foreach ($resultat2 as $rows2) {
                    $contenu = $contenu."<span style=' font-weight: bold'>".$rows2[1]."</span> <span style= 'font-style: italic'>".$rows2[2]."</span> <span style= 'font-style: normal'>".$rows2[3]."</span><br>";
                }
                $contenu = $contenu."<br><a href='pagePlaylist.php'><p> <-Retour </p></a></main></body></html>";
                file_put_contents($rows[1].".php", $contenu);
                echo "<a href=".$rows[1].".php><span style=' font-weight: bold'>".$rows[0]."</span></a> <span style= 'font-style: italic'>".$rows[2]."</span><br>";
            }
            ?> 
        </main>
    </body>
</html>

