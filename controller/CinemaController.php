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
                                        WHERE id_film = :id");
            $requete->execute(["id" => $id]);
            $requete = $pdo->prepare("SELECT *
                                        FROM acteur a
                                        INNER JOIN personne p ON p.id_personne = a.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN film f ON f.id_film = j.id_film
                                        INNER JOIN role r ON r.id_role = j.id_role
                                        WHERE a.id_acteur = :id");
            $requete->execute(["id" => $id]);
            require 'view/detailActeur.php';
        }

        public function listRealisateur()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT CONCAT(nom, ' ', prenom) AS nomPrenom
                                        FROM realisateur r
                                        INNER JOIN personne p ON p.id_personne = r.id_personne
                                        ORDER BY nomPrenom");
            require 'view/listRealisateur.php';
        }

        public function listGenreFilm()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT g.libelle
                                        FROM genre_film g
                                        ORDER BY g.libelle");
            require 'view/listGenreFilm.php';
        }

        public function listRole()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT r.nom_role 
                                        FROM personne p
                                        INNER JOIN acteur a ON a.id_personne = p.id_personne
                                        INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                        INNER JOIN role r ON r.id_role = j.id_role
                                        ORDER BY r.nom_role");
            require 'view/listRole.php';
        }
            
    }