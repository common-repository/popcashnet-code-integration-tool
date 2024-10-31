<?php
/*
Plugin Name: PopCash Code Integration Tool
Plugin URI: https://popcash.net/
Description: PopCash Popunder code integration plugin
Version: 1.8
Author: PopCash
Author URI: http://popcash.net/
*/

register_activation_hook(__FILE__, 'popcash_net_install');
register_deactivation_hook(__FILE__, 'popcash_net_remove');

function popcash_net_install()
{
  add_option("popcash_net_uid"         , '' , '', 'yes');
  add_option("popcash_net_wid"         , '' , '', 'yes');
  add_option("popcash_net_fcap"        , '1', '', 'yes');
  add_option("popcash_net_fallback"    , '' , '', 'yes');
  add_option("popcash_net_api_key"     , '' , '', 'yes');
  add_option("popcash_net_disabled"    , '0', '', 'yes');
  add_option("popcash_net_integration" , '0', '', 'yes');
}

function popcash_net_remove()
{
  delete_option('popcash_net_uid');
  delete_option('popcash_net_wid');
  delete_option('popcash_net_fallback');
  delete_option('popcash_net_disabled');
  delete_option('popcash_net_api_key');
  delete_option('popcash_net_fcap');
  delete_option('popcash_net_integration');
}

function pcit_popcash_register_mysettings()
{
  register_setting('myoption-group', 'popcash_net_disabled', 'pcit_popcash_switch_enabled');

  register_setting('myoption-group', 'popcash_net_uid', 'pcit_popcash_uid_validation');
  register_setting('myoption-group', 'popcash_net_wid', 'pcit_popcash_wid_validation');
  register_setting('myoption-group', 'popcash_net_fallback', 'pcit_popcash_fallback_validation');


  register_setting('myoption-group3', 'popcash_net_uid', 'pcit_popcash_uid_validation');
  register_setting('myoption-group3', 'popcash_net_wid', 'pcit_popcash_wid_validation');
  register_setting('myoption-group3', 'popcash_net_fallback', 'pcit_popcash_fallback_validation');
  register_setting('myoption-group3', 'popcash_net_api_key');
  register_setting('myoption-group3', 'popcash_net_fcap');
}

function pcit_popcash_load_custom_wp_admin_style($hook)
{
  if($hook != 'toplevel_page_popcash-net') {
    return;
  }
  wp_register_script( 'pcit_popcash_script', plugins_url( 'assets/pcit_popcash_script.js', __FILE__ ), false, '' );
  wp_enqueue_script( 'pcit_popcash_script' );

  wp_register_style('pcit_popcash_bootstrap', plugins_url('assets/bootstrap.min.css', __FILE__), false, '');
  wp_enqueue_style('pcit_popcash_bootstrap');

  wp_register_style('pcit_popcash_pcit_popcash_style', plugins_url('assets/pcit_popcash_style.css', __FILE__), false, '');
  wp_enqueue_style('pcit_popcash_pcit_popcash_style');

  wp_localize_script(
    'pcit_popcash_script',
    'pcit_popcash_globals', [ 'fcap' => get_option('popcash_net_fcap') ]
  );
}
add_action('admin_enqueue_scripts', 'pcit_popcash_load_custom_wp_admin_style');

