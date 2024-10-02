<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

#[Entity(repositoryClass: MovieRepository::class)]
class Movie extends Media
{
}
