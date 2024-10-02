<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Playlist;
use App\Entity\PlaylistMedia;
use App\Entity\Serie;
use App\Entity\Subscription;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public const MAX_USERS = 10;
    public const PLAYLISTS_PER_USER = 5;
    public const MAX_SUBSCRIPTIONS = 3;
    public const MAX_MEDIA = 100;
    public const MAX_MEDIA_PER_PLAYLIST = 3;

    public function load(ObjectManager $manager): void
    {
        $users = [];
        $medias = [];
        $playlists = [];

        for ($i = 0; $i < self::MAX_USERS; $i++) {
            $user = $this->createUser($i, $manager);
            $users[] = $user;

            for ($k = 0; $k < random_int(1, self::PLAYLISTS_PER_USER); $k++) {
                $playlists = $this->createPlaylists($user, $manager, $playlists);
            }
        }

        $this->createMediaAndLinkToPlaylists($manager, $playlists);
        $this->createSubscriptions($manager, $users);

        $manager->flush();
    }

    protected function createSubscriptions(ObjectManager $manager, array $users): void
    {
        for ($m = 0; $m < self::MAX_SUBSCRIPTIONS; $m++) {
            $abonnement = new Subscription();
            $abonnement->setDuration(duration: 10 * ($m + 1));
            $abonnement->setName(name: 'Abonnement 10 jours');
            $abonnement->setPrice(price: 50);
            $manager->persist(object: $abonnement);

            $randomUser = $users[array_rand($users)];
            $randomUser->setCurrentSubscription(currentSubscription: $abonnement);
        }
    }

    protected function linkMediaToPlaylist(Media $media, array $playlists, ObjectManager $manager): void
    {
        $playlistMedia = new PlaylistMedia();
        $playlistMedia->setMedia(media: $media);
        $playlistMedia->setAddedAt(addedAt: new \DateTimeImmutable());
        $playlistMedia->setPlaylist(playlist: $playlists[array_rand($playlists)]);

        $manager->persist(object: $playlistMedia);
    }

    protected function createMedia(int $j, ObjectManager $manager): Media
    {
        $media = random_int(min: 0, max: 1) === 0 ? new Movie() : new Serie();

        $media->setTitle(title: "Film {$j}");
        $media->setLongDescription(longDescription: 'Longue description');
        $media->setShortDescription(shortDescription: 'Short description');
        $media->setCoverImage(coverImage: 'http://');
        $media->setReleaseDate(releaseDate: new \DateTime(datetime: "+7 days"));
        $manager->persist(object: $media);

        return $media;
    }

    protected function createMediaAndLinkToPlaylists(ObjectManager $manager, array $playlists): void
    {
        for ($j = 0; $j < self::MAX_MEDIA; $j++) {
            $media = $this->createMedia($j, $manager);

            for ($l = 0; $l < random_int(1, self::MAX_MEDIA_PER_PLAYLIST); $l++) {
                $this->linkMediaToPlaylist($media, $playlists, $manager);
            }
        }
    }

    protected function createPlaylists(User $user, ObjectManager $manager, array $playlists): array
    {
        $playlist = new Playlist();
        $playlist->setName(name: 'Ma playlist');
        $playlist->setCreatedAt(createdAt: new \DateTimeImmutable());
        $playlist->setUpdatedAt(updatedAt: new \DateTimeImmutable());
        $playlist->setCreator(creator: $user);
        $manager->persist(object: $playlist);
        $playlists[] = $playlist;

        return $playlists;
    }

    protected function createUser(int $i, ObjectManager $manager): User
    {
        $user = new User();
        $user->setEmail(email: "test_{$i}@example.com");
        $user->setUsername(username: "test_{$i}");
        $user->setPassword(password: 'coucou');
        $manager->persist(object: $user);

        return $user;
    }
}
