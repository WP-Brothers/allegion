<?php

declare(strict_types=1);

// Disable /users rest routes
add_filter('rest_endpoints', function (array $endpoints): array {
    if (! current_user_can('administrator')) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }
        if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        }
    }

    return $endpoints;
});
