<?php

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.

function hvp_get_coursemodule_info($hvp) {
    global $DB;
    global $CFG;
    $defaulturl = null;
    $info = new cached_cm_info();

    $modtype = $DB->get_field_sql('SELECT main_library_id FROM {hvp} where id = ?', array($hvp->instance));
    $activityType = $DB->get_field_sql('SELECT machine_name FROM {hvp_libraries} WHERE id = ?', array($modtype));
    $info->iconurl = '/theme/spso/pix/icons/' . slugify($activityType) . '.svg';

    if(!file_exists($CFG->dirroot . $info->iconurl)) {
        $info->iconurl = '/theme/spso/pix/icons/activity.svg';
    }

    $info->name = $hvp->name;

    return $info;
}

function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}