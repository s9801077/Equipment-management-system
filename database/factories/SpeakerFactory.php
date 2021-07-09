<?php

use App\Speaker;

$factory->define(Speaker::class, function (Faker\Generator $faker) {
    $zhFaker = Faker\Factory::create('zh_TW');

    $tags = $faker->randomElements(array_keys(Speaker::$tagItem), $faker->numberBetween(0, count(Speaker::$tagItem) - 1));
    sort($tags);
    $agree_record = rand(0, 1);

    return [
        'name' => $zhFaker->name,
        'name_e' => $faker->name,
        'real_name' => $faker->name,
        'company' => $zhFaker->company,
        'company_e' => $faker->company,
        'job_title' => $zhFaker->jobTitle,
        'job_title_e' => $faker->jobTitle,
        'contact_phone' => $zhFaker->phoneNumber,
        'contact_email' => $zhFaker->email,
        'contact_address' => $zhFaker->address,
        'bio' => $zhFaker->text(120),
        'bio_e' => $faker->text(240),
        'photo' => 'https://picsum.photos/500',
        'link_fb' => $faker->url,
        'link_github' => $faker->url,
        'link_twitter' => $faker->url,
        'link_other' => $faker->url,
        'link_slide' => $faker->url,
        'link_pre_video' => $faker->url,
        'link_video' => $faker->url,
        'topic' => $zhFaker->text(16),
        'topic_e' => $faker->text(32),
        'summary' => $zhFaker->text(480),
        'summary_e' => $faker->text(480),
        'tag' => $tags,
        'level' => rand(0, count(Speaker::$levelItem) - 1),
        'target_audience' => $zhFaker->text(64),
        'prerequisites' => $zhFaker->text(120),
        'agree_record' => $agree_record,
        'agree_act_change' => rand(0, 1),
        'license' => $agree_record == 1 ? rand(0, count(Speaker::$licenseItem) - 1) : null,
        'promotion' => rand(0, 1),
        'will_forward_posts' => rand(0, 1),
        'tshirt_size' => rand(0, count(Speaker::$tshirtSizeItem) - 1),
        'need_parking_space' => rand(0, 1),
        'year' => $faker->year,
        'has_dinner' => rand(0, 1),
        'meal_preference' => rand(0, count(Speaker::$mealPreferenceItem) - 1),
        'has_companion' => rand(0, 10),
        'speaker_status' => rand(0, count(Speaker::$speakerStatusItem) - 1),
        'speaker_type' => rand(0, count(Speaker::$speakerTypeItem) - 1),
        'is_keynote' => $faker->boolean(33),
        'note' => $zhFaker->text(),
    ];
});
