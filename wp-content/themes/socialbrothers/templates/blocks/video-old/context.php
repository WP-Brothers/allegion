<?php

add_filter(
    'wpb_twig_video-old_context',
    function (array $context): array {
        return wpb_build_video_context($context);
    }
);
