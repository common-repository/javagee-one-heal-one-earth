<?php
/**
 * Javagee One Heal One Earth Plugin is a wordpress plugin that show users or sites to support the fight against COVID-19 (Corona Virus) Global Pandemic 2020.
 * This plugin will show the One Heal One Earth Logo within their website.
 *
 * PHP Version 5.6+
 *
 * @category  PHP
 * @package   Javagee One Heal Plugin
 * @author    Gerard Gilok Espinas<gerardespinas@gmail.com>
 * @copyright 2020 Gerard Espinas (Javagee)
 * @license   GPL 2.0
 * @link      http://www.gnu.org/licenses/gpl-2.0.html
 *
 *            @ wordpress-plugin
 *            Plugin Name: Javagee One Heal One Earth
 *            Plugin URI: https://wordpress.org/plugins/javagee-one-heal-one-earth/
 *            Description: Javagee One Heal One Earth Plugin is a wordpress plugin that show users or sites to support the fight against COVID-19 (Corona Virus) Global Pandemic 2020. This plugin will show the One Heal One Earth Logo within their website.
 *            Version: 1.0.0
 *            Author: Gerard Gilok Espinas
 *            Author URI: https://profiles.wordpress.org/javagee/
 *            Text Domain: javagee-one-heal-one-heal-plugin
 *            Contributors: Javagee
 *            License: GPL 2.0
 *            License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace JavageeOneHealOneEarth;

define('JAVAGEE_ONE_HEAL_BASE_PATH', plugin_dir_path(__FILE__));
define('JAVAGEE_ONE_HEAL_BASE_URL', plugin_dir_url(__FILE__));


/**
 * Plugin Class
 *
 * @category PHP
 * @package  OneHealOneEarth
 * @author   Javagee <gerardespinas@gmail.com>
 * @license  GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */
class OHOE_OneHealOneEarth
{


    /**
     * Class Constructor
     *
     * @return void
     */
    public function __construct()
    {
        //Add Menu
        add_action('admin_menu', [$this, 'ohoe_addMenu']);

        //Add Bootstrap in the frontend
        add_action('wp_enqueue_scripts', [$this, 'ohoe_prefix_enqueue']);

        //Add Bootstrap in the admin page
        add_action( 'admin_enqueue_scripts', [$this, 'ohoe_prefix_admin_enqueue']);

        //Register Activate Hook
        add_action('init', [$this, 'ohoe_registerActivationHook']);

        //Register Deactivate Hook
        add_action('init', [$this, 'ohoe_registerDeactivationHook']);

        //Add ShortCode
        add_shortcode('OneHeal', [$this, 'ohoe_showLogo']);

    }


    /**
     * Add the plugin admin menu
     *
     * @return void
     */
    public function ohoe_addMenu()
    {
        add_menu_page(
            'Javagee One Heal One Earth Page',
            'Javagee One Heal One Earth',
            'manage_options',
            'one-heal-one-earth',
            [$this, 'ohoe_initMenu']
        );
    }


    /**
     * Enqueue Plugin JS & CSS in Front End
     *
     * @return void
     */
    function ohoe_prefix_enqueue()
    {
        // JS
        wp_enqueue_script( 'jquery' );

        wp_register_script('prefix_bootstrap', JAVAGEE_ONE_HEAL_BASE_URL.'js/bootstrap.min.js');
        wp_enqueue_script('prefix_bootstrap');

        // CSS
        wp_register_style('prefix_bootstrap', JAVAGEE_ONE_HEAL_BASE_URL.'css/bootstrap.min.css');
        wp_enqueue_style('prefix_bootstrap');

        wp_register_style('prefix_bootstrap_fontawesome', JAVAGEE_ONE_HEAL_BASE_URL.'css/font-awesome.min.css');
        wp_enqueue_style('prefix_bootstrap_fontawesome');

        wp_register_style('prefix_bootstrap_facebook_button_logo', JAVAGEE_ONE_HEAL_BASE_URL.'css/style.css');
        wp_enqueue_style('prefix_bootstrap_facebook_button_logo');

    }


    /**
     * Enqueue Plugin JS & CSS in Admin Area
     *
     * @return void
     */
    function ohoe_prefix_admin_enqueue()
    {
        // JS
        wp_register_script('prefix_bootstrap', JAVAGEE_ONE_HEAL_BASE_URL.'js/bootstrap.min.js');
        wp_enqueue_script('prefix_admin_bootstrap');

        // CSS
        wp_register_style('prefix_admin_bootstrap', JAVAGEE_ONE_HEAL_BASE_URL.'css/bootstrap-custom.css');
        wp_enqueue_style('prefix_admin_bootstrap');

        wp_register_style('prefix_bootstrap_fontawesome', JAVAGEE_ONE_HEAL_BASE_URL.'css/font-awesome.min.css');
        wp_enqueue_style('prefix_bootstrap_fontawesome');

        wp_register_style('prefix_bootstrap_facebook_button_logo', JAVAGEE_ONE_HEAL_BASE_URL.'css/style.css');
        wp_enqueue_style('prefix_bootstrap_facebook_button_logo');
    }


