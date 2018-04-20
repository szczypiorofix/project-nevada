<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 * 
 */

namespace Core;

use Core\FrameworkException;

/**
 * Description of SitemMapXML
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class SitemMapXML {
    
    const GET_URLS = "SELECT `url`, `update_date` FROM `posts`";
    static private $error = true;
    static private $errorMsg = '';
    
    private function __construct() {}
    
    public static function create($dbConnection) {
        
        try {
           $query = $dbConnection['db']->prepare(self::GET_URLS);
           $query->execute();
        }
        catch (FrameworkException $exc) {
           self::$error = true;
           self::$errorMsg = $exc->getMessage();
        }
        if ($query->rowCount() > 0) {
           self::$error = false;
        }
        
        $results = $query->fetchAll();
        
        //var_dump($results);
        
        $doc = new \DOMDocument('1.0');
        $doc->formatOutput = true;

        $urlset = $doc->createElement('urlset');
        
        $xmlnsAttr = $doc->createAttribute("xmlns");
        $xmlnsAttr->value = "http://www.sitemaps.org/schemas/sitemap/0.9";
        $urlset->appendChild($xmlnsAttr);
        
        $xmlnsXsiAttr = $doc->createAttribute("xmlns:xsi");
        $xmlnsXsiAttr->value = "http://www.w3.org/2001/XMLSchema-instance";
        $urlset->appendChild($xmlnsXsiAttr);
        
        $xsiSchemaLocationAttr = $doc->createAttribute("xsi:schemaLocation");
        $xsiSchemaLocationAttr->value = "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd";
        $urlset->appendChild($xsiSchemaLocationAttr);
        
        $urlset = $doc->appendChild($urlset);

        // FIRST: MAIN PAGE
        $url = $doc->createElement('url');
        $url = $urlset->appendChild($url);

        $loc = $doc->createElement("loc");
        $loc = $url->appendChild($loc);
        $urlText = $doc->createTextNode(BASE_HREF);
        $urlText = $loc->appendChild($urlText);

        $lastmod = $doc->createElement("lastmod");
        $lastmod = $url->appendChild($lastmod);
        $lastmodText = $doc->createTextNode(date("Y-m-d H:m:s"));
        $lastmodText = $lastmod->appendChild($lastmodText);

        $changefreq = $doc->createElement("changefreq");
        $changefreq = $url->appendChild($changefreq);
        $changefreqText = $doc->createTextNode("weekly");
        $changefreqText = $changefreq->appendChild($changefreqText);

        $priority = $doc->createElement("priority");
        $priority = $url->appendChild($priority);
        $priorityText = $doc->createTextNode("1.0");
        $priorityText = $priority->appendChild($priorityText);
        
        // 2ND: POST PAGES
        for ($i = 0; $i < count($results); $i++) {
            $url = $doc->createElement('url');
            $url = $urlset->appendChild($url);
            
            $loc = $doc->createElement("loc");
            $loc = $url->appendChild($loc);
            $urlText = $doc->createTextNode(BASE_HREF.$results[$i]['url']);
            $urlText = $loc->appendChild($urlText);

            $lastmod = $doc->createElement("lastmod");
            $lastmod = $url->appendChild($lastmod);
            $lastmodText = $doc->createTextNode($results[$i]['update_date']);
            $lastmodText = $lastmod->appendChild($lastmodText);
            
            $changefreq = $doc->createElement("changefreq");
            $changefreq = $url->appendChild($changefreq);
            $changefreqText = $doc->createTextNode("montly");
            $changefreqText = $changefreq->appendChild($changefreqText);
            
            $priority = $doc->createElement("priority");
            $priority = $url->appendChild($priority);
            $priorityText = $doc->createTextNode("0.8");
            $priorityText = $priority->appendChild($priorityText);
        }
        
        $doc->save("sitemap.xml");

    }
}
