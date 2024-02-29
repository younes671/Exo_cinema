<?php 
    namespace Controller;
    use Model\Connect;

    class FilmController
    {
        public function listFilms()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT titre, annee_sortie, id_film
                                        FROM film");
            require 'view/listFilms.php';
        }

        public function detailFilm($id) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT * 
                                        FROM film f
                                        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                        WHERE id_film = :id");
            $requete->execute(["id" => $id]);

            $reqCasting = $pdo->prepare("SELECT p.nom, p.prenom, r.nom_role
                                            FROM film f
                                            INNER JOIN jouer j ON j.id_film =f.id_film
                                            INNER JOIN acteur a ON a.id_acteur = j.id_acteur
                                            INNER JOIN personne p ON p.id_personne = a.id_personne
                                            INNER JOIN role r ON r.id_role = j.id_role
                                            WHERE j.id_film = :id");
            $reqCasting->execute(["id" => $id]);

            require 'view/detailFilm.php';
        }

        public function addFilm()
        {
            $pdo = Connect::seConnecter();
            $req_list = $pdo->prepare("SELECT * FROM realisateur r
                                            INNER JOIN personne p ON p.id_personne = r.id_personne");
            $req_list->execute();

            $req_genre = $pdo->prepare("SELECT DISTINCT id_genre, libelle 
                                                FROM genre_film");
            $req_genre->execute();

            if(isset($_POST['submit']))
            {
                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // filter_sanitize.. empeche injection code html
                $annee_sortie = filter_input(INPUT_POST, "annee_sortie", FILTER_VALIDATE_INT); 
                $duree = filter_input(INPUT_POST, "duree", FILTER_VALIDATE_INT); // valide que si la saisie est nb entier
                $affiche = filter_input(INPUT_POST, "affiche", FILTER_VALIDATE_URL);
                $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT);
                $realisateur = filter_input(INPUT_POST, "realisateurs", FILTER_VALIDATE_INT);
                
                
               
                if($titre && $annee_sortie && $duree && $affiche && $synopsis && $note && $realisateur) {
                   
                   
                   
                    $requete = $pdo->prepare("INSERT INTO film (titre, annee_sortie, duree, affiche, synopsis, note, id_realisateur) 
                                                VALUES (:titre, :annee_sortie, :duree, :affiche, :synopsis, :note, :id_realisateur)");
                    $requete->bindParam(':titre', $titre);
                    $requete->bindParam(':annee_sortie', $annee_sortie);
                    $requete->bindParam(':duree', $duree);
                    $requete->bindParam(':affiche', $affiche);
                    $requete->bindParam(':synopsis', $synopsis);
                    $requete->bindParam(':note', $note);
                    $requete->bindParam(':id_realisateur', $realisateur);
                    $requete->execute();
                    echo "<h2>Le film a été ajouté avec succès.</h2>";
                    }else{echo "<h2>Le film n'a pas été ajouté</h2>";
                    }
            }
       
        
            require 'view/ajouterFilm.php';
        }


        public function deleteFilm($id)
        {
            $pdo = Connect::seConnecter();
                
            $id_film = filter_input(INPUT_GET, "id_film", FILTER_VALIDATE_INT);
            $req_id_film = $pdo->prepare("SELECT id_film FROM typer WHERE id_film = :id");
            $req_id_film->execute(['id' => $id]);
            $req_id_genre = $req_id_film->fetch();
            

            $requete_jouer = $pdo->prepare("DELETE FROM jouer WHERE id_film = :id");
            $requete_jouer->execute(["id" => $id]);

            $requete_typer = $pdo->prepare("DELETE FROM typer WHERE id_film = :id");
            $requete_typer->execute(["id" => $id]);

            $requete_film = $pdo->prepare("DELETE FROM film WHERE id_film = :id");
            $requete_film->execute(['id' => $req_id_genre['id_film']]);

            
            $this->listFilms();
            echo "<h2>Le film a été supprimé avec succès</h2>";
        }

        public function modifyFilm()
        {
            $pdo = Connect::seConnecter();

            $id_film = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
            

            $info_film = $pdo->prepare("SELECT * 
                                                        FROM film f
                                                        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
                                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                                        WHERE f.id_film = :id");
                        $info_film->execute(['id' => $id_film]);
           
            if(isset($_POST['submit']))
            {
                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // filter_sanitize.. empeche injection code html
                $annee_sortie = filter_input(INPUT_POST, "annee_sortie", FILTER_VALIDATE_INT); 
                $duree = filter_input(INPUT_POST, "duree", FILTER_VALIDATE_INT); // valide que si la saisie est nb entier
                $affiche = filter_input(INPUT_POST, "affiche", FILTER_VALIDATE_URL);;
                $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
                $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT);
                $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_VALIDATE_INT);
                
                
                if($titre && $annee_sortie && $duree && $affiche && $synopsis && $note && $realisateur) {
                    
                    $id_film = filter_input(INPUT_POST, "id_film", FILTER_VALIDATE_INT);

                    
                    // var_dump($id_film);
                    
                    // exit;
                    if($id_film)
                    {
                        $requete = $pdo->prepare("UPDATE film SET titre = :titre, annee_sortie = :annee_sortie, duree = :duree, affiche = :affiche, synopsis = :synopsis, note = :note, id_realisateur = :id_realisateur 
                                                    WHERE id_film = :id_film");
                        $requete->bindParam(':titre', $titre);
                        $requete->bindParam(':annee_sortie', $annee_sortie);
                        $requete->bindParam(':duree', $duree);
                        $requete->bindParam(':affiche', $affiche);
                        $requete->bindParam(':synopsis', $synopsis);
                        $requete->bindParam(':note', $note);
                        $requete->bindParam(':id_realisateur', $realisateur);
                        $requete->bindParam(':id_film', $id_film);
                        $requete->execute();
                        echo "<h2>Le film a été modifié avec succès.</h2>";
                    }else{echo "<h2>Le film n'a pas été modifié</h2>";
                    }
                }
                
            }
            require 'view/modifierFilm.php';
       
        
        }


    }
    
