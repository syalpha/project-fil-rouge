<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Prestataire;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use App\Entity\Systeme;
use App\Entity\Transaction;
use App\Entity\Compte;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire", name="prestataire")
     */
    public function user(Request $request,EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $passwordEncoder)
    {
        $values= json_decode($request->getContent());
        if (isset($values->usernomentrprise,$values->adresse,$values->ninea,$values->numcompte,$values->telephone, $values->mail,$values->montant));
        {
            $prestataire= new Prestataire();
            $prestataire->setNomentreprise($values->nomentreprise);
            $prestataire->setAdresse($values->adresse);
            $prestataire->setNinea($values->ninea);
            $prestataire->setNumcompte($values->numcompte);
            $prestataire->setNumregistre($values->numregistre);
            $prestataire->setTelephone($values->telephone);
            $prestataire->setMail($values->mail);
            $prestataire->setMontant($values->montant);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestataire);
            $entityManager->flush();
            $result = [
                'status' => 201,
                'message' => 'Nous avons creer un partenaire'
            ];
            return new JsonResponse($result, 201);
        }
    }
}