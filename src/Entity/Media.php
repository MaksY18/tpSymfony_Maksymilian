<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $long_description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(length: 255)]
    private ?string $cover_image = null;

    #[ORM\Column]
    private array $staff = [];

    #[ORM\Column]
    private array $casting = [];

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'media')]
    private Collection $media;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'media')]
    private Collection $category;

    /**
     * @var Collection<int, Language>
     */
    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'media')]
    private Collection $language;

    /**
     * @var Collection<int, WatchHistory>
     */
    #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'media')]
    private Collection $watchHistories;

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'media')]
    private Collection $playlistMedia;

    /**
     * @var Collection<int, Movie>
     */
    #[ORM\OneToMany(targetEntity: Movie::class, mappedBy: 'media')]
    private Collection $movies;

    /**
     * @var Collection<int, Serie>
     */
    #[ORM\OneToMany(targetEntity: Serie::class, mappedBy: 'media')]
    private Collection $series;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->language = new ArrayCollection();
        $this->watchHistories = new ArrayCollection();
        $this->playlistMedia = new ArrayCollection();
        $this->movies = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): static
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(string $long_description): static
    {
        $this->long_description = $long_description;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(string $cover_image): static
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getStaff(): array
    {
        return $this->staff;
    }

    public function setStaff(array $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getCasting(): array
    {
        return $this->casting;
    }

    public function setCasting(array $casting): static
    {
        $this->casting = $casting;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Categorie $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
        }

        return $this;
    }

    public function removeMedium(Categorie $medium): static
    {
        $this->media->removeElement($medium);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->language->contains($language)) {
            $this->language->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->language->removeElement($language);

        return $this;
    }

    /**
     * @return Collection<int, WatchHistory>
     */
    public function getWatchHistories(): Collection
    {
        return $this->watchHistories;
    }

    public function addWatchHistory(WatchHistory $watchHistory): static
    {
        if (!$this->watchHistories->contains($watchHistory)) {
            $this->watchHistories->add($watchHistory);
            $watchHistory->setMedia($this);
        }

        return $this;
    }

    public function removeWatchHistory(WatchHistory $watchHistory): static
    {
        if ($this->watchHistories->removeElement($watchHistory)) {
            // set the owning side to null (unless already changed)
            if ($watchHistory->getMedia() === $this) {
                $watchHistory->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setMedia($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getMedia() === $this) {
                $playlistMedium->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setMedia($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getMedia() === $this) {
                $movie->setMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Serie $series): static
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->setMedia($this);
        }

        return $this;
    }

    public function removeSeries(Serie $series): static
    {
        if ($this->series->removeElement($series)) {
            // set the owning side to null (unless already changed)
            if ($series->getMedia() === $this) {
                $series->setMedia(null);
            }
        }

        return $this;
    }
}
