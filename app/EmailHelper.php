<?php
/**
 * Class EmailHelper
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use App\SiteManagement;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailHelper
 *
 */
class EmailHelper extends Model
{
    /**
     * Get email header
     *
     * @access public
     *
     * @return mixed
     */
    public static function getEmailHeader()
    {
        ob_start();
        $setting      = array();
        $email_banner =  '';
        $setting      = SiteManagement::getMetaValue('email_data');
        $email_banner = !empty($setting) && !empty($setting['email_banner']) ? url('uploads/settings/email-settings/'.$setting['email_banner']): url('images/bglight.jpg');
        ?>
        <div style="min-width:100%;background-color:#f6f7f9;margin:0;width:100%;color:#283951;font-family:'Helvetica','Arial',sans-serif;padding: 60px 0;">
        <div style="background:#FFF;max-width: 600px; width: 100%; margin: 0 auto; overflow: hidden; color: #919191; font:400 16px/26px 'Open Sans', Arial, Helvetica, sans-serif;">
            <div style="padding: 30px 0px 10px 0px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <strong style="padding: 0 0 0 30px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <a style="color: #55acee; text-decoration: none;" href="#"><?php echo Self::getSiteTitle(); ?></a>
            </strong>
            </div>           
		<div style="padding: 0px 30px 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
			<div style="padding: 0 0 60px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get email footer
     *
     * @access public
     *
     * @return mixed
     */
    public static function getEmailFooter()
    {
        ob_start();
        $setting    = array();
        $setting  = SiteManagement::getMetaValue('footer_settings');
        $copyright = !empty($setting) && !empty($setting['copyright']) ? $setting['copyright'] : 'Copyright Doctry All Rights Reserved';
        ?>
        </div>
        </div>
        </div>
            <div style="background: #002c49;padding: 30px 15px;text-align:center;box-sizing:border-box;border-radius: 0  0 5px 5px;">
                <p style="font-size: 13px; line-height: 13px; color: #aaaaaa; margin: 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <?php echo $copyright; ?> <a href="<?php echo url('/'); ?>" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #348eda; margin: 0; padding: 0;"><?php echo Self::getSiteTitle(); ?></a></p>
            </div>
        </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get site title
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSiteTitle()
    {
        $title    = env('APP_NAME', 'Doctry');
        return $title;
    }

    /**
     * Get site logo
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSiteLogo()
    {
        $setting   = array();
        $logo      = '';
        $site_logo = url('images/logo.png');

        $setting = SiteManagement::getMetaValue('general_settings');
        $logo = !empty($setting) && !empty($setting['site_logo']) ? $setting['site_logo'] : '';
        $site_logo = !empty($logo) ? url('uploads/settings/general/'.$logo) : url('images/logo.png');
        return $site_logo;
    }

    /**
     * Get email signature
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSignature()
    {
        ob_start();
        $setting        = array();
        $sender_name    = 'Doctry';
        $sender_tagline = 'Doctry Best Doctor Inventory';
        $sender_url     = 'URL';

        $setting = SiteManagement::getMetaValue('email_data');
        $sender_name = !empty($setting) && !empty($setting['sender_name']) ? $setting['sender_name'] : 'Doctry';
        $sender_tagline = !empty($setting) && !empty($setting['sender_tagline']) ? $setting['sender_tagline'] : '';
        $sender_url = !empty($setting) && !empty($setting['sender_url']) ? $setting['sender_url'] : 'URL';
        ?>
        <div style="padding: 15px 0 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">         
            <div style="overflow: hidden; padding: 20px 0 0 2px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <p style="margin: 0 0 7px; font-size: 14px; line-height: 14px; color: #919191; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Thank you</p>
                <h2 style="font-size: 18px; line-height: 18px; margin: 0 0 5px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; color: #333; font-weight: normal;font-family: 'Work Sans', Arial, Helvetica, sans-serif;"><?php echo $sender_name; ?></h2>
                <p style="margin: 0 0 7px; font-size: 14px; line-height: 14px; color: #919191; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><?php echo $sender_tagline; ?></p>
                <p style="margin: 0; font-size: 14px; line-height: 14px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a style=" color: #55acee; text-decoration: none;" href="<?php echo $sender_url; ?>"><?php echo $sender_url; ?></a></p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
