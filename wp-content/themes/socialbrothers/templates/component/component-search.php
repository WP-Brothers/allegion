<?php declare(strict_types=1); ?>
<form role="search" method="get" action="<?= home_url('/'); ?>">
    <input type="search" placeholder="<?= __('Waar bent u naar opzoek?', '_SBF'); ?>" value="<?= get_search_query(); ?>" name="s" />
    <button type="submit"><?= __('Zoeken', '_SBF'); ?></button>
</form>
