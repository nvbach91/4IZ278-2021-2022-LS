<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\PollOptionRepository")
 * @ORM\Table(name="poll_option")
 */
class PollOptionEntity extends AbstractEntity
{
    use TId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity="PollEntity", inversedBy="options")
     * @ORM\JoinColumn(name="poll_id", nullable=false)
     */
    private PollEntity $poll;

    /**
     * @var Collection<int, UserVoteEntity>
     * @ORM\OneToMany(targetEntity="UserVoteEntity", mappedBy="pollOption", cascade={"persist", "remove"})
     */
    private Collection $userVotes;

    public function __construct()
    {
        $this->userVotes = new ArrayCollection();
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
     * @return PollEntity
     */
    public function getPoll(): PollEntity
    {
        return $this->poll;
    }

    /**
     * @param PollEntity $poll
     */
    public function setPoll(PollEntity $poll): void
    {
        $this->poll = $poll;
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
}
