<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class AccountController extends AbstractController
{
    /**
     * @Route("/Identity/Account/Login", name="loginaccount", methods={"get" ,"post"})
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        //fetch all data from database in joke table 
        $users = $doctrine->getRepository(User::class)->findAll();

        for ($i=0; $i < count($users); $i++) {
	    	if (($request->request->get('Email') == $users[$i]->getEmail()) && ($request->request->get('Password') == $users[$i]->getMotdepasse())) {
	    		return new Response('welcome');
	    	}	        	
        }
        return $this->render('account/login.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
