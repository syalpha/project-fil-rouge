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
    public function addprest(Request $request,EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $passwordEncoder)
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

    /**
     * @Route("/prestataire/adduser", name="prestataire")
     */

     public function adduser(Request $request,EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $passwordEncoder)
    {
            $values= json_decode($request->getContent());
            if (isset($values->prenom,$values->nom,$values->username,$values->password,$values->roles,$values->telephone,$values->statut)); 
            {
                    $prest= new Prestataire();
                    $user = new User();
                    $user->setPrenom($values->prenom);
                    $user->setNom($values->nom);
                    $user->setTelephone($values->telephone);
                    $user->setUsername($values->username);
                    $user->setStatut("ACTIF");
                    $user->setPassword($passwordEncoder->encodePassword($user,$values->password));
                    $user->setRoles(['ROLES_ADMIN']);
                    $prest=$this->getDoctrine()->getRepository(Prestataire::class)->find($values->prest);
                    $user->setPrest($prest);
                    $user->setPrest($prest);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($prest);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $rep = [
                        'status' => 201,
                        'message' => 'on a cree un utilisateur '
                    ];
                    return new JsonResponse($rep, 201);        
                } 
                $data = [
                    'status' => 500,
                    'message' => 'ERROR'
                ];
                return new JsonResponse($data, 500);
            }
    }