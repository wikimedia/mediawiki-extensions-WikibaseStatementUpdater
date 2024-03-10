<?php
declare( strict_types=1 );

namespace MediaWiki\Extension\WikibaseStatementUpdater\Parser;

use RuntimeException;

/**
 * @author Niklas Laxström
 * @license GPL-2.0-or-later
 */
class ParsingFailure extends RuntimeException {
	private string $lineText;

	public function __construct( int $line, string $lineText ) {
		$this->line = $line;
		$this->lineText = $lineText;
		parent::__construct( 'Parsing failure: ' . get_class( $this ) );
	}

	public function getLineText(): string {
		return $this->lineText;
	}
}
