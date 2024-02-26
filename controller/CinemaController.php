<?php 
    namespace Controller;
    use Model\Connect;

    class CinemaController
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


        public function listActeurs()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT *
                                        FROM acteur a
                                        INNER JOIN personne p ON p.id_personne = a.id_personne
                                        ORDER BY a.id_acteur ");
            $requete->execute();
            require 'view/listActeurs.php';
        }

        public function detailActeur($id) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT * 
                                        FROM film f
                                        INNER JOIN jouer j ON j.id_film = f.id_film
                                        INNER JOIN acteur a ON a.id_acteur = j.id_acteur
                                        INNER JOIN personne p ON p.id_personne = a.id_personne
                                        WHERE a.id_acteur = :id");
            $requete->execute(["id" => $id]);
            $reqPlay = $pdo->prepare("SELECT *
                                        FROM acteur a
                                        INNER JOIN personne p ON p.id_personne = a.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN film f ON f.id_film = j.id_film
                                        INNER JOIN role r ON r.id_role = j.id_role
                                        WHERE a.id_acteur = :id");
            $reqPlay->execute(["id" => $id]);
            require 'view/detailActeur.php';
        }

        public function listRealisateur()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT *
                                        FROM realisateur r
                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                        ORDER BY prenom");
            require 'view/listRealisateur.php';
        }

        public function detailRealisateur($id)
        {
            $pdo = Connect::seConnecter();
            $realisation = $pdo->prepare("SELECT * 
                                        FROM film f
                                        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                        WHERE r.id_realisateur = :id");
            $realisation->execute(["id" => $id]);
            $requete = $pdo->prepare("SELECT * 
                                        FROM realisateur r
                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                        WHERE r.id_realisateur = :id");
            $requete->execute(["id" => $id]);
            
            require 'view/detailRealisateur.php';
        }

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

        public function listRole()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT * 
                                        FROM personne p
                                        INNER JOIN acteur a ON a.id_personne = p.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN role r ON r.id_role = j.id_role
                                        ORDER BY r.nom_role");
            require 'view/listRole.php';
        }

        public function detailRole($id)
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT * 
                                        FROM personne p
                                        INNER JOIN acteur a ON a.id_personne = p.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN role r ON r.id_role = j.id_role
                                        WHERE r.id_role = :id");
            $requete->execute(["id" => $id]);
            $acteur = $pdo->prepare("SELECT * 
                                    FROM personne p
                                    INNER JOIN acteur a ON a.id_personne = p.id_personne
                                    INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                    INNER JOIN role r ON r.id_role = j.id_role
                                    WHERE r.id_role = :id");
            $acteur->execute(["id" => $id]);
            
            require 'view/detailRole.php';
        }

        public function addFilm()
        {
            $pdo = Connect::seConnecter();
            $req_list = $pdo->prepare("SELECT * FROM realisateur r
                                            INNER JOIN personne p ON p.id_personne = r.id_personne");
            $req_list->execute();

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
                    echo "Le film a été ajouté avec succès.";
                    }else{echo "Le film n'a pas été ajouté";
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
            echo "Le film a été supprimé avec succès";
        }

        public function modifyFilm()
        {
            $pdo = Connect::seConnecter();
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
                        echo "Le film a été modifié avec succès.";
                    }else{echo "Le film n'a pas été modifié";
                    }
                }
                
            }
            require 'view/modifierFilm.php';
       
        
        }
              


        public function addActeur()
        {
            $pdo = Connect::seConnecter();
            if(isset($_POST['submit']))
            {
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
                
                try {
                    // 1. Insérer les données dans la table `personne`
                    $requete_personne = $pdo->prepare("INSERT INTO personne (nom, prenom, sexe, date_naissance) VALUES (:nom, :prenom, :sexe, :date_naissance)");
                    $requete_personne->bindParam(':nom', $nom);
                    $requete_personne->bindParam(':prenom', $prenom);
                    $requete_personne->bindParam(':sexe', $sexe);
                    $requete_personne->bindParam(':date_naissance', $date_naissance);
                    $requete_personne->execute();
                
                    // 2. Récupérer l'ID de la personne nouvellement insérée
                    $id_personne = $pdo->lastInsertId();
                
                    // 3. Insérer les données dans la table `acteur`
                    $requete_acteur = $pdo->prepare("INSERT INTO acteur (id_personne) VALUES (:id_personne)");
                    $requete_acteur->bindParam(':id_personne', $id_personne);
                    $requete_acteur->execute();
                
                    echo "L'acteur a été ajouté avec succès.";
                } catch (\PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
            require 'view/ajouterActeur.php';
        }

    public function deleteActeur($id)
    {
    $pdo = Connect::seConnecter();
    
    try {
         // Sélectionner l'id de la personne associée à l'acteur
         $requete_id_acteur = $pdo->prepare("SELECT id_personne FROM acteur WHERE id_acteur = :id");
         $requete_id_acteur->execute(['id' => $id]);
         $requete_id_personne = $requete_id_acteur->fetch();

        // Supprimer l'acteur de la table jouer
        $requete_jouer = $pdo->prepare("DELETE FROM jouer WHERE id_acteur = :id");
        $requete_jouer->execute(["id" => $id]);
        
        // Supprimer l'acteur de la table acteur
        $requete_acteur = $pdo->prepare("DELETE FROM acteur WHERE id_acteur = :id");
        $requete_acteur->execute(["id" => $id]);

        // Supprimer la personne associée à l'acteur de la table personne
        $requete_personne = $pdo->prepare("DELETE FROM personne WHERE id_personne = :id");
        $requete_personne->execute(["id" => $requete_id_personne['id_personne']]);
        $this->listActeurs();
        echo "L'acteur et toutes ses références ont été supprimés avec succès.";
    } catch (\PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
        require 'view/listActeurs.php';
    }


       
    public function modifyActeur()
    {
        $pdo = Connect::seConnecter();
        if(isset($_POST['submit']))
        {
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
        try {
            
            $id_acteur = filter_input(INPUT_POST, "id_acteur", FILTER_VALIDATE_INT);
        //   var_dump($_POST['id_acteur']);
        //   exit;
            
            $requete_personne = $pdo->prepare("UPDATE personne SET nom = $nom, prenom = $prenom, sexe = $sexe, date_naissance = $date_naissance 
                                                    WHERE id_personne = $id_acteur");
            
            $requete_personne->execute();
            
            
            
            echo "Les informations ont été mis à jour avec succès.";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        }
        require 'view/modifierActeur.php';
    }



    public function addrealisateur()
    {
        $pdo = Connect::seConnecter();
        if(isset($_POST['submit']))
        {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
            
            try {
                // 1. Insérer les données dans la table `personne`
                $requete_personne = $pdo->prepare("INSERT INTO personne (nom, prenom, sexe, date_naissance) VALUES (:nom, :prenom, :sexe, :date_naissance)");
                $requete_personne->bindParam(':nom', $nom);
                $requete_personne->bindParam(':prenom', $prenom);
                $requete_personne->bindParam(':sexe', $sexe);
                $requete_personne->bindParam(':date_naissance', $date_naissance);
                $requete_personne->execute();
            
                // 2. Récupérer l'ID de la personne nouvellement insérée
                $id_personne = $pdo->lastInsertId();
            
                // 3. Insérer les données dans la table `acteur`
                $requete_acteur = $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
                $requete_acteur->bindParam(':id_personne', $id_personne);
                $requete_acteur->execute();
            
                echo "Le realisateur a été ajouté avec succès.";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
        require 'view/ajouterRealisateur.php';
    }

    public function deleteRealisateur($id)
    {
    $pdo = Connect::seConnecter();
    
    try {
         // Sélectionner l'id de la personne associée au realisateur
         $requete_id_realisateur = $pdo->prepare("SELECT id_personne FROM realisateur WHERE id_realisateur = :id");
         $requete_id_realisateur->execute(['id' => $id]);
         $requete_id_personne = $requete_id_realisateur->fetch();

         

         $req_id_film =$pdo->prepare("SELECT id_film FROM film WHERE id_realisateur = :id");
         $req_id_film->execute(['id' => $id]);
         $requete_id_film = $req_id_film->fetch();
        
        $req_jouer = $pdo->prepare("SELECT id_film FROM jouer WHERE id_film = :id");
        $req_jouer->execute(['id' => $requete_id_film['id_film']]);

        $req_typer =$pdo->prepare("DELETE FROM typer WHERE id_film = :id");
        $req_typer->execute(['id' => $requete_id_film['id_film']]);

        // Supprimer le realisateur de la table film
        $requete_film = $pdo->prepare("DELETE FROM film WHERE id_realisateur = :id");
        $requete_film->execute(["id" => $id]);

        
        // Supprimer le realisateur de la table realisateur
        $requete_acteur = $pdo->prepare("DELETE FROM realisateur WHERE id_realisateur = :id");
        $requete_acteur->execute(["id" => $id]);

        // Supprimer la personne associée au realisateur de la table personne
        $requete_personne = $pdo->prepare("DELETE FROM personne WHERE id_personne = :id");
        $requete_personne->execute(["id" => $requete_id_personne['id_personne']]);
        $this->listRealisateur();
    
        echo "Le realisateur et toutes ses références ont été supprimés avec succès.";
    } catch (\PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
       
    }

    public function modifyRealisateur($id)
    {
        $pdo = Connect::seConnecter();
        if(isset($_POST['submit']))
        {
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
        try {

           
            
            $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT);
            
            
            
            $requete_personne = $pdo->prepare("UPDATE personne SET nom = $nom, prenom = $prenom, sexe = $sexe, date_naissance = $date_naissance 
                                                    WHERE id_personne = :id");
            
            $requete_personne->execute(['id' => $id_realisateur]);
            
            
            
            $this->listRealisateur();
            echo "Les informations ont été mis à jour avec succès.";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        }
        require 'view/modifierRealisateur.php';
    }
        

            
    }