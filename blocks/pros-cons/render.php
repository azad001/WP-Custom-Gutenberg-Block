<?php

if (!defined('ABSPATH')) exit;

$prosTitle = $attributes['prosTitle'] ?? '';
$consTitle = $attributes['consTitle'] ?? '';
$pros = $attributes['pros'] ?? [];
$cons = $attributes['cons'] ?? [];

ob_start();
?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-10 font-sans">

    <!-- PROS -->
    <div class="bg-green-50 rounded-xl p-6 border border-green-100">
        <h3 class="text-green-800 font-bold text-lg mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576zM438 209.7C427.3 201.9 412.3 204.3 404.5 215L285.1 379.2L233 327.1C223.6 317.7 208.4 317.7 199.1 327.1C189.8 336.5 189.7 351.7 199.1 361L271.1 433C276.1 438 282.9 440.5 289.9 440C296.9 439.5 303.3 435.9 307.4 430.2L443.3 243.2C451.1 232.5 448.7 217.5 438 209.7z"/></svg>
            <?php echo esc_html($prosTitle); ?>
        </h3>

        <ul class="space-y-3 text-sm text-green-700">
            <?php foreach ($pros as $item) : ?>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-1 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z"/></svg>
                    <?php echo esc_html($item); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- CONS -->
    <div class="bg-red-50 rounded-xl p-6 border border-red-100">
        <h3 class="text-red-800 font-bold text-lg mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM231 231C240.4 221.6 255.6 221.6 264.9 231L319.9 286L374.9 231C384.3 221.6 399.5 221.6 408.8 231C418.1 240.4 418.2 255.6 408.8 264.9L353.8 319.9L408.8 374.9C418.2 384.3 418.2 399.5 408.8 408.8C399.4 418.1 384.2 418.2 374.9 408.8L319.9 353.8L264.9 408.8C255.5 418.2 240.3 418.2 231 408.8C221.7 399.4 221.6 384.2 231 374.9L286 319.9L231 264.9C221.6 255.5 221.6 240.3 231 231z"/></svg>
            <?php echo esc_html($consTitle); ?>
        </h3>

        <ul class="space-y-3 text-sm text-red-700">
            <?php foreach ($cons as $item) : ?>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-1 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"/></svg>
                    <?php echo esc_html($item); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<?php
return ob_get_clean();