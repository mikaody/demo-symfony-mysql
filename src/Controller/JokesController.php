<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Joke;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JokesController extends AbstractController
{


    /**
     * @Route("/Jokes", name="Jokes", methods={"get", "post"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        //fetch all data from database in joke table 
        $jokes = $doctrine->getRepository(Joke::class)->findAll();

        //from controller to view with some parameters
        return $this->render('jokes/index.html.twig', [
            'jokesArray' => $jokes,
        ]);
    }

    /**
     * @Route("/jokes", name="jokes")
     */
    public function jokes(ManagerRegistry $doctrine): Response
    {
        //fetch all data from database in joke table 
        $jokes = $doctrine->getRepository(Joke::class)->findAll();

        //from controller to view with some parameters
        return $this->render('jokes/index.html.twig', [
            'jokesArray' => $jokes,
        ]);
    }

    /**
     * @Route("/jokes/create", name="create", methods={"get", "post"})
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $joke = new Joke();
        $joke->setJokeQuestion('Question:');
        $joke->setJokeAnswer('Answer:');

        if (($request->request->get('__RequestVerificationToken') == "7890") && (($request->request->get('JokeQuestion') !== null ) && (($request->request->get('JokeAnswer')) !== null ) ) ) {
            $entityManager->persist($joke);

            $entityManager->flush();

            return new Response('<p>Saved new joke with id '.$joke->getId().'<a href="/Jokes">back</a></p>');
        }
        return $this->render('jokes/create.html.twig', [
                'joke' => $joke,
                'jokeQuestion' => $joke->getJokeQuestion(),
                'jokeAnswer' => $joke->getJokeAnswer(),
            ]);
    }

    /**
     * @Route("/Jokes/Create", name="jokeCreate")
     */
    public function jokeCreate(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $joke = new Joke();
        $joke->setJokeQuestion('Question:');
        $joke->setJokeAnswer('Answer:');

        if (($request->request->get('__RequestVerificationToken') == "7890") && (($request->request->get('JokeQuestion') !== null ) && (($request->request->get('JokeAnswer')) !== null ) ) ) {
            $entityManager->persist($joke);

            $entityManager->flush();

            return new Response('<p>Saved new joke with id '.$joke->getId().' <a href="/Jokes">back</a></p>');

        }
        return $this->render('jokes/create.html.twig', [
                'joke' => $joke,
                'jokeQuestion' => $joke->getJokeQuestion(),
                'jokeAnswer' => $joke->getJokeAnswer(),
            ]);
    }

    /**
     * @Route("/jokes/delete/{id}", methods={"get","post"}, name="delete")
     *@param int $id
     */
    public function delete(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }
        if ($request->request->get('__RequestVerificationToken') == "1234") {
            $entityManager->remove($joke);
            $entityManager->flush();

            return new Response('<p>Joke '.$joke->getId().' deleted. <a href="/Jokes">Back</a></p>');
        } 
        if ($request->request->get('__RequestVerificationToken') == "1234") {
            //from controller to view with some parameters
            return $this->render('jokes/delete.html.twig', [
                'joke' => $joke,
                'jokeQuestion' => $joke->getJokeQuestion(),
                'jokeAnswer' => $joke->getJokeAnswer(),
            ]);
        }

    }

    /**
     * @Route("/Jokes/Delete/{id}", methods={"get","post"}, name="jokeDelete")
     *@param int $id
     */
    public function jokeDelete(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }
        if ($request->request->get('__RequestVerificationToken') == "1234") {
            $entityManager->remove($joke);
            $entityManager->flush();

            return new Response('<p>Joke '.$joke->getId().' deleted. <a href="/Jokes">Back</a></p>');
        }
        //from controller to view with some parameters
        return $this->render('jokes/delete.html.twig', [
            'joke' => $joke,
            'jokeQuestion' => $joke->getJokeQuestion(),
            'jokeAnswer' => $joke->getJokeAnswer(),
        ]);
        return new Response('<p>Invalid request! Contact Enock! or go <a href="/Jokes">Back</a></p>');

    }

    /**
     * @Route("/jokes/details/{id}", name="details")
     *@param int $id
     */
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }

        //from controller to view with some parameters
        return $this->render('jokes/details.html.twig', [
            'joke' => $joke,
            'jokeQuestion' => $joke->getJokeQuestion(),
            'jokeAnswer' => $joke->getJokeAnswer(),
        ]);
    }

    /**
     * @Route("/Jokes/Details/{id}", name="jokeDetails")
     *@param int $id
     */
    public function jokeDetails(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }

        echo '<script>propmt("Delete");</script>';

        //from controller to view with some parameters
        return $this->render('jokes/details.html.twig', [
            'joke' => $joke,
            'jokeQuestion' => $joke->getJokeQuestion(),
            'jokeAnswer' => $joke->getJokeAnswer(),
        ]);
    }

    /**
     * @Route("/jokes/edit/{id}", name="edit")
     *@param int $id
     */
    public function edit(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }

        if (($request->request->get('__RequestVerificationToken') == "7890") && (($request->request->get('JokeQuestion') !== null ) && (($request->request->get('JokeAnswer')) !== null ) ) ) {
            $joke->setJokeQuestion($request->request->get('JokeQuestion'));
            $joke->setJokeAnswer($request->request->get('JokeAnswer'));
            $entityManager->flush();
        }

        //from controller to view with some parameters
        return $this->render('jokes/edit.html.twig', [
            'joke' => $joke,
            'jokeQuestion' => $joke->getJokeQuestion(),
            'jokeAnswer' => $joke->getJokeAnswer(),
        ]);
    }

    /**
     * @Route("/Jokes/Edit/{id}", name="jokeedit", methods={"get","post"}")
     *@param int $id
     */
    public function jokeedit(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $repository = $doctrine->getRepository(Joke::class);

        // look for a single Product by its primary key (usually "id")
        $joke = $repository->find($id);

        if (!$joke) {
            throw $this->createNotFoundException('No joke found for id '.$id);
        }

        if (($request->request->get('__RequestVerificationToken') == "7890") && (($request->request->get('JokeQuestion') !== null ) && (($request->request->get('JokeAnswer')) !== null ) ) ) {
            $joke->setJokeQuestion($request->request->get('JokeQuestion'));
            $joke->setJokeAnswer($request->request->get('JokeAnswer'));
            $entityManager->flush();
        }

        //from controller to view with some parameters
        return $this->render('jokes/edit.html.twig', [
            'joke' => $joke,
            'jokeQuestion' => $joke->getJokeQuestion(),
            'jokeAnswer' => $joke->getJokeAnswer(),
        ]);
    }




}
