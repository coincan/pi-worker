<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: duan.li
 * Date: 14/1/19
 * Time: 4:05 PM
 */

namespace App\Services\ProductPrice\Dirvers;

use Agilekeys\Priceline\Abstracts\Driver;
use Agilekeys\Priceline\Crawlers\Html as HtmlCrawler;
use Agilekeys\Priceline\Interfaces\Driver as DriverInterface;

class ColesHtml extends Driver implements DriverInterface
{
    /** @var string $crawlerClass */
    protected $crawlerClass = HtmlCrawler::class;

    /**
     * @return string
     */
    public function filterName(): string
    {
        return $this->crawler->filter('span.product-name')->text();
    }

    /**
     * @return string
     */
    public function filterPrice(): string
    {
        return $this->crawler->filter('strong.product-price')->text();
    }
}
