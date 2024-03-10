<?php
declare( strict_types=1 );

namespace MediaWiki\Extension\WikibaseStatementUpdater\Batch;

use MediaWiki\User\User;

/**
 * @author Niklas Laxström
 * @license GPL-2.0-or-later
 */
class BatchList {
	private string $name;
	private User $owner;

	public function __construct(
		string $name,
		User $owner
	) {
		$this->name = $name;
		$this->owner = $owner;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getOwner(): User {
		return $this->owner;
	}
}
