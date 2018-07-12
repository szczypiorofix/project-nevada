<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget;
use Core\Registry;

/**
 * This is class for metadata-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class MetaData extends Widget {
    
    private $defaultMetaData = [
        'title' => 'Wróblewski Piotr - homepage',
        'description' => 'I turn pizza and covfefe into spaghetti code ...',
        'author' => 'Wróblewski Piotr',
        'keywords' => 'JavaScript',
        'url' => 'https://wroblewskipiotr.pl/',
        'content' => 'website',
        'twitter-meta-field-left' => '',
        'twitter-meta-field-left-below' => '',
        'twitter-meta-field-right' => '',
        'twitter-meta-field-right-below' => '',
        'image' => 'https://wroblewskipiotr.pl/avatar.png',
        'domain' => 'wroblewskipiotr.pl',
        'accent-color' => '#303F9F',
    ];
    
    public function __construct($data = null) {
        if (is_null($data)) {
            $data = $this->defaultMetaData;
        }
        Registry::add($this, "MetaData");
        $this->body =
<<<HTML
    <meta name="description" content="{$data['description']}" />
    <meta name="author" content="{$data['author']}" />
    <meta name="keywords" content="{$data['keywords']}">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{$data['url']}" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:title" content="{$data['title']}" />
    <meta property="og:site_name" content="{$data['content']}" />
    <meta property="og:description" content="{$data['description']}" />
    <meta property="og:image" content="{$data['image']}" />
    <meta property="fb:app_id" content="1950237781924240" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:domain" content="{$data['domain']}" />
    <meta name="twitter:title" content="{$data['title']}" />
    <meta name="twitter:description" content="{$data['description']}" />
    <meta name="twitter:image" content="{$data['image']}" />
    <meta name="twitter:url" content="{$data['url']}" />
    <meta name="twitter:label1" content="{$data['twitter-meta-field-left']}" />
    <meta name="twitter:data1" content="{$data['twitter-meta-field-left-below']}" />
    <meta name="twitter:label2" content="{$data['twitter-meta-field-right']}" />
    <meta name="twitter:data2" content="{$data['twitter-meta-field-right-below']}" />
    <meta name="twitter:site" content="@szczypiorofix" />
    <meta name="twitter:creator" content="@szczypiorofix" />
    <link href="https://plus.google.com/u/0/117537092421510596426/" rel="publisher" />
    <link rel="Canonical" href="{$data['url']}">
    <meta name="robots" content="index,follow" />
    <link rel="apple-touch-icon" sizes="57x57" href="icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
    <link rel="manifest" href="icons/manifest.json">
    <meta name="msapplication-TileColor" content="{$data['accent-color']}">
    <meta name="msapplication-TileImage" content="icons/ms-icon-144x144.png">
    <meta name="theme-color" content="{$data['accent-color']}">
    <title>{$data['title']}</title>
HTML;
    }

}
