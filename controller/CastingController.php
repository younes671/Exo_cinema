<?php 
    namespace Controller;
    use Model\Connect;

    class CastingController
    {

        public function addCasting()
        {
            $pdo = Connect::seConnecter();

            $req_casting_film = $pdo->prepare("SELECT *
                                                    FROM film
                                                    ORDER BY titre"); 
            $req_casting_film->execute();

            $req_casting_acteur = $pdo->prepare("SELECT *
                                                    FROM acteur a
                                                    INNER JOIN personne p ON p.id_personne = a.id_personne
                                                    ORDER BY p.nom");
            $req_casting_acteur->execute();

            $req_casting_role = $pdo->prepare("SELECT*
                                                    FROM role
                                                    ORDER BY nom_role");
            $req_casting_role->execute();
            
            if(isset($_POST['submit']))
            {
                
                $film = filter_input(INPUT_POST, "id_film", FILTER_VALIDATE_INT); 
                $acteur = filter_input(INPUT_POST, "id_acteur", FILTER_VALIDATE_INT); 
                $role = filter_input(INPUT_POST, "id_role", FILTER_VALIDATE_INT);
                
                //Le cross-site scripting (abrégé XSS) est un type de faille de sécurité des sites web permettant d'injecter du contenu dans une page, 
                // provoquant ainsi des actions sur les navigateurs web visitant la page. 
                // Les possibilités des XSS sont très larges puisque l'attaquant peut utiliser tous les langages pris en charge par le navigateur (JavaScript, Java...) 
                // et de nouvelles possibilités sont régulièrement découvertes notamment avec l'arrivée de nouvelles technologies comme HTML5.  
                // donner autres méthodes 

                
                
               
                if($film && $acteur && $role) {
                   
                  
                    // injection SQL signification et définition Une injection SQL, parfois abrégée en SQLi, 
                    // est un type de vulnérabilité dans lequel un pirate utilise un morceau de code SQL 
                    // (« Structured Query Language », langage de requête structuré) pour manipuler une base de données et accéder à des informations potentiellement importantes.
                    // requête préparée : préparation , compilation et execution 

                    $requete = $pdo->prepare("INSERT INTO jouer (id_film, id_acteur, id_role) 
                                                VALUES (:id_film, :id_acteur, :id_role)");
                    $requete->bindParam(':id_film', $film);
                    $requete->bindParam(':id_acteur', $acteur);
                    $requete->bindParam(':id_role', $role);
                    $requete->execute();
                    echo "<h2>Le casting a été ajouté avec succès.</h2>";
                    }else{echo "Le casting n'a pas été ajouté";
                    }
            }
       
        
            require 'view/ajouterCasting.php';
        }

    }
