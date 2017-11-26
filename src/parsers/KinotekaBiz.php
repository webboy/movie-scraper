<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 11/25/2017
 * Time: 9:25 PM
 */

namespace Webboy\MovieScraper\Parsers;


use Symfony\Component\DomCrawler\Crawler;
use Webboy\MovieScraper\Parser;
use Webboy\MovieScraper\Utils;

class KinotekaBiz extends Parser
{
    public $domain = 'www.kinoteka.biz';

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function get_title()
    {
        $this->data['title'] = trim(Utils::remove_year($this->crawler->filter('h1')->text()));
    }

    public function get_year()
    {
        $this->data['year'] = trim(Utils::string_between('(',')',$this->crawler->filter('h1')->text()));
    }

    public function get_poster()
    {
        $this->data['poster'] = 'http://'.$this->domain.$this->crawler->filter('#movie-poster')->filter('img')->attr('src');
    }

    public function get_synopsis()
    {
        $this->data['synopsis'] = trim(str_replace('Opis: ','',$this->crawler->filter('#movie-details')->filter('.description')->text()));
    }

    public function get_genres()
    {
        $crawler = $this->crawler->filter('#movie-info')->filter('.list-inline');
        $crawler->filter('a')->each(function (Crawler $node){
           $this->data['genres'][] = $node->text();
        });
    }

    public function get_rating()
    {
        $this->data['rating'] = $this->crawler->filter('#movie-info')->filter('.pull-right')->filter('[itemprop="ratingValue"]')->text();
    }

    public function get_actors()
    {
        $this->data['actors'] = explode(',',trim($this->crawler->filter('#movie-details')->filter('[itemprop="actor"]')->filter('[itemprop="name"]')->text()));
    }

    public function get_directors()
    {
        $this->data['directors'] = explode(',',trim($this->crawler->filter('#movie-details')->filter('[itemprop="director"]')->filter('[itemprop="name"]')->text()));
    }

    public function get_writers()
    {
        $this->data['writers'] = explode(',',trim(str_replace('Pisci:','',$this->crawler->filter('#movie-details')->filter('.Writer')->text())));
    }
}