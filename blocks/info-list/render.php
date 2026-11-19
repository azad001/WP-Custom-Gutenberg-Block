<?php

if (!defined('ABSPATH')) exit;

$items = $attributes['items'] ?? [];

ob_start();
?>

<ul class="list-disc list-inside space-y-2 ml-4 font-sans text-base text-gray-600">
    
    <?php foreach ($items as $item) : 
        $label = $item['label'] ?? '';
        $text  = $item['text'] ?? '';
    ?>
        <li>
            <strong><?php echo esc_html($label); ?>:</strong>
            <?php echo esc_html($text); ?>
        </li>
    <?php endforeach; ?>

</ul>

<?php
return ob_get_clean();