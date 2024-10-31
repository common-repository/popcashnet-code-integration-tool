<?php

global $popcash_it_vars;

// PopCash Anti AdBlock PHP Script
// Release Date: 08 December 2022
// Version: 1.0.1

$UID     =  $popcash_it_vars->uid;    // Your publisherID
$WID     =  $popcash_it_vars->wid;    // Your domainID
$TOKEN   =  $popcash_it_vars->apiKey; // Token used in PopCash API

$OPTIONS = [
  "pop_fback" => $popcash_it_vars->fallback ? 'up' : 'under', // values: 'under' or 'up'
  "pop_fcap"  => $popcash_it_vars->fcap,  // How many ads we should show in a 24 hours time frame.
  "pop_delay" => "0", // popunder delay from the user click (in seconds) - Default is 0
];

class PopcashPublisherScript
{

  /**
   * cache
   *
   * @var array
   */
  protected $cache = [
    'enabled' => true,
    'key'     => 'ppch-h6IzF4iRLEdZV-QX82hhpzmvxX--',
  ];

  /**
   * endpoint
   *
   * @var string
   */
  public $endpoint = 'https://api-js.popcash.net/getCode?';

  /**
   * timeout
   *
   * @var int
   */
  public $timeout = 2;

  /**
   * uid
   *
   * @var string
   */
  public $uid = '0';

  /**
   * wid
   *
   * @var string
   */
  public $wid = '0';

  /**
   * token
   *
   * @var string
   */
  public $token = '';

  /**
   * options
   *
   * @var array
   */
  public $options;

  /**
   * expiration
   *
   * @var int
   */
  public $expiration = 10 * 60;

  /**
   * Constructor
   *
   * @param mixed $uid
   * @param mixed $wid
   * @param mixed $token
   * @param array $options
   */
  public function __construct($uid, $wid, $token, $options=[])
  {

    $this->uid           = $uid;
    $this->wid           = $wid;
    $this->token         = $token;
    $this->options       = $options;
    $this->cache['key'] .= "$uid-$wid";
  }

  /**
   * getCode
   *
   * @access public
   */
  public function getCode()
  {


    $code = $this->getCache()->get($this->cache['key']);

    if($this->cache['enabled'] && $code = $this->getCache()->get($this->cache['key'])) {
      return (object) ['response' =>$code, 'cacheStatus' => 1];
    }

    $userAgent = sanitize_text_field( (isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT']))
       ? $_SERVER['HTTP_USER_AGENT']
       : '');

    $response = wp_remote_get($this->endpoint . "uid={$this->uid}&wid={$this->wid}&apikey={$this->token}&" . http_build_query($this->options), [
      'timeout'    => $this->timeout,
      'user-agent' => $userAgent,
    ]);

    $cacheStatus = $this->cache['enabled'];

    $body = wp_remote_retrieve_body($response);

    if ($this->cache['enabled'] && wp_remote_retrieve_response_code($response) == 200) {
      $cacheStatus = $this->getCache()->set($this->cache['key'], $body, $this->expiration);
    }

    return (object) [
      'response'    => $body,
      'cacheStatus' => $cacheStatus,
    ];
  }

  /**
   * fromCache
   *
   * @access public
   */
  public function getCache()
  {

    return new PopcashPublisherScriptSimpleFile($this->expiration);
  }

  /**
   * getCacheKey
   *
   * @access public
   */
  public function getCacheKey()
  {

    return $this->cache['key'];
  }
}

class PopcashPublisherScriptSimpleFile
{

  /**
   * expiration
   *
   * @var int
   */
  protected $expiration;

  /**
   * Constructor
   *
   * @param mixed $expiration
   */
  public function __construct($expiration)
  {
    $this->expiration = $expiration;
  }

  /**
   * set
   *
   * @param mixed $filename
   * @param mixed $content
   * @access public
   * @return void
   */
  function set($filename, $content)
  {

    try {
      $file = @fopen(plugin_dir_path( __FILE__ ) . "$filename", 'w');
      if (!$file) {
        return false;
      }
      fwrite($file, $content);
      return fclose($file);
    } catch (\Exception $e) {

      return false;
    }
  }

  function get($filename)
  {

    try {
      if (!file_exists(plugin_dir_path( __FILE__ ) . "$filename")) {
        return false;
      }
      $content = file_get_contents(plugin_dir_path( __FILE__ ) . "$filename");
      if (!$content) {
        return false;
      }
      if (time() - filemtime(plugin_dir_path( __FILE__ ) . "$filename") > $this->expiration) {
        unlink(plugin_dir_path( __FILE__ ) . "$filename");
        return false;
      }
      return $content;
    } catch (\Exception $e) {
      return false;
    }
  }
}

$ps = new PopcashPublisherScript($UID , $WID, $TOKEN, $OPTIONS);

echo (
  "<script type='text/javascript'>" .
  ($ps->getCode()->cacheStatus == 1 ? "////// {$ps->getCacheKey()}///////\n\n" : "////// no store//////////\n\n") . $ps->getCode()->response .
  "</script>"
);

?>
