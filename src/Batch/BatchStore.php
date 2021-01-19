<?php
declare( strict_types=1 );

namespace MediaWiki\Extensions\WikibaseStatementUpdater\Batch;

use IDatabase;
use stdClass;
use Wikimedia\ObjectFactory;

/**
 * @author Niklas Laxström
 * @license GPL-2.0-or-later
 */
class BatchStore {
	private const TABLE = 'wsu_batch';
	/** @var IDatabase */
	private $db;

	public function __construct( IDatabase $db ) {
		$this->db = $db;
	}

	/**
	 * @param BatchListRecord $list
	 * @param BatchItem[] $items
	 */
	public function addItems( BatchListRecord $list, array $items ) {
		$rows = [];
		foreach ( $items as $item ) {
			$rows[] = [
				'wsub_batch' => $list->getId(),
				'wsub_input' => json_encode( $item->getSpec() ),
			];
		}

		$this->db->insert( self::TABLE, $rows, __METHOD__ );
	}

	/** @return BatchItemRecord[] */
	public function getRecords( BatchListRecord $list ): array {
		$res = $this->db->select(
			self::TABLE,
			[ 'wsub_id', 'wsub_input', 'wsub_output' ],
			[ 'wsub_batch' => $list->getId() ],
			__METHOD__
		);

		$records = [];
		foreach ( $res as $row ) {
			$records[] = $this->makeRecord( $row );
		}
		return $records;
	}

	private function makeRecord( stdClass $row ): BatchItemRecord {
		/** @var BatchItem $item */
		$item = ObjectFactory::getObjectFromSpec( json_decode( $row->wsub_input, true ) );

		return new BatchItemRecord(
			(int)$row->wsub_id, $item, json_decode( $row->wsub_output ?? '[]', true ),
		);
	}

	public function getRecord( int $id ): ?BatchItemRecord {
		$row = $this->db->selectRow(
			self::TABLE,
			[ 'wsub_id', 'wsub_input', 'wsub_output' ],
			[ 'wsub_id' => $id ],
			__METHOD__
		);

		return $row ? $this->makeRecord( $row ) : null;
	}

	public function updateOutput( BatchItemRecord $record ) {
		$this->db->update(
			self::TABLE,
			[ 'wsub_output' => json_encode( $record->getOutput() ) ],
			[ 'wsub_id' => $record->getId() ],
			__METHOD__
		);
	}
}
