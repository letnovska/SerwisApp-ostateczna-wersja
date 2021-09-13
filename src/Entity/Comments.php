<?php
/*
 *  Comment Entity
 */

namespace App\Entity;

use App\Repository\CommentsRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment.
 *
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository", repositoryClass=CommentsRepository::class)
 * @ORM\Table (name="comments")
 */
class Comments
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
     * Primary Key.
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Content.
     *
     * @ORM\Column(type="string")
     *
     * @Assert\Type (type="string")
     * @Assert\NotBlank
     * @Assert\Length (
     *     allowEmptyString="false",
     *     min="3",
     *     max="1000",
     * )
     */
    private $content;

    /**
     * Created At.
     *
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Announcements::class, inversedBy="comments")
     */
    private $announcement;

    /**
     * @ORM\ManyToOne(targetEntity=UsersData::class, inversedBy="comments")
     */
    private $usersData;

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
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     *
     * @return $this
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Announcements|null
     */
    public function getAnnouncement(): ?Announcements
    {
        return $this->announcement;
    }

    /**
     * @param Announcements|null $announcement
     *
     * @return $this
     */
    public function setAnnouncement(?Announcements $announcement): self
    {
        $this->announcement = $announcement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsersData()
    {
        return $this->usersData;
    }

    /**
     * @param UsersData|null $usersData
     *
     * @return $this
     */
    public function setUsersData(?UsersData $usersData): self
    {
        $this->usersData = $usersData;

        return $this;
    }
}
