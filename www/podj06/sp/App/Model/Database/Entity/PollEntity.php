<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Exception\Logic\InvalidArgumentException;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\PollRepository")
 * @ORM\Table("poll")
 * @ORM\HasLifecycleCallbacks()
 */
class PollEntity extends AbstractEntity
{
    public const TYPE_SELECT = 'type_select';
    public const TYPE_MULTISELECT = 'type_multiselect';
    public const TYPE_FREETYPE = 'type_freetype';

    public const TYPES = [self::TYPE_SELECT, self::TYPE_MULTISELECT, self::TYPE_FREETYPE];

    use TId;
    use TCreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="polls")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    private UserEntity $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=65535)
     */
    private string $description;

    /**
     * @ORM\Column(name="poll_type", type="string", length=255)
     */
    private string $type;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $openedFrom;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $openedTo;

    /**
     * @var Collection<int, PollOptionEntity>
     * @ORM\OneToMany(targetEntity="PollOptionEntity", mappedBy="poll", cascade={"remove", "persist"})
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private Collection $options;

    /**
     * @var Collection<int, UserVoteEntity>
     * @ORM\OneToMany(targetEntity="UserVoteEntity", mappedBy="poll", cascade={"remove", "persist"})
     */
    private Collection $userVotes;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->userVotes = new ArrayCollection();
    }

    /**
     * @return UserEntity
     */
    public function getAuthor(): UserEntity
    {
        return $this->author;
    }

    /**
     * @param UserEntity $author
     */
    public function setAuthor(UserEntity $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        if (!in_array($type, self::TYPES)) {
            throw new InvalidArgumentException(sprintf('Unsupported type %s', $type));
        }

        $this->type = $type;
    }

    /**
     * @return DateTime
     */
    public function getOpenedFrom(): DateTime
    {
        return $this->openedFrom;
    }

    /**
     * @param DateTime $openedFrom
     */
    public function setOpenedFrom(DateTime $openedFrom): void
    {
        $this->openedFrom = $openedFrom;
    }

    /**
     * @return DateTime
     */
    public function getOpenedTo(): DateTime
    {
        return $this->openedTo;
    }

    /**
     * @param DateTime $openedTo
     */
    public function setOpenedTo(DateTime $openedTo): void
    {
        $this->openedTo = $openedTo;
    }

    /**
     * @return Collection
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    /**
     * @param Collection $options
     */
    public function setOptions(Collection $options): void
    {
        $this->options = $options;
    }

    /**
     * @return Collection
     */
    public function getUserVotes(): Collection
    {
        return $this->userVotes;
    }

    /**
     * @param Collection $userVotes
     */
    public function setUserVotes(Collection $userVotes): void
    {
        $this->userVotes = $userVotes;
    }

    public function hasVotingEnded(): bool
    {
        return (new DateTime())->diff($this->openedTo)->invert === 1;
    }

    public function hasUserVoted(int $userId): bool
    {
        return $this->userVotes->exists(function(int $key, UserVoteEntity $element) use ($userId) {
            return $element->getUser()->getId() === $userId;
        });
    }
}
