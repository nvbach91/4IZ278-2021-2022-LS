<?php declare(strict_types = 1);

namespace App\Model\Database\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;

trait TId
{

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=FALSE)
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 */
	private $id;

	public function getId(): int
	{
		return $this->id;
	}


	public function __clone()
	{
		$this->id = null;
	}

}
