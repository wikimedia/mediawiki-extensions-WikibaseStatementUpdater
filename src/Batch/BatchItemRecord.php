<?php
declare( strict_types=1 );

namespace MediaWiki\Extension\WikibaseStatementUpdater\Batch;

/**
 * @author Niklas Laxström
 * @license GPL-2.0-or-later
 */
class BatchItemRecord {
	private int $id;
	private BatchItem $item;
	private array $output;

	public function __construct(
		int $id,
		BatchItem $item,
		array $output
	) {
		$this->id = $id;
		$this->item = $item;
		$this->output = $output;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getItem(): BatchItem {
		return $this->item;
	}

	public function getOutput(): array {
		return $this->output;
	}

	public function setOutput( array $output ): void {
		$this->output = $output;
	}
}
