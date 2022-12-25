<?php
class joueur
{

    protected $id;
    protected $Nom;
    protected $Prenom;
    protected $Score ;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {

            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->Nom;
    }
    public function getPrenom()
    {
        return $this->Prenom;
    }
    
    public function getScore(){
        return $this->Score ;
    }
 
    
  
   
    public function afficheJouer(){
        echo "Le joueur numero:  = " .$this->getId()."     appele    = ".$this->getPrenom()."  ".$this->getNom() ."<br>";
        
    }
   
}

?>