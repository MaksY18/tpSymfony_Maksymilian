<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, entity: User::class)]

readonly class UserPasswordSubscriber {
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function prePersist(User $user): void {
        $this->encodePassword($user);
    }

    public function preUpdate(User $user): void {
        $this->encodePassword($user);
    }

    private function encodePassword(User $user): void {
        if ($user->getPlainPassword() === null) {
            return;
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword(
                user: $user,
                plainPassword: $user->getPlainPassword()
            )
        );
        $user->eraseCredentials();
    }
}
