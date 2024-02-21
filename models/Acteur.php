<?php
require_once('MonPDO.php');
ob_start();

class Acteur
{
    
    public function getListFilm()
    {
        
        if($monPDO)
        {
            $req = 'SELECT CONCAT(nom, " ", prenom) AS "nom"
                    FROM acteur a
                    INNER JOIN personne p ON p.id_acteur = a.id_acteur
                    ';
        $stmt =$monPDO->prepare($req);
        $stmt->execute();
        $acteurs = $stmt->fetchAll();
    }
    return $acteurs;
    }

}






$content = ob_get_clean();
require_once('../views/Template.php');
