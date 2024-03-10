<?php
declare( strict_types=1 );

namespace MediaWiki\Extension\WikibaseStatementUpdater\Batch;

use MediaWiki\User\User;

/**
 * @author Niklas Laxström
 * @license GPL-2.0-or-later
 */
class BatchListRecord extends BatchList {
	private int $id;
	private int $createdAt;
	private ?string $status;

	public function __construct(
		string $name,
		User $owner,
		int $id,
		int $createdAt,
		string $status = null
	) {
		parent::__construct( $name, $owner );
		$this->id = $id;
		$this->createdAt = $createdAt;
		$this->status = $status;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getCreatedAt(): int {
		return $this->createdAt;
	}

	public function getStatus(): ?string {
		return $this->status;
	}
}
