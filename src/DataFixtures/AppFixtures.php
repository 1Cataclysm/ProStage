<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = \Faker\Factory::create('fr_FR');
        $entreprises = array(); // seront dans ce tableau les objets entreprises
        $formations = array(); // seront dans ce tableau les objets formations
       
        ////---------------------E N T R E P R I S E---------------------//
        //variables
        $nomEntreprise = array("Ubisoft","Alstom","Apple","IBM","Total");
        for ($i = 0; $i < 5; $i++ ){
            $entreprise = new Entreprise();
            $entreprise->setActivite($faker->realText($faker->numberBetween(15,20)));        
            $entreprise->setAdresse($faker->address());
            $entreprise->setNom($nomEntreprise[$i]);
            $entreprise->setURLsite("www." . $nomEntreprise[$i] . ".com");
            $manager->persist($entreprise);
            $entreprises [$i] = $entreprise;
        }
        
        ////---------------------F O R M A T I O N---------------------//
        //variables
        $tabFormationNomLong=array("Dut Informatique","Licence Pro Prog Avancee","Licence Pro Metiers du Numerique");
        $tabFormationNomCourt=array("DUT Info","LP PA","LP MN");
        for ($i = 0; $i < 3; $i++){
            $formation = new Formation();
            $formation->setNomLong($tabFormationNomLong[$i]);
            $formation->setNomCourt($tabFormationNomCourt[$i]);
            $manager->persist($formation);
            $formations [$i] = $formation;
        }

        //---------------------S T A G E---------------------//
        //variables
        $titre=array("Stage de programmation Java","Stage de Programmation en Php","Stage de codage en C++","Stage de conception d'une application","Stage developpement Web en PhP",
                         "Stage conception d'application Android","Stage Conception d'annuraire sous PhP","Stage developpement en JavaScript","Stage Administration Base de donnees",
                         "Stage gestion de systeme d'information");
        for ($i = 0 ; $i < 10 ; $i++){
            $stage = new Stage();
            $stage->setTitre($titre[$i]);
            $stage->setDescMissions($faker->realText(110,1));
            $stage->setEmailContact($faker->realText(10, 1) . "@gmail.com");
            
            if ($i < 2){
                $stage->setEntreprise($entreprises[0]);
            }
            if ($i > 1 && $i < 4){
                $stage->setEntreprise($entreprises[1]);
            }
            if ($i > 3 && $i < 6){
                $stage->setEntreprise($entreprises[2]);
            }
            if ($i > 5 && $i < 8){
                $stage->setEntreprise($entreprises[3]);
            }
            if ($i > 7){
                $stage->setEntreprise($entreprises[4]);
            }
            // ** FORMATION POUR LE STAGE ** //
            if ($i < 3){
                $stage->addFormation($formations[0]);
                
            }
            if ($i > 2 && $z < 6){
                $stage->addFormation($formations[1]);
                
            }
            if ($i > 5){
                $stage->addFormation($formations[2]);
            }
            
            $manager->persist($stage);
        }

        $manager->flush();
    }
}
