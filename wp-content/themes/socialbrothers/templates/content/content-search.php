<?php

declare(strict_types=1);

?>
<div class="container">
    <?php if (have_posts()) : ?>
        <h1>
            <?= sprintf(__('Zoekresultaten voor: %s', '_SBF'), $_GET['s']); ?>
            <small><?= sprintf(__('%s resultaten gevonden.', '_SBF'), $GLOBALS['wp_query']->post_count); ?></small>
        </h1>

        <?php get_template_part('templates/component/component', 'search'); ?>

        <div class="search-results">
            <?php while (have_posts()) : the_post(); ?>
                <div class="search-result">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <h1><?= __('Geen resultaten gevonden!', '_SBF'); ?></h1>
        <p><?= __('Helaas zijn er met de door u gekozen zoektermen geen resultaten gevonden. U kunt het opnieuw proberen met het onderstaande formulier of aan de hand van het menu aan de bovenzijde van de website.', '_SBF'); ?></p>
        <?php get_template_part('templates/component/component', 'search'); ?>
    <?php endif; ?>
</div>
