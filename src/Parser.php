<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 11/25/2017
 * Time: 9:27 PM
 */

namespace Webboy\MovieScraper;


use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    /**
     * @var Crawler;
     */
    public $crawler;

    /**
     * @var array
     */
    public $data = [];

    function get_title()
    {
        $this->data['title'] = '';
    }

    function get_year()
    {
        $this->data['year'] = '';
    }

    function get_synopsis()
    {
        $this->data['synopsis'] = '';
    }

    function get_poster()
    {
        $this->data['poster'] = '';
    }

    function get_date_released()
    {
        $this->data['date_released'] = '';
    }

    function get_directors()
    {
        $this->data['directors'] = [];
    }

    function get_writers()
    {
        $this->data['writers'] = [];
    }

    function get_actors()
    {
        $this->data['actors'] = [];
    }

    function get_rating()
    {
        $this->data['rating'] = '';
    }

    function get_genres()
    {
        $this->data['genres'] =[];
    }

    function get_openload_url()
    {
        $this->data['openload_url'] = $this->crawler->filter('iframe')->attr('src');
    }


    /**
     * @return array
     */
    function parse()
    {
        try {
            $this->get_title();
            $this->get_date_released();
            $this->get_year();
            $this->get_poster();
            $this->get_synopsis();
            $this->get_directors();
            $this->get_writers();
            $this->get_actors();
            $this->get_rating();
            $this->get_genres();
            $this->get_openload_url();

            return $this->data;
        } catch (\InvalidArgumentException $e)
        {
            return $this->data;
        }


    }
}