    /***
     * Add the plugin admin option settings
     *
     * @return void
     */
    public function ohoe_initMenu()
    {

        $image = JAVAGEE_ONE_HEAL_BASE_URL.'image/oneheal.png';

        $image_encoded = urlencode($image);


        ?>
        <div class="wrap">
           <h2>Javagee One Heal One Earth Plugin</h2>
        </div>
        <!--<div class="plugin-content">-->
        <div class="bootstrap-wrapper">
        <!--<div>-->
            <div class="row">
                <div class="col-sm-6">
                    <!--Card-->
                    <!-- Card -->
                    <div class="card">

                        <!-- Card image -->
                        <img class="card-img-top" src="<?php  echo $image; ?>" alt="Card image cap">

                        <!-- Card content -->
                        <div class="card-body">

                            <!-- Title -->
                            <h4 class="card-title"><a>One Heal One Earth Campaign</a></h4>
                            <!-- Text -->
                            <p class="card-text">Show Your Support to Fight against COVID-19 Global Pandemic by sharing this plugin to other WordPress website owners</p>
                            <!-- Button -->
                            <!--<a href="#" class="btn btn-primary">Button</a>-->
                            <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://wordpress.org/plugins/javagee-one-heal-one-earth/&p[images][0]=<?php  echo $image_encoded; ?>&p[title]=Javagee%20One%20Heal%20One%20Campaign&p[summary]=Javagee%20One%20Heal%20One%20Earth%20Plugin%20is%20a%20wordpress%20plugin%20that%20show%20users%20or%20sites%20solidarity%20and%20support%20to%20fight%20the%20NCOVID-19%20Virus%20and%20save%20the%20human%20race"
                               target="_blank"
                               onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false">

                                <button style="width:100%; margin-top:10px;" type="button" class="btn btn-facebook btn-lg"><i class="fa fa-facebook fa-2"></i> Share on Facebook</button></a
                        </div>

                    </div>
                    <!--/.Card-->

                </div>
                <div class="col-sm-6">
                    <!--Card-->
                    <div class="card">

                        <!--Card content-->
                        <div class="card-body">
                            <!--Title-->
                            <h4 class="card-title">Default Shortcode</h4>
                            <!--Text-->
                            <p class="card-text">Place this shortcode to any post/page: [OneHeal]</p>
                            <h4 class="card-title">Image Size Shortcode</h4>
                            <!--Text-->
                            <p class="card-text">Adjust width and height: <br>[OneHeal width=250px height=250px]</p>
                        </div>

                    </div>
                    <!--/.Card-->

                </div>

            </div>
        </div>
        <!--</div>-->
        <?php

    }

    public function ohoe_registerActivationHook()
    {
        register_activation_hook(__FILE__, [$this, 'plugin_activate']); //activate hook
    }

    public function ohoe_registerDeactivationHook()
    {
        register_deactivation_hook(__FILE__, [$this, 'plugin_deactivate']); //deactivate hook
    }


    /***
     * Shortcode to LOGO Conversion
     *
     * @return string
     */
    public function ohoe_showLogo($atts = array(), $content = null, $tag)
    {


        $image = JAVAGEE_ONE_HEAL_BASE_URL.'image/oneheal.png';
        $image_encoded = urlencode($image);


        extract(
            shortcode_atts($default=array(
                'width' => '500px',
                'height' => '500px'
            ), $atts));

        ?>
        <div class="plugin-content">
            <div class="row">
                <div class="col-sm-12">
                
                    <!-- Card -->
                    <div class="card">

                        <!-- Card image -->
                        <img class="card-img-top mx-auto" style=display:block;width:<?php echo $width ?>;height:<?php echo $height ?>;margin-top:10px; src="<?php echo $image ?>" alt="One Heal One Earth Logo" >

                        <!-- Card content -->
                        <div class="card-body">

                            <!-- Title -->
                            <h4 class="card-title"><a>One Heal One Earth Campaign</a></h4>
                            <!-- Text -->
                            <p class="card-text">Show Your Support to Fight against COVID-19 Global Pandemic by sharing this plugin to other WordPress website owners</p>
                            <!-- Button -->
                            <!--<a href="#" class="btn btn-primary">Button</a>-->
                            <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=https://wordpress.org/plugins/javagee-one-heal-one-earth/&p[images][0]=<?php $image_encoded ?>&p[title]=Javagee%20One%20Heal%20One%20Earth%20Campaign&p[summary]=Javagee%20One%20Heal%20Plugin%20is%20a%20wordpress%20plugin%20that%20show%20users%20or%20sites%20solidarity%20and%20support%20to%20fight%20the%20NCOVID-19%20Virus%20and%20save%20the%20human%20race"
                               target="_blank"
                               onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false">

                                <button style="width:100%; margin-top:10px;" type="button" class="btn btn-facebook btn-lg"><i class="fa fa-facebook fa-2"></i> Share on Facebook</button></a>

                        </div>

                    </div>
                    <!--/.Card-->

                </div>                

             </div>
        </div>
        <?php

    }
}


new OHOE_OneHealOneEarth();

