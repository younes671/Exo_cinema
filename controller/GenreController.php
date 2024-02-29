<?php 
    namespace Controller;
    use Model\Connect;

    class GenreController
    {


        
        public function listGenreFilm()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT *
                                        FROM genre_film g
                                        ORDER BY g.libelle");
            require 'view/listGenreFilm.php';
        }

        public function detailGenreFilm($id)
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT *
                                        FROM genre_film gf
                                        WHERE gf.id_genre = :id");
            $requete->execute(["id" => $id]);
            $film = $pdo->prepare("SELECT *
                                    FROM film f
                                    INNER JOIN typer t ON t.id_film = f.id_film
                                    INNER JOIN genre_film gf ON gf.id_genre = t.id_genre
                                    WHERE gf.id_genre = :id");
            $film->execute(["id" => $id]);
            
            require 'view/detailGenreFilm.php';
        }

        public function addGenre()
        {
            $pdo = Connect::seConnecter();
            if(isset($_POST['submit']))
            {
                $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                
                try {
                    // 1. Insérer les données dans la table `personne`
                    $requete = $pdo->prepare("INSERT INTO genre_film (libelle) VALUES (:libelle)");
                    $requete->bindParam(':libelle', $libelle);
                    $requete->execute();
                    echo "<h2>Le genre a été ajouté avec succès.</h2>";
                    
                } catch (\PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
            require 'view/ajouterGenre.php';
        }

        public function deleteGenre($id)
        {
        $pdo = Connect::seConnecter();
        
        try {
             
            
            $req_genre = $pdo->prepare("DELETE FROM genre_film WHERE id_genre = :id");
            $req_genre->execute(['id' => $id]);

            $this->listGenreFilm();
        
            echo "<h2>Le genre a été supprimés avec succès.</h2>";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
           
        }

        public function modifyGenre($id)
        {
            $pdo = Connect::seConnecter();

            $id_genre = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            $info_genre = $pdo->prepare("SELECT * 
                                                FROM genre_film
                                                WHERE id_genre = :id");
            $info_genre->execute(['id' => $id_genre]);

            if(isset($_POST['submit']))
            {
            $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            try {
    
                
                
                $id_genre = filter_input(INPUT_POST, "id_genre", FILTER_VALIDATE_INT);
                // var_dump($_POST);
                // exit;
                
                
                
                $requete = $pdo->prepare("UPDATE genre_film SET libelle = :libelle 
                                                        WHERE id_genre = :id");
                 $requete->bindParam(':libelle', $libelle);
                 $requete->bindParam(':id', $id_genre);
                 $requete->execute();
                
                
                echo "<h2>Les informations ont été mis à jour avec succès.</h2>";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            }
            require 'view/modifierGenre.php';
        }
    }