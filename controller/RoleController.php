<?php 
    namespace Controller;
    use Model\Connect;

    class RoleController
    {

        // récupère liste roles

        public function listRole()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("    SELECT DISTINCT id_role, nom_role 
                                        FROM role
                                        ORDER BY nom_role");
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
            $acteurs = $pdo->prepare("SELECT * 
                                    FROM personne p
                                    INNER JOIN acteur a ON a.id_personne = p.id_personne
                                    INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                    INNER JOIN film f ON f.id_film = j.id_film
                                    INNER JOIN role r ON r.id_role = j.id_role
                                    WHERE r.id_role = :id");
            $acteurs->execute(["id" => $id]);
            
            require 'view/detailRole.php';
        }

         //rajoute role

        public function addRole()
        {
            $pdo = Connect::seConnecter();
            if(isset($_POST['submit']))
            {
                $nom_role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                
                try {
                    
                    $requete = $pdo->prepare("INSERT INTO role (nom_role) VALUES (:nom_role)");
                    $requete->bindParam(':nom_role', $nom_role);
                    $requete->execute();
                    echo "<h2>Le role a été ajouté avec succès.</h2>";
                    
                } catch (\PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
            require 'view/ajouterRole.php';
        }

         //supprime role

        public function deleteRole($id)
        {
        $pdo = Connect::seConnecter();
        
        try {
             
            
            $req = $pdo->prepare("DELETE FROM role WHERE id_role = :id");
            $req->execute(['id' => $id]);

            $this->listRole();
        
            echo "<h2>Le role a été supprimés avec succès.</h2>";
        } catch (\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
           
        }

         //modifie, met à jour infos role

        public function modifyRole($id)
        {
            $pdo = Connect::seConnecter();

            $id_role = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            $info_role = $pdo->prepare("SELECT * 
                                                FROM role
                                                WHERE id_role = :id");
            $info_role->execute(['id' => $id_role]);

            if(isset($_POST['submit']))
            {
            $nom_role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            try {
    
                
                
                $id_role = filter_input(INPUT_POST, "id_role", FILTER_VALIDATE_INT);
                // var_dump($_POST);
                // exit;
                
                
                
                $requete = $pdo->prepare("UPDATE role SET nom_role = :nom_role 
                                                        WHERE id_role = :id");
                 $requete->bindParam(':nom_role', $nom_role);
                 $requete->bindParam(':id', $id_role);
                 $requete->execute();
                
                
                echo "<h2>Les informations ont été mis à jour avec succès.</h2>";
            } catch (\PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            }
            require 'view/modifierRole.php';
        }


    }
