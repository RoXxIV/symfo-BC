<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticationController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = json_decode($request->getContent())->username;
        $password = json_decode($request->getContent())->password;
        $email = json_decode($request->getContent())->email;
        $lastName = json_decode($request->getContent())->lastName;
        $firstName = json_decode($request->getContent())->firstName;
        $siretNumber = json_decode($request->getContent())->siretNumber;
        $phone = json_decode($request->getContent())->phone;

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setRoles(['ROLES_USER']);
        $user->setEmail($email);
        $user->setLastName($lastName);
        $user->setFirstName($firstName);
        $user->setSiretNumber($siretNumber);
        $user->setPhone($phone);

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }

    public function getCompleteUser()
    {
        return $this->json(parent::getUser());
    }
}
