<?php

namespace App\Entity;

use App\Repository\JokeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JokeRepository::class)
 */
class Joke
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $JokeQuestion;


    /**
     * @ORM\Column(type="string", length=255)
     */

    private $JokeAnswer;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJokeQuestion(): ?string
    {
        return $this->JokeQuestion;
    }

    public function setJokeQuestion(string $JokeQuestion): self
    {
        $this->JokeQuestion = $JokeQuestion;

        return $this;
    }


    public function getJokeAnswer(): ?string
    {
        return $this->JokeAnswer;
    }

    public function setJokeAnswer(string $JokeAnswer): self
    {
        $this->JokeAnswer = $JokeAnswer;

        return $this;
    }


}
