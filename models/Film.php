<?php
require_once('controllers/Router.php');
    class Film
    {
        private $id_film;
        private $titre;
        private $annee_sortie;
        private $duree;
        private $affiche;
        private $synopsis;
        private $note;
        
       

        // setters
        public function setIdFilm($id_film)
        {
            $id_film = (int) $this->id_film;
            
            if($id_film > 0)
                $this->id_film = $id_film;
        }


        public function setTitre($titre)
        {
            if(is_string($titre))
                $this->titre = $titre;
        }

        public function setAnneeSortie($annee_sortie)
        {
            $annee_sortie = (int) $annee_sortie;

            if(($annee_sortie > 0))
                $this->annee_sortie = $annee_sortie;
        }

        public function setDuree($duree)
        {
            $duree = (int) $duree;

            if(($duree > 0))
                $this->duree = $duree;
        }

        public function setAffiche($affiche)
        {
            if(is_string($affiche))
                $this->affiche = $affiche;
        }

        public function setSynopsis($synopsis)
        {
            if(is_string($synopsis))
                $this->synopsis = $synopsis;
        }

        public function setNote($note)
        {
            $note = (int) $note;

            if($note > 0)
                $this->note = $note;
        }

        //getters
        public function getIdFilm()
        {
            return $this->id_film;
        }

        public function getTitre()
        {
            return $this->titre;
        }

        public function getAnneeSortie()
        {
            return $this->annee_sortie;
        }

        public function getDuree()
        {
            return $this->duree;
        }

        public function getAffiche()
        {
            return $this->affiche;
        }

        public function getSynopsis()
        {
            return $this->synopsis;
        }

        public function getNote()
        {
            return $this->note;
        }

        
    }