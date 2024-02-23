<?php 
    namespace Controller;
    use Model\Connect;

    class CinemaController
    {
        public function listFilms()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT titre, annee_sortie
                                    FROM film");
            require 'view/listFilms.php';
        }

        public function listActeurs()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("SELECT CONCAT(p.nom, ' ', p.prenom) AS nomPrenom
                                    FROM acteur a
                                    INNER JOIN personne p ON p.id_personne = a.id_personne");
            $requete->execute();
            require 'view/listActeurs.php';
        }

        public function listRealisateur()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT CONCAT(nom, ' ', prenom) AS nomPrenom
                                    FROM realisateur r
                                    INNER JOIN personne p ON p.id_personne = r.id_personne");
            require 'view/listRealisateur.php';
        }

        public function listGenreFilm()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT gf.libelle
                                    FROM film f
                                    RIGHT JOIN typer t ON t.id_film = f.id_film
                                    RIGHT JOIN genre_film gf ON gf.id_genre = t.id_film");
            require 'view/listGenreFilm.php';
        }

        public function listRole()
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->query("SELECT CONCAT(p.nom, ' ', p.prenom) AS nomPrenom, r.nom_role 
                                    FROM personne p
                                    INNER JOIN acteur a ON a.id_personne = p.id_personne
                                    INNER JOIN jouer j ON j.id_acteur = a.id_acteur
                                    INNER JOIN role r ON r.id_role = j.id_role");
            require 'view/listRole.php';
        }
            
    }