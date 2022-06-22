<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Database\Entity\Attributes\TUpdatedAt;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\AnnouncementRepository")
 * @ORM\Table(name="announcement")
 * @ORM\HasLifecycleCallbacks()
 */
class AnnouncementEntity extends AbstractEntity
{
	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	/**
	 * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="announcements")
	 */
	private UserEntity $user;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $title;

	/**
	 * @ORM\Column(type="text", length=65535)
	 */
	private string $content;

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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
