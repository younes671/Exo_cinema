<?php 
    namespace Controller;
    use Model\Connect;


    class RealisateurController
    {

        // récupère liste realisateur

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

         //rajoute realisateur

        public function addRealisateur()
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
                    $requete = $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
                    $requete->bindParam(':id_personne', $id_personne);
                    $requete->execute();
                
                    echo "<h2>Le realisateur a été ajouté avec succès.</h2>";
                } catch (\PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
            require 'view/ajouterRealisateur.php';
        }

         //supprime realisateur
    
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
        
            echo "<h2>Le realisateur et toutes ses références ont été supprimés avec succès.</h2>";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
           
        }

         //modifie, met à jour infos realisateur
    
        public function modifyRealisateur($id)
        {
            $pdo = Connect::seConnecter();

            $id_realisateur = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            $info_realisateur = $pdo->prepare("SELECT * 
                                                FROM realisateur r
                                                INNER JOIN personne p ON p.id_personne = r.id_personne
                                                WHERE r.id_realisateur = :id");
            $info_realisateur->execute(['id' => $id_realisateur]);

            if(isset($_POST['submit']))
            {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            try {
    
                
                
                $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT);
                // var_dump($_POST);
                // exit;
                
                
                
                $requete = $pdo->prepare("UPDATE personne SET nom = :nom, prenom = :prenom, sexe = :sexe, date_naissance = :date_naissance 
                                                        WHERE id_personne = :id");
                 $requete->bindParam(':nom', $nom);
                 $requete->bindParam(':prenom', $prenom);
                 $requete->bindParam(':sexe', $sexe);
                 $requete->bindParam(':date_naissance', $date_naissance);
                 $requete->bindParam(':id', $id_realisateur);
                 $requete->execute();
                
                
                
                echo "<h2>Les informations ont été mis à jour avec succès.</h2>";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            }
            require 'view/modifierRealisateur.php';
        }

    }