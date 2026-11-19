<?php

if (!defined('ABSPATH')) exit;

$title = $attributes['title'] ?? 'What I Loved';
$items = $attributes['items'] ?? [];

ob_start();
?>

<div class="bg-blue-50 rounded-xl p-6 border border-blue-100">

    <h3 class="text-blue-800 font-bold text-lg mb-4 flex items-center">
        <i class="fas fa-info-circle mr-2"></i>
        <?php echo esc_html($title); ?>
    </h3>

    <ul class="space-y-3 text-sm text-blue-700">
        <?php foreach ($items as $item) : ?>
            <li class="flex items-start">
                <i class="fas fa-circle text-xs mt-2 mr-2"></i>
                <?php echo esc_html($item); ?>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<?php
return ob_get_clean();