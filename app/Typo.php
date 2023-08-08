<?php

/**
 * Class Typo
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SiteManagement;

/**
 * Class Typo
 *
 */
class Typo extends Model
{
    /**
     * Set site custom styling
     *
     * @access public
     *
     * @return array
     */
    public static function setSiteStyling()
    {
        $styling = SiteManagement::getMetaValue('general_settings');
        $primary_color = !empty($styling['enable_primary_color']) && $styling['enable_primary_color'] == 'true' ? $styling['primary_color'] : '#3fabf3';
        $secondary_color = !empty($styling['enable_secondary_color']) && $styling['enable_secondary_color'] == 'true' ? $styling['secondary_color'] : '#ff5851';
        $tertiary_color = !empty($styling['enable_tertiary_color']) && $styling['enable_tertiary_color'] == 'true' ? $styling['tertiary_color'] : '#3d4461';
        if (!empty($primary_color) || !empty($secondary_color) || !empty($tertiary_color)) {
            ob_start(); ?>
            <style>
                /* Primary Color*/
                :root {--themecolor:<?php echo $primary_color; ?>}
                /* Secondary Color*/
                :root {--secthemecolor:<?php echo $secondary_color; ?>}
                /* tertiary Color*/
                :root {--terthemecolor:<?php echo $tertiary_color; ?>}
                /* Boxshadow  Color*/
                :root {--shadowcolor:rgba(63,171,243,0.5);}
            </style>
            <?php return ob_get_clean();
        }
    }
}
