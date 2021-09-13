<?php
/**
 * Tag Entity.
 */

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-optionsda.
     *
     * @constant int NUMBER_OF_ITEMS
     */
    const NUMBER_OF_ITEMS = 10;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection|\App\Entity\Announcements[] Tasks
     *
     * @ORM\ManyToMany(targetEntity=Announcements::class, mappedBy="tags")
     */
    private $announcements;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->announcements = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|\App\Entity\Announcements[] Tasks
     */
    public function getAnnouncements(): Collection
    {
        return $this->announcements;
    }

    /**
     * Add task to collection.
     *
     * @param \App\Entity\Announcements $announcement Task entity
     *
     * @return Tag
     */
    public function addAnnouncement(Announcements $announcement): self
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements[] = $announcement;
            $announcement->addTag($this);
        }

        return $this;
    }

    /**
     * Remove task from collection.
     *
     * @param \App\Entity\Announcements $announcement Task entity
     *
     * @return Tag
     */
    public function removeAnnouncement(Announcements $announcement): self
    {
        if ($this->announcements->contains($announcement)) {
            $this->announcements->removeElement($announcement);
            $announcement->removeTag($this);
        }

        return $this;
    }
}
