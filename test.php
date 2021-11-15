<?php

class whatever
{
    public function thing(string $url)
    {
        echo $this->get_image($url);
    }

    private function get_image(string $url = null): string
    {
        if (preg_match("/amazon.com|newegg.com|target.com|gamestop.com/", $url) === 1) {
            $string = file_get_contents($url);
            if (preg_match('/"landingImageUrl":"(.*)"/', $string, $matches) > 0) {
                return $matches[1] . "\n";
            } elseif (preg_match('/class="product-view-img-original" src="(.*?)"/', $string, $matches) > 0) {
                return $matches[1] . "\n";
            } elseif (preg_match('/"primary_image_url":"(.*?)"/', $string, $matches) > 0) {
                return $matches[1] . "\n";
            } elseif (preg_match('/property="og:image" content="(.*?)"/', $string, $matches) > 0) {
                return $matches[1] . "\n";
            } else {
                var_dump($string);
            }
        } else {
            return "";
        }
    }
}

$a = new whatever();
$a->thing("https://www.amazon.com/Sony-WH-1000XM4-Canceling-Headphones-phone-call/dp/B0863FR3S9/ref=lp_23598778011_1_2?dchild=1&th=1"); // Amazon
$a->thing("https://www.newegg.com/amd-ryzen-5-5600g-ryzen-5-5000-g-series/p/N82E16819113683"); // Newegg
$a->thing("https://www.target.com/p/ocean-spray-fresh-cranberries-12oz-bag/-/A-47098229#lnk=sametab"); // Target
$a->thing("https://www.gamestop.com/electronics/cell-phones/cell-phones/products/iphone-11-pro-max-64gb---unlocked/208637.html"); //gamestop
