<?php

class Personnage
{
// Declaration de variable
  protected $_nomPersonnage;
  protected $_pointDeDefense;
  protected $_pointDAttaque;
  protected $_pointDAttaqueINFO;
  protected $_pointDeVie;


  //Initialisation de notre Classe
  public function __construct($nomPersonnage) {
    $this->_nomPersonnage = $nomPersonnage;
    $this->_pointDeDefense;
    $this->_pointDAttaque;
    $this->_pointDAttaqueINFO;
    $this->_pointDeVie;
  }

  public function getnomPersonnage(){
    return $this->_nomPersonnage;
  }

  public function getpointDeDefense(){
    return $this->_pointDeDefense;
  }

  public function getpointDAttaque(){
    return $this->_pointDAttaque;
  }

  public function getpointDeVie(){
    return $this->_pointDeVie;
  }

  public function setclassStatsWarlock(){ //fonction définition des stats pour démoniste
      $this->_pointDeVie = 300;
      $this->_pointDeDefense = 32;
      $this->_pointDAttaque = rand(70,75);
      $this->_pointDAttaqueINFO =  "70-75";
  }
  public function setclassStatsWarrior(){ //fonction définition des stats pour guerrier
    $this->_pointDeVie = 400;
    $this->_pointDeDefense = 43;
    $this->_pointDAttaque = rand(45, 55);
    $this->_pointDAttaqueINFO =  "45-55";
    
}

  public function jeuxDeDes() { //jet de des
      $var= rand(1,6);
      return $var;
  }

  public function affiche() {
      echo ("<center>======================================<br>");
      echo ("Personnage crée du nom de : ".$this->_nomPersonnage." <br><br> Ses Caractéristiques sont : <br>");
      echo ("- Classe : ".$this->getNameClass()."<br>");
      echo ("- Nombre de Points d'attaque : ".$this->_pointDAttaqueINFO."<br>");
      echo ("- Nombre de Points de défense : ".$this->_pointDeDefense."<br>");
      echo ("- Nombre de Points de vie : ".$this->_pointDeVie."<br>");
      echo ("======================================<br></center>");
  }



}

class Warrior extends Personnage{ //Classe guerrier
  private $_fureur;
  private $_nomclasse;

  public function __construct($nomPersonnage) {
    parent::__construct($nomPersonnage);
    $this->_fureur = 0;
    $this->_nomclasse = "Guerrier (TANK)";
  }

  public function getNameClass(){
    return $this->_nomclasse;
  }

  public function Attaque($pointdattaque){  //fonction attaque
    echo "Fureur : ".$this->_fureur." %.<br>";
    if($this->_fureur==100){
      $pointdattaque=$pointdattaque * 2;
      $this->_fureur = 0;
      echo"<br>Super Le joueur a fait une attaque critique avec sa grosse hache et sa tête de débile, car sa fureur était au max !<br>";
      echo"Multiplicateur de critique : 2<br>";
      echo"Dégâts d'attaque : ".$pointdattaque."<br>";
    }
    else{
      echo"Dégâts d'attaque : ".$pointdattaque."<br>";
    }
    return $pointdattaque;
}

public function recevoirAttaque($pointdattaque){ //fonction réception de degats
  $pointdattaque= $pointdattaque - $this->_pointDeDefense;
  if($pointdattaque > 0){
    $this->_pointDeVie = $this->_pointDeVie - $pointdattaque;
    if($this->_pointDeVie < 0){$this->_pointDeVie = 0;}
    $this->_fureur += ceil($pointdattaque/2);
    if($this->_fureur>100){$this->_fureur=100;}
    echo "----------<br> 
    Points de vie enlevés à ".$this->_nomPersonnage." : ".$pointdattaque."<br> 
    Points de vie restants à ".$this->_nomPersonnage." : ".$this->_pointDeVie;
  }else {
    echo "----------<br>";
    echo "L'adversaire a trop de défense.";
  }
}

}

class Warlock extends Personnage{ //classe démoniste
  private $_puissancemagique;
  private $_nomclasse;

  public function __construct($nomPersonnage) {
    parent::__construct($nomPersonnage);
    $this->_puissancemagique = 0;
    $this->_nomclasse = "Démoniste (DPS)";
  }

  public function getNameClass(){
    return $this->_nomclasse;
  }

  public function Attaque($pointdattaque){ //fonction d'attaque
    echo "Puissance magique : ".$this->_puissancemagique." %.<br>";
    if($this->_puissancemagique==100){
      $pointdattaque=$pointdattaque * 2;
      $this->_puissancemagique=0;
      echo"<br>Super Le joueur lance un sort critique, car sa puissance magique est au max !<br>";
      echo"Multiplicateur de critique : 2<br>";
      echo"Dégâts d'attaque : ".$pointdattaque."<br>";
    }
    else{
      echo"Dégâts d'attaque : ".$pointdattaque."<br>";
    }
    return $pointdattaque;
}

public function recevoirAttaque($pointdattaque){ //fonction de reception des degats
  $pointdattaque= $pointdattaque - $this->_pointDeDefense;
  if($pointdattaque > 0){
    $this->_pointDeVie = $this->_pointDeVie - $pointdattaque;
    if($this->_pointDeVie < 0){$this->_pointDeVie = 0;}
    $this->_puissancemagique += ceil($pointdattaque/2);
    if($this->_puissancemagique > 100){$this->_puissancemagique==100;}
    echo "----------<br> 
    Points de vie enlevés à ".$this->_nomPersonnage." : ".$pointdattaque."<br> 
    Points de Vie restants à ".$this->_nomPersonnage." : ".$this->_pointDeVie;
  }else {
    echo "----------<br>";
    echo "L'adversaire a trop de défense.";
  }
}

  }




?>
