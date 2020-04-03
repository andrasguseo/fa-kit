<?php
/**
 * Plugin Name:     Font Awesome Kit for Wordpress
 * Plugin URI:      https://www.divi-magazine.com
 * Description:     Easily add Font Awesome Kit code to WordPress. Nothing more, nothing less.
 * Version:         1.0
 * Author:          Andras Guseo | The Divi Magazine
 * Author URI:      https://www.divi-magazine.com
 * License:         GPL version 3 or any later version
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:     tdm-font-awesome-kit-for-wordpress
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

namespace TDM\FA_Kit_For_Wp;

include ( 'classes/hooks.class.php' );
include ( 'classes/actionlinks.class.php' );
include ( 'classes/settings.class.php' );

$hooks = new Hooks(); // Nothing is happening here, just getting an instance of it.
$hooks->setup_languages();
$hooks->add_filters();
$hooks->add_actions();