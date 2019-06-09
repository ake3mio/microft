<?php

get_header(); ?>

<div id="primary" class="content-area">


    <main id="main" class="site-main" role="main">
        <?php if (is_front_page()) : ?>

            <?php $slides = carbon_get_the_post_meta('slider'); ?>
            <div class="siema carousel">
                <?php foreach ($slides as $slide): ?>
                    <?php
                    $image = $slide['image'];
                    $title = $slide['title'];
                    ?>
                    <?php if (!empty($image)): ?>
                        <div class="carousel__item">
                            <?= wp_get_attachment_image($image, 'full') ?>
                            <h3 class="carousel__item-text">
                                <?= $title ?>
                            </h3>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
            <div class="content--main">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                };
                ?>
            </div>

            <div class="content content--mesh">
                <form action="/contact" method="post" class="contact-form clearfix">
                    <h3>Contact Us</h3>
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                        <small class="<?= feedbackClassName('name.required') ?>">
                            Name is required
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address*</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                               placeholder="Your email">
                        <small class="<?= feedbackClassName('email.invalid') ?>">
                            Email is invalid
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="emailHelp"
                               placeholder="Your phone number">
                    </div>
                    <div class="form-group">
                        <label for="message">Message*</label>
                        <textarea class="form-control contact-form__message" name="message" id="message"
                                  placeholder="Your message..."></textarea>
                        <small class="<?= feedbackClassName('message.required') ?>">
                            Message is required
                        </small>
                    </div>
                    <?= do_shortcode('[bws_google_captcha]') ?>
                    <?php wp_nonce_field('contact_form'); ?>
                    <input type="submit" class="btn btn-primary">
                </form>
                <?php if (isset($_SESSION['contact_form_submitted'])) : ?>
                    <div class="submit-feedback">
                        <p>Thanks - Your message has been sent.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <section id="primary" class="content-area">
                <main id="main" class="site-main">

                    <div class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title">Oops! That page can't be found.</h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p>It looks like nothing was found at this location.</p>
                        </div><!-- .page-content -->
                    </div><!-- .error-404 -->

                </main><!-- #main -->
            </section><!-- #primary -->

        <?php endif; ?>
    </main><!-- .site-main -->

</div><!-- .content-area -->
<?php $_SESSION['contact_form_errors'] = array(); ?>
<?php unset($_SESSION['contact_form_submitted']); ?>
<?php get_footer(); ?>
