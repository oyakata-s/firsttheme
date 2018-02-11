<?php
/*
 * bingwallpaperを扱うクラス
 */
require_once BINGWP_DIR_PATH . 'inc/utils/class-cache-utils.php';		// キャッシュ利用

class BingWallpaperUtils {

	static private $instance = null;	// インスタンス

	private $cache = null;				// キャッシュオブジェクト
	private $filename = null;			// 壁紙ファイル名
	private $date = null;				// 日付情報
	private $copyright = null;			// copyright情報

	/*
	 * コンストラクタ
	 */
	public function __construct( $cache_dir = null ) {
		try {
			$this->cache = CacheUtils::getInstance( $cache_dir );
			$this->filename = $this->createWallpaper();
			$this->clearCache( $this->date );
		} catch ( Exception $e ) {
			throw $e;
		}
	}

	/*
	 * インスタンスを取得
	 */
	public static function getInstance( $cache_dir = null ) {
		if ( empty( $instance ) ) {
			try {
				$instance = new BingWallpaperUtils( $cache_dir );
			} catch ( Exception $e ) {
				throw $e;
			}
		}
		return $instance;
	}

	/*
	 * 壁紙ファイル名取得
	 */
	public function getFilename() {
		return $this->filename;
	}

	/*
	 *  壁紙コピーライト情報を取得
	 */
	public function getCopyright() {
		return $this->copyright;
	}

	/*
	 * 不要なキャッシュを消去
	 */
	private function clearCache( $ex_date ) {
		$this->cache->clearCache(array(
			$ex_date . '.jpg',
			$ex_date . '.json'
		));
	}

	/*
	 * 壁紙を生成する
	 */
	private function createWallpaper() {
		$date = date_i18n( 'Ymd' );
		try {
			$json = $this->cache->getContents(
				'http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=' . get_locale(),
				$date . '.json'
			);
			$data = json_decode( $json, true );

			$url = 'http://bing.com' . $data['images'][0]['url'];
			$wp_filename = $date . '.jpg';
			$this->cache->getContents( $url, $wp_filename );

			$this->copyright = $data['images'][0]['copyright'];
			$this->date = $date;
		} catch ( Exception $e ) {
			throw $e;
		}

		return $wp_filename;
	}
}

?>
