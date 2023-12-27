<?php

declare(strict_types=1);

function strip_title(string $title): string
{
    return strip_tags($title, '<br><strong><span><em>');
}
