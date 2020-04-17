<?php

require_once('class_personnage.php');
echo "<br><br><center><h1>Le Pif dans ta Gueule</h1></center>";
echo "<br><center><h2>Remastered</h2></center>";
echo "<b>Les règles sont les suivantes :</b> <br>";
echo "- deux joueurs s'affronte, chaque joueur dispose d'un nombre de point de vie, d'un nombre de point d'attaque, et un nombre de point de défense.<br>";
echo "- Un des est lancé par chaque joueur pour savoir qui commence. Le plus grand commence.<br>";
echo "- Quand la rage d'un joueur est à 100%, ses dégâts seront doublés au prochain coup.<br>";
echo "- Jeux en tour par tour.<br>";
echo "- Le joueur qui perd est le premier qui n'a plus de vie.<br>";
echo "- Les joueurs on 50 tours pour finir de se baiser la gueule, après tout le monde sera déjà parti.<br>";

echo ("<center><br><br>======================================<br>");
echo "A vous de jouer !<br>";
echo ("======================================<br>");
echo ('<a href="#resultat">Voir le résultat</a><br></center>');

// Entrer un nom de joueur J1
$nomPersonnage1 = 'Michel';
$joueur1 = new Warrior($nomPersonnage1);
$joueur1->setclassStatsWarrior();
$joueur1->affiche();

// Entrer un nom de joueur J2
$nomPersonnage2 = 'Jacquie';
$joueur2 = new Warlock($nomPersonnage2);
$joueur2->setclassStatsWarlock();
$joueur2->affiche();
echo ("<center><br><br>======================================<br>");
echo "<br>  Aller on lancer la partie !!!!!! A qui de commencer ? <br><br> ";
echo ("======================================<br></center>");


do{
  echo "lancer de des du joueurs 1<br>";
  $des1 = $joueur1->jeuxDeDes();
  echo "lancer de des du joueurs 2<br>";
  $des2 = $joueur2->jeuxDeDes();
  echo "Résultat : J1 = ".$des1." , J2 = ".$des2." <br><br>";

  if ($des1>$des2){
    echo ("<center><br><br>======================================<br>");
    echo "<br>  Le Joueur 1 Commence <br><br> ";
    echo ("======================================<br></center>");
    $aquidejouer = 0;
  }else if ($des1<$des2){
    echo ("<center><br><br>======================================<br>");
    echo "<br>  Le joueur 2 Commence <br><br> ";
    echo ("======================================<br></center>");
    $aquidejouer = 1;
  }else {
    echo "Le lancé de des est équivalent, on recommence <br><br>";
  }


} while ($des1 == $des2);

$i=1;
$j=1;
$nbtour=1;
while(($joueur1->getpointDeVie() > 0) && ($joueur2->getpointDeVie() > 0) && ($nbtour<=60) ){
if ($aquidejouer <= 0){
  echo "<br><br>========================<br>";
  echo "Tour n°".$i." Joueur 1 : ".$joueur1->getnomPersonnage().", ".$joueur1->getNameClass()." :";
  echo "<br>========================<br><br>";
 // attaque joueur 1 -> joueur 2
  $pointattaque = $joueur1->getpointDAttaque();
  $pointattaque = $joueur1->Attaque($pointattaque);
  echo "Points de défense adversaire : ".$joueur2->getpointDeDefense()."<br>";
  $joueur2->recevoirAttaque($pointattaque);
  $i++;
  $aquidejouer = $aquidejouer +1;
  echo"<br>";
}else{
  echo "<br><br>========================<br>";
  echo "Tour n°".$j." Joueur 2 : ".$joueur2->getnomPersonnage().", ".$joueur2->getNameClass()." :";
  echo "<br>========================<br><br>";

  // attaque joueur 2 -> joueur 1
  $pointattaque = $joueur2->getpointDAttaque();
  $pointattaque = $joueur2->Attaque($pointattaque);
  echo "Points de défense adversaire : ".$joueur1->getpointDeDefense()."<br>";
  $joueur1->recevoirAttaque($pointattaque);
    $aquidejouer = $aquidejouer -1;
  $j++;
  echo"<br>";
  $nbtour++;
}
}
  echo'<div id="resultat"></div>';
if($joueur1->getpointDeVie() <= 0){
  echo "<center><br><br>========================<br>";
  echo "LE JOUEUR N° 2 A GAGNÉ !!!!!!:";
  echo "<br>========================<br><br></center>";
}else if ($joueur2->getpointDeVie() <= 0){
  echo "<center><br><br>========================<br>";
  echo "LE JOUEUR N° 1 A GAGNÉ !!!!!!:";
  echo "<br>========================<br><br></center>";

}else{
  echo "<center><br><br>========================<br>";
  echo "Les joueurs puent la merde, ils sont trop faible pour finir ce jeu en 50 tours !!!!!!:";
  echo "<br>========================<br><br></center>";


}
echo ('<center><a href="?'.rand().'=#resultat" onclick="reload()">Réessayer</a></center>'); //refresh en bas de page
?>