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
        /**
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><urlset></urlset>");

        for ($i = 1; $i <= 8; ++$i) {
            $track = $xml->addChild('url');
            $track->addChild('loc', "url #$i");
            $track->addChild('lastmod', date('l jS F Y h:i:s A'));
            $track->addChild('changefreq', "weekly");
            $track->addChild('priority', "0.8");
        }
        */
        
        $domtree = new \DOMDocument('1.0', 'UTF-8');

        /* create the root element of the xml tree */
        $xmlRoot = $domtree->createElement("xml");
        /* append it to the document created */
        $xmlRoot = $domtree->appendChild($xmlRoot);

        $currentTrack = $domtree->createElement("track");
        $currentTrack = $xmlRoot->appendChild($currentTrack);

        /* you should enclose the following two lines in a cicle */
        $currentTrack->appendChild($domtree->createElement('path','song1.mp3'));
        $currentTrack->appendChild($domtree->createElement('title','title of song1.mp3'));

        $currentTrack->appendChild($domtree->createElement('path','song2.mp3'));
        $currentTrack->appendChild($domtree->createElement('title','title of song2.mp3'));

        /* get the xml printed */
        echo $domtree->saveXML();
        $domtree->save(BASE_HREF.'/xml/xmlfile.xml');

//        Header('Content-type: text/xml');
//        print($xml->asXML());
//        exit();
    }
}
