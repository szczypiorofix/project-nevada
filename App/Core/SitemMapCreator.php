<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 * 
 */

namespace Core;

/**
 * Description of SitemMapCreator
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class SitemMapCreator {
    
    private $siteMapUrl = '';
    private $siteMap = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

        <url>
            <loc>https://www.wroblewskipiotr.pl/</loc>
            <lastmod>2018-02-18T22:53:01+00:00</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>

        <url>
            <loc>https://www.wroblewskipiotr.pl/weatherforecast/</loc>
            <lastmod>2018-02-18T22:56:36+00:00</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>

    </urlset>';
    
    private function __construct() {}
    
    public static function makeXML($db) {
        
        $doc = new \DOMDocument('1.0');
        $doc->formatOutput = true;

        $root = $doc->createElement('urlset');
        $root = $doc->appendChild($root);

        $title = $doc->createElement('title');
        $title = $root->appendChild($title);

        $text = $doc->createTextNode('This is the title');
        $text = $title->appendChild($text);

        $doc->save("sitemap.xml");


    }
}
