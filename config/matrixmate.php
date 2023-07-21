<?php

return [
    'fields' => [
        'contentBlocks' => [
            'groups' => [[
                'label' => 'Text Blocks',
                'types' => ['textSingleColumn', 'textDoubleColumn', 'statement', 'statistics'],
            ], [
                'label' => 'Image Blocks',
                'types' => ['imageGrid', 'imageSlideshow', 'imageCarousel'],
            ], [
                'label' => 'Video Blocks',
                'types' => ['videoUpload', 'videoEmbed'],
            ]]
        ]
    ],
];