<?php
require("connect.php");
$Con = new PDO('mysql:host=localhost;dbname=bdjoueurs', 'root', '');

class ManagerJoueurs
{
    private $Con;
    public function __Construct($Con)
    {
        $this->SetDb($Con);
    }
    public function setDb(PDO $Con)
    {
        $this->Con = $Con;
    }
    public function recup($info)
    {
        $q = $this->Con->prepare('SELECT id, Nom, Prenom,Score FROM joueurs WHERE Nom=:Nom');
        $q->execute(array(':Nom' => $info));
        return new Joueur($q->fetch(PDO::FETCH_ASSOC));
    }
    public function Max()
    {
        $q = $this->Con->prepare('SELECT id, Nom, Prenom,Score FROM joueurs WHERE Score = {SELECT MAX(Score) FROM joueurs } ');
        $q->execute();
        return new Joueur($q->fetch(PDO::FETCH_ASSOC));
    }



    public function ajouter(joueur $jou)
    {

        $g = $this->Con->prepare('SELECT * FROM joueurs WHERE Nom = :Nom ');
        $g->bindvalue(':Nom', $jou->getNom());
        $g->execute();
        $g->rowcount();
        $r = $g->fetch(PDO::FETCH_ASSOC);
        
        if ($r == 0) {

            $q = $this->Con->prepare('INSERT INTO joueurs(Nom,Prenom) Values (:Nom,:Prenom)');

            $q->bindvalue(':Nom', $jou->getNom());
            $q->bindvalue(':Prenom', $jou->getPrenom());
            $q->execute();
            echo "<span class='msgerror'> " . $jou->getNom()."  " .$jou->getPrenom()." est Creé </span>";
            echo ("<meta http-equiv='refresh' content='1'>");
        } else {
            echo "<span class='msgerror'> " . $jou->getNom()."  " .$jou->getPrenom()." est deja Exist </span>";
        }
    }

    public function mod(joueur $jou)
    {
        $q = $this->Con->prepare('UPDATE joueurs SET Prenom = :Prenom WHERE Nom = :Nom ');

        $q->bindvalue(':Nom', $jou->getNom());
        $q->bindvalue(':Prenom', $jou->getPrenom());
        $q->execute();
        echo ("<meta http-equiv='refresh' content='1'>");
    }


   /* public function Mel(joueur $jou)
    {
        $q = $this->Con->prepare('SELECT Nom,Prenom FROM joueurs WHERE Score = {SELECT MAX(Score) FROM joueurs }');
        $q->execute();
        echo "<span class='msgwin'> " . $jou->getNom() . " Est Gagner </span>";
    } */

    public function test(joueur $jou)
    {
        $q = $this->Con->prepare('SELECT * FROM joueurs WHERE Nom = :Nom ');
        $q->bindvalue(':Nom', $jou->getNom());
        $q->execute();
        $q->rowcount();
        $r = $q;
        return $r;
    }







    public function rech(joueur $jou)
    {
        $jousjous = [];
        $q = $this->Con->prepare('SELECT id, Nom,Prenom FROM joueurs WHERE Nom=:Nom');

        $q->bindvalue(':Nom', $jou->getNom());
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $jousjous[] = new joueur($donnees);
        }
        return $jousjous;
    }
    public function Del(joueur $jou)
    {
        $this->Con->exec('DELETE FROM joueurs where id = ' . $jou->getId());
        echo ("<meta http-equiv='refresh' content='1'>");
    }

    public function check(joueur $jou)
    {
        $random = rand(0, 100);

        if ($random % 2 == 0) {
            $q = $this->Con->prepare('UPDATE joueurs SET Score = Score + 10 WHERE Nom = :Nom And Prenom = :Prenom');
            $q->bindvalue(':Nom', $jou->getNom());

            $q->bindvalue(':Prenom', $jou->getPrenom());
            $q->bindvalue(':Nom', $jou->getNom());
            $q->execute();
            echo "<span class='msgwin'> " . $random . " Est Pair !! Vous avez gagnez +10 Score </span>";
        } else {

            echo "<span class='msg'> " . $random . " Est Impair </span>";
        }
        echo ("<meta http-equiv='refresh' content='1'>");
    }
    public function check1(joueur $jou)
    {
        $random = rand(0, 100);
        echo $random;
        if ($random % 2 == 0) {
            echo "<span class='msg'> " . $random . " Est Pair </span>";
        } else {

            $q = $this->Con->prepare('UPDATE joueurs SET Score = Score + 10 WHERE Nom = :Nom And Prenom = :Prenom');
            $q->bindvalue(':Nom', $jou->getNom());
            $q->bindvalue(':Prenom', $jou->getPrenom());
            $q->bindvalue(':Nom', $jou->getNom());
            $q->execute();
            echo "<span class='msgwin'> " . $random . " est Impair !! <br> Vous avez gagnez +10 Score </span>";
        }
        echo ("<meta http-equiv='refresh' content='1'>");
    }
}





?>