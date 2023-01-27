<?php
/**
 * Qwel Two functions
 * Author: Taigo Ito (https://qwel.design/)
 * Location: Fukui, Japan
 * @package Qwel-Two
 */

/*
 * テーマのパス, URI
 */
define( 'QWEL_THEME_DIR', get_template_directory() );
define( 'QWEL_THEME_URI', get_template_directory_uri() );


/*
 * classのオートロード
 */
spl_autoload_register(
	function( $classname ) {
		if ( strpos( $classname, 'Qwel_Theme' ) === false ) return;
		$classname = str_replace( '\\', '/', $classname );
		$classname = str_replace( 'Qwel_Theme/', '', $classname );
		$file      = QWEL_THEME_DIR . '/classes/' . $classname . '.php';
		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);

/*
 * Hookする関数群を継承して登録
 */
class Qwel {
	use	\Qwel_Theme\Supports,
		\Qwel_Theme\Scripts;
		
	public function __construct() {
		// テーマサポート機能
		add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );

		// CSS, JSファイルを読み込み
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}
}

/**
 * Qwel start!
 */
new Qwel();
