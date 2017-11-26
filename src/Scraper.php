<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 11/25/2017
 * Time: 7:43 PM
 */

namespace Webboy\MovieScraper;


use Goutte\Client;
use Webboy\MovieScraper\Parsers\KinotekaBiz;
use Webboy\MovieScraper\Parsers\PopcornRs;

class Scraper
{

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var array
     */
    protected $url_data = [];

    /**
     * @var array
     */
    public $movie_data = [];

    /**
     * @return bool|array
     */
    public function scrap($url)
    {

        $this->url = $url;
        $this->url_data = parse_url($url);

        if (!filter_var($this->url,FILTER_VALIDATE_URL))
        {
            return false;
        }

        $parser = null;

        $goutte = new Client();
        $guzzle = new \GuzzleHttp\Client(['verify'=>false]);

        $goutte->setClient($guzzle);

        //Determine scraper
        switch ($this->url_data['host']){
            case 'www.kinoteka.biz':
                $data = new KinotekaBiz($goutte->request('GET',$this->url));
                return $data->parse();
                break;
            case 'www.popcorn.rs':
                $data = new PopcornRs($goutte->request('GET',$this->url));
                return $data->parse();
                break;
            default:
                return $this->movie_data;
                break;
        }
    }
}