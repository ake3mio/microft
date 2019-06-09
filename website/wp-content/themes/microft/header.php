<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <title>Microft</title>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div class="logo-wrapper">
        <a href="<?= get_home_url() ?>">
            <img src="<?php bloginfo('template_directory'); ?>/images/microft.svg" class="logo"/>
        </a>
    </div>
    <div class="site-inner">

        <div id="content" class="site-content">
