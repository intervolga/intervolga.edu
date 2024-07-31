<?php
namespace Intervolga\Edu\Entity;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\SystemException;
use Intervolga\Edu\Tool\ORM\EduTestTable;

class EduTest extends EntityObject
{
	/** @var string $dataClass */
	static public $dataClass = EduTestTable::class;

	/**
	 * @return string|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getTestId(): ?int
	{
		return $this->get('ID');
	}

	/**
	 * @return string|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getTestName(): ?string
	{
		return $this->get('TEST_NAME');
	}

	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setTestName(string $name): ?EduTest
	{
		$this->set('TEST_NAME', $name);
		return $this;
	}

	/**
	 * @return bool|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getTestResult(): ?bool
	{
		return $this->get('RESULT');
	}
	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setTestResult(bool $result): ?EduTest
	{
		$this->set('RESULT', $result);
		return $this;
	}

	/**
	 * @return string|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getPassedDate(): ?string
	{
		return $this->get('PASSED_DATE');
	}
	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setPassedDate(string $date): ?EduTest
	{
		$this->set('PASSED_DATE', $date);
		return $this;
	}

	/**
	 * @return bool|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getComplaint(): ?bool
	{
		return $this->get('COMPLAINT');
	}
	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setComplaint(bool $complaint): ?EduTest
	{
		$this->set('COMPLAINT', $complaint);
		return $this;
	}

	/**
	 * @return string|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getComplaintDate(): ?string
	{
		return $this->get('COMPLAINT_DATE');
	}
	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setComplaintDate(string $compDate): ?EduTest
	{
		$this->set('COMPLAINT_DATE',$compDate);
		return $this;
	}

	/**
	 * @return string|null
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function getComplaintComment(): ?string
	{
		return $this->get("COMPLAINT_COMMENT");
	}
	/**
	 * @return EduTest
	 * @throws ArgumentException
	 * @throws SystemException
	 */
	public function setComplaintComment(string $comment): ?EduTest
	{
		$this->set('COMPLAINT_COMMENT',$comment);
		return $this;
	}
}