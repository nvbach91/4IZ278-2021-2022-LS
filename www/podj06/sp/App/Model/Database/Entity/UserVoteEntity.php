<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;
use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_vote")
 * @ORM\HasLifecycleCallbacks()
 */
class UserVoteEntity extends AbstractEntity
{
    use TId;
    use TCreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="votes", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    private UserEntity $user;

    /**
     * @ORM\ManyToOne(targetEntity="PollOptionEntity", inversedBy="userVotes")
     * @ORM\JoinColumn(name="poll_option_id", nullable=true)
     */
    private ?PollOptionEntity $pollOption = null;

    /**
     * @ORM\ManyToOne(targetEntity="PollEntity", inversedBy="userVotes", fetch="EAGER")
     * @ORM\JoinColumn(name="poll_id", nullable=false)
     */
    private PollEntity $poll;

    /**
     * @ORM\Column(type="string", length=65535, nullable=true)
     */
    private ?string $freeOptionText = null;

    /**
     * @ORM\Column(type="string", length=65535, nullable=true)
     */
    private ?string $comment = null;

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * @param UserEntity $user
     */
    public function setUser(UserEntity $user): void
    {
        $this->user = $user;
    }

    /**
     * @return PollOptionEntity|null
     */
    public function getPollOption(): ?PollOptionEntity
    {
        return $this->pollOption;
    }

    /**
     * @param PollOptionEntity|null $pollOption
     */
    public function setPollOption(?PollOptionEntity $pollOption): void
    {
        $this->pollOption = $pollOption;
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
     * @return string|null
     */
    public function getFreeOptionText(): ?string
    {
        return $this->freeOptionText;
    }

    /**
     * @param string|null $freeOptionText
     */
    public function setFreeOptionText(?string $freeOptionText): void
    {
        $this->freeOptionText = $freeOptionText;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }
}
