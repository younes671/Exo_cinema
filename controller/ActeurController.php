<?php 
    namespace Controller;
    use Model\Connect;


    class ActeurController
    {

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
                
                    echo "<h2>L'acteur a été ajouté avec succès.</h2>";
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
            echo "<h2>L'acteur et toutes ses références ont été supprimés avec succès.</h2>";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
            require 'view/listActeurs.php';
        }


        
        public function modifyActeur()
        {
            $pdo = Connect::seConnecter();

            $id_acteur = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            $info_acteur = $pdo->prepare("SELECT * 
                                                FROM acteur a
                                                INNER JOIN personne p ON p.id_personne = a.id_personne
                                                WHERE a.id_acteur = :id");
            $info_acteur->execute(['id' => $id_acteur]);

            if(isset($_POST['submit']))
            {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
            try {
                
                $id_acteur = filter_input(INPUT_POST, "id_acteur", FILTER_VALIDATE_INT);
            
            
                
                $requete_personne = $pdo->prepare("UPDATE personne SET nom = :nom, prenom = :prenom, sexe = :sexe, date_naissance = :date_naissance 
                                                        WHERE id_personne = :id");
                $requete_personne->bindParam(':nom', $nom);
                $requete_personne->bindParam(':prenom', $prenom);
                $requete_personne->bindParam(':sexe', $sexe);
                $requete_personne->bindParam(':date_naissance', $date_naissance);
                $requete_personne->bindParam(':id', $id_acteur);
                $requete_personne->execute();
                
                
                
                echo "<h2>Les informations ont été mis à jour avec succès.</h2>";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            }
            require 'view/modifierActeur.php';
        }

    }