if (is_admin()) {

  add_action('admin_menu', 'pcit_popcash_popcash_net_admin_menu');
  add_action('admin_init', 'pcit_popcash_register_mysettings');
  add_action('wp_loaded' , 'pcit_popcash_switch_enabled');

  function pcit_popcash_popcash_net_admin_menu()
  {
    add_menu_page('PopCash', 'Popcash', 'administrator', 'popcash-net', 'pcit_popcash_popcash_net_publisher_code', 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iMjU2LjAwMDAwMHB0IiBoZWlnaHQ9IjI1Ni4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDI1Ni4wMDAwMDAgMjU2LjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgoKPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsMjU2LjAwMDAwMCkgc2NhbGUoMC4xMDAwMDAsLTAuMTAwMDAwKSIKZmlsbD0iIzAwMDAwMCIgc3Ryb2tlPSJub25lIj4KPHBhdGggZD0iTTEwMzUgMjQ5NSBjLTI4NiAtNjMgLTU1OSAtMjQwIC03MzUgLTQ3NiAtMTA1IC0xNDIgLTE5NyAtMzUyIC0yMzEKLTUyOSAtMTYgLTg3IC0xNiAtMzM3IDAgLTQzMCA1NCAtMzA5IDIzMCAtNTk3IDQ4MCAtNzg2IDExNCAtODYgMjk4IC0xNzcgNDI1Ci0yMDkgMTQ3IC0zNyAxMzYgLTQ1IDEzNiA5MCAwIDg0IC0zIDExNyAtMTIgMTE5IC0yMDIgNTggLTM3NCAxNDIgLTUxOCAyNTUKbC0yNCAxOSAxMTkgMTgxIGM2NiA5OSAxMjMgMTgxIDEyNyAxODEgNCAwIDQ2IC0yNSA5MyAtNTYgOTkgLTY1IDIwMCAtMTEzCjMwNSAtMTQ2IDYwIC0xOCA5NyAtMjMgMTkwIC0yMyAxMDAgMCAxMjAgMyAxNTcgMjMgNTEgMjcgNzMgNjUgNzMgMTI1IDAgODcKLTU2IDEyMiAtMzU0IDIyMSAtMTA5IDM3IC0yMzkgODcgLTI4OSAxMTMgLTE0NyA3NiAtMjUwIDE4NSAtMjk5IDMxOSAtMTggNDkKLTIxIDgwIC0yMiAxODkgMCAxMTQgMyAxNDAgMjcgMjEwIDMyIDk3IDkwIDE4OCAxNTggMjQ5IDQ3IDQyIDE5NCAxMjUgMjQ3CjEzOCAyMSA2IDIyIDEwIDIyIDEyMiAwIDY0IC0zIDExNiAtNyAxMTUgLTUgMCAtMzUgLTcgLTY4IC0xNHoiLz4KPHBhdGggZD0iTTE0ODAgMjM5MSBsMCAtMTA4IDExOCAtMzIgYzEyOSAtMzQgMjQ0IC03OCAzMzkgLTEzMCA3OSAtNDIgOTggLTYzCjg0IC04OCAtNiAtMTAgLTQ3IC05NCAtOTIgLTE4OCAtNDQgLTkzIC04MiAtMTcxIC04NCAtMTczIC0xIC0yIC01NiAyNCAtMTIxCjU3IC0yMzEgMTE1IC0zODQgMTQ1IC00OTIgOTQgLTQwIC0xOSAtNjIgLTU5IC02MiAtMTEyIDAgLTc1IDY3IC0xMjMgMjkwCi0yMDYgMzU3IC0xMzQgNDgwIC0yMTkgNTY2IC0zOTEgMzMgLTY1IDM2IC04MCA0MSAtMTg1IDQgLTcwIDEgLTE0MSAtNiAtMTgzCi0xNSAtODggLTc1IC0yMDcgLTE0MCAtMjc4IC05MSAtOTkgLTI0MSAtMTg0IC0zNzMgLTIxMSBsLTYzIC0xMyAtMyAtMTAyIC0zCi0xMDMgMjggNyBjMjMxIDUzIDM5OCAxMzQgNTY3IDI3NiAyNjkgMjI2IDQyNSA1NDEgNDQzIDg5NCAxMCAxOTkgLTI5IDM5NQotMTE1IDU3NyAtNjYgMTQwIC0xMzggMjQyIC0yNDcgMzUzIC0xMzIgMTMzIC0yNTcgMjE2IC00MzUgMjg4IC01MCAyMCAtMjEzCjY2IC0yMzYgNjYgLTIgMCAtNCAtNDkgLTQgLTEwOXoiLz4KPC9nPgo8L3N2Zz4K');


  }
}

$popcash_it_vars = (object) [
  'uid'         => get_option('popcash_net_uid'),
  'wid'         => get_option('popcash_net_wid'),
  'fallback'    => get_option('popcash_net_fallback'),
  'fcap'        => get_option('popcash_net_fcap'),
  'apiKey'      => get_option('popcash_net_api_key'),
  'integration' => get_option('popcash_net_integration'),
];

require('functions.php');

if (get_option('popcash_net_disabled') == false) {
  if ((($popcash_it_vars->apiKey) != null) && ($popcash_it_vars->wid) != null && $popcash_it_vars->integration == 2) {
    add_action('wp_footer', 'pcit_popcash_add_aab');
  } elseif ((($popcash_it_vars->uid) != null) && ($popcash_it_vars->wid) != null  && $popcash_it_vars->integration == 1) {
    add_action('wp_footer', 'pcit_popcash_add_individual_ids');
  }
}
