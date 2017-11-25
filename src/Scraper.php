<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 11/25/2017
 * Time: 7:43 PM
 */

namespace Webboy\MovieScraper;


class Scraper
{
    /**
     * @var array
     */
    public $movie_data = [];

    public function __construct($url)
    {
        $url_data = parse_url($url);

    }
}