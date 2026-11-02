<?php

/*
| Every editable field of the public site. The admin "Customize" screen is generated from
| this list, so adding a field here makes it editable and available via SiteSetting::get().
| Types: text, textarea, url, image, color.
*/
return [
    'tabs' => [
        'brand' => [
            'label' => 'Header & Brand',
            'fields' => [
                'brand_name' => ['label' => 'Name', 'type' => 'text', 'default' => 'Carl Malmsten'],
                'brand_credentials' => ['label' => 'Credentials', 'type' => 'text', 'default' => 'MA RCC RHyp', 'help' => 'Shown smaller after the name.'],
                'brand_tagline' => ['label' => 'Tagline', 'type' => 'text', 'default' => 'Functional and Integrative Psychology'],
                'logo' => ['label' => 'Logo mark', 'type' => 'image', 'default' => 'images/logo.png', 'help' => 'Transparent PNG, ideally about 180px wide.'],
            ],
        ],
        'hero' => [
            'label' => 'Hero',
            'fields' => [
                'hero_title' => ['label' => 'Headline', 'type' => 'textarea', 'default' => "Clarity in yourself.\nStrength in your relationships.", 'help' => 'Each line break becomes a new line on the site.'],
                'hero_text' => ['label' => 'Intro text', 'type' => 'textarea', 'default' => 'Therapy for individuals, couples, and men seeking clarity, connection, and meaningful change.'],
                'hero_quote' => ['label' => 'Italic statement', 'type' => 'textarea', 'default' => "Most of the difficulty people face is not random—\nit follows patterns that can be understood and changed."],
                'hero_cta_label' => ['label' => 'Button label', 'type' => 'text', 'default' => 'Schedule a Consultation'],
                'hero_cta_url' => ['label' => 'Button link', 'type' => 'url', 'default' => '#'],
                'hero_image' => ['label' => 'Hero photograph', 'type' => 'image', 'default' => 'images/hero-carl.jpg', 'help' => 'Photo of Carl shown on the right of the hero. Landscape, around 1600x1100.'],
            ],
        ],
        'about' => [
            'label' => 'About Carl',
            'fields' => [
                'about_title' => ['label' => 'Heading', 'type' => 'text', 'default' => 'Meet Carl Malmsten'],
                'about_subtitle' => ['label' => 'Sub-heading', 'type' => 'textarea', 'default' => 'Focused on clear, structured, and meaningful change.'],
                'about_p1' => ['label' => 'Paragraph 1', 'type' => 'textarea', 'default' => 'With over 29 years of experience, I work with individuals, couples, and men to understand the patterns shaping their lives, relationships, and decisions.'],
                'about_p2' => ['label' => 'Paragraph 2', 'type' => 'textarea', 'default' => 'This work focuses on what is actually happening in real time – not just what is being said – helping clients move from reaction to awareness, and from awareness to intentional change.'],
                'about_image' => ['label' => 'Photograph', 'type' => 'image', 'default' => 'images/meet-carl.jpg', 'help' => 'Landscape photo, around 1200x800.'],
                'about_image_alt' => ['label' => 'Photograph alt text', 'type' => 'text', 'default' => 'Carl Malmsten in session with a couple'],
            ],
        ],
        'quote' => [
            'label' => 'Closing Quote',
            'fields' => [
                'quote_text' => ['label' => 'Quote', 'type' => 'textarea', 'default' => 'Change begins when you can see clearly—and act differently where it matters.'],
                'quote_cta_label' => ['label' => 'Button label', 'type' => 'text', 'default' => 'Begin the Work'],
                'quote_cta_url' => ['label' => 'Button link', 'type' => 'url', 'default' => '#'],
            ],
        ],
        'footer' => [
            'label' => 'Footer',
            'fields' => [
                'footer_text' => ['label' => 'Copyright line', 'type' => 'text', 'default' => '© Carl Malmsten, MA RCC RHyp | Functional Integrative Psychology'],
            ],
        ],
        'design' => [
            'label' => 'Colours',
            'fields' => [
                'color_bg' => ['label' => 'Page background', 'type' => 'color', 'default' => '#2a2b2e'],
                'color_surface' => ['label' => 'Header & services band', 'type' => 'color', 'default' => '#333437'],
                'color_accent' => ['label' => 'Buttons', 'type' => 'color', 'default' => '#46301f'],
                'color_line' => ['label' => 'Divider lines', 'type' => 'color', 'default' => '#8a7f75'],
                'color_heading' => ['label' => 'Headings', 'type' => 'color', 'default' => '#eee7e1'],
                'color_text' => ['label' => 'Body text', 'type' => 'color', 'default' => '#f5f2ee'],
            ],
        ],
        'seo' => [
            'label' => 'SEO',
            'fields' => [
                'meta_title' => ['label' => 'Page title', 'type' => 'text', 'default' => 'Carl Malmsten, MA RCC RHyp | Functional and Integrative Psychology'],
                'meta_description' => ['label' => 'Meta description', 'type' => 'textarea', 'default' => 'Therapy for individuals, couples, and men seeking clarity, connection, and meaningful change.'],
                'favicon' => ['label' => 'Favicon', 'type' => 'image', 'default' => 'favicon.ico'],
            ],
        ],
    ],
];
