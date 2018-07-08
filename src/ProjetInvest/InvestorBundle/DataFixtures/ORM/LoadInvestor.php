<?php

namespace ProjetInvest\InvestorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProjetInvest\InvestorBundle\Entity\Investor;

class LoadInvestor implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('Jean', 'David', 'Maria');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new Investor;

      // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setEmail($name);

      // On ne se sert pas du sel pour l'instant
      $user->setSalt('');
      // On définit uniquement le role ROLE_USER qui est le role de base
      $user->setRoles(array('ROLE_INVESTOR'));

      // On le persiste
      $manager->persist($user);
    }

    // Les noms d'utilisateurs à créer
    $listNames = array('Dude');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new Investor;

      // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setEmail($name);

      // On ne se sert pas du sel pour l'instant
      $user->setSalt('');
      // On définit uniquement le role ROLE_USER qui est le role de base
      $user->setRoles(array('ROLE_ADMIN'));

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}