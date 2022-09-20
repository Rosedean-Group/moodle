<?php
$templatecontext = [
    'logo' => $OUTPUT->image_url('logo', 'theme'),
];

echo $OUTPUT->render_from_template('theme_spso/navbar', $templatecontext);