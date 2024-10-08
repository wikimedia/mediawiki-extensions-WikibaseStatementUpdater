<?php
declare( strict_types=1 );

use MediaWiki\Extension\WikibaseStatementUpdater\AccessTokenStore;
use MediaWiki\Extension\WikibaseStatementUpdater\Batch\BatchListStore;
use MediaWiki\Extension\WikibaseStatementUpdater\Batch\BatchStore;
use MediaWiki\Extension\WikibaseStatementUpdater\Updater\UpdateManager;
use MediaWiki\MediaWikiServices;
use MediaWiki\OAuthClient\Client;
use MediaWiki\OAuthClient\ClientConfig;
use MediaWiki\OAuthClient\Consumer;

/** @phpcs-require-sorted-array */
return [
	'WSU:AccessTokenStore' => static function (): AccessTokenStore {
		$cache = ObjectCache::getInstance( CACHE_ANYTHING );
		return new AccessTokenStore( $cache );
	},

	'WSU:BatchListStore' => static function ( MediaWikiServices $s ): BatchListStore {
		return new BatchListStore( $s->getDBLoadBalancerFactory()->getPrimaryDatabase() );
	},

	'WSU:BatchStore' => static function ( MediaWikiServices $s ): BatchStore {
		return new BatchStore( $s->getDBLoadBalancerFactory()->getPrimaryDatabase() );
	},

	'WSU:OAuthClient' => static function ( MediaWikiServices $s ): Client {
		$configOption = $s->getMainConfig()->get( 'WSUClientConfig' );

		$urlUtils = $s->getUrlUtils();
		$authUrl = $urlUtils->expand( wfAppendQuery( wfScript(), 'title=Special:OAuth' ) );
		$conf = new ClientConfig( (string)$authUrl );
		$conf->setConsumer(
			new Consumer( $configOption['key'], $configOption['secret'] )
		);
		return new Client( $conf );
	},

	'WSU:UpdateManager' => static function ( MediaWikiServices $s ): UpdateManager {
		$urlUtils = $s->getUrlUtils();

		return new UpdateManager(
			$s->get( 'WSU:BatchStore' ),
			$s->get( 'WSU:BatchListStore' ),
			$s->get( 'WSU:AccessTokenStore' ),
			$s->get( 'WSU:OAuthClient' ),
			(string)$urlUtils->expand( wfScript( 'api' ) )
		);
	},
];
