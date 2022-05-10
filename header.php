<?php

/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
    <?php astra_head_top(); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
    <?php astra_body_top(); ?>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#content" role="link" title="<?php echo esc_html(astra_default_strings('string-header-skip-link', false)); ?>">
        <?php echo esc_html(astra_default_strings('string-header-skip-link', false)); ?>
    </a>

    <div <?php
            echo astra_attr(
                'site',
                array(
                    'id'    => 'page',
                    'class' => 'hfeed site',
                )
            );
            ?>>
        <?php
        // astra_header_before();

        // astra_header();

        // astra_header_after();

        // astra_content_before();
        function wp_get_menu_array($current_menu)
        {

            $array_menu = wp_get_nav_menu_items($current_menu);
            $menu = array();
            foreach ($array_menu as $m) {
                if (empty($m->menu_item_parent)) {
                    $menu[$m->ID] = array();
                    $menu[$m->ID]['ID']      =   $m->ID;
                    $menu[$m->ID]['title']       =   $m->title;
                    $menu[$m->ID]['url']         =   $m->url;
                    $menu[$m->ID]['children']    =   array();
                }
            }
            $submenu = array();
            foreach ($array_menu as $m) {
                if ($m->menu_item_parent) {
                    $submenu[$m->ID] = array();
                    $submenu[$m->ID]['ID']       =   $m->ID;
                    $submenu[$m->ID]['title']    =   $m->title;
                    $submenu[$m->ID]['url']  =   $m->url;
                    $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
                }
            }
            return $menu;
        }
        ?>
        <ul>
            <?php foreach (wp_get_menu_array('header-menu') as $menu) : ?>
                <li>
                    <?= $menu['title'] ?>
                    <?php if ($menu['children']) : ?>
                        <ul>
                            <?php foreach ($menu['children'] as $submenu) : ?>
                                <li>
                                    <?= $submenu['title'] ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
        <form action="http://localhost:8000/" method="get">
            <input type="text" name="s" id="searchForm">
            <button type="submit">Search</button>
        </form>
        <?php
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();

        foreach ($items as $item => $values) {
            $_product =  wc_get_product($values['data']->get_id());
            //product image
            $getProductDetail = wc_get_product($values['product_id']);
            echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )

            echo "<b>" . $_product->get_title() . '</b>  <br> Quantity: ' . $values['quantity'] . '<br>';
            $price = get_post_meta($values['product_id'], '_price', true);
            echo "  Price: " . $price . "<br>";
            /*Regular Price and Sale Price*/
        }
        $amount2 = $woocommerce->cart->get_cart_total();
        ?>
        <?= $amount2 ?>
        <div id="content" class="site-content">
            <div class="ast-container">
                <?php astra_content_top(); ?>