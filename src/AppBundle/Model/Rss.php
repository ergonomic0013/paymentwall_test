<?php

namespace AppBundle\Model;

use Symfony\Component\DomCrawler\Crawler;

class Rss extends Crawler
{
	private $xmlDoc;

	public function __construct($xml)
	{
		$xmlDoc = new \DOMDocument();
		$xmlDoc->load($xml);
		$this->xmlDoc = $xmlDoc;		
	}
	public function getRssFeed()
	{
		$xmlDoc = $this->xmlDoc;
		$ch = $xmlDoc->getElementsByTagName('channel')->item(0);
		$chTitle = $ch->getElementsByTagName('title')
					->item(0)->childNodes->item(0)->nodeValue;
		$chLink = $ch->getElementsByTagName('link')
					->item(0)->childNodes->item(0)->nodeValue;
		$chDesc = $ch->getElementsByTagName('description')
					->item(0)->childNodes->item(0)->nodeValue;
		$rssFeed = Array ($chTitle, $chLink, $chDesc);
		
		return $rssFeed;
	}

	public function getItemsFeed()
	{
		$xmlDoc = $this->xmlDoc;		
		
		$nowDate = date("r");
		$rssItems = Array();

		$x = $xmlDoc->getElementsByTagName('item');
		
		for ($i = 0; $i < 10; $i++) { 
			$itemTitle = $x->item($i)->getElementsByTagName('title')
			->item(0)->childNodes->item(0)->nodeValue;
			$itemLink = $x->item($i)->getElementsByTagName('link')
			->item(0)->childNodes->item(0)->nodeValue;
			$itemDesc = $x->item($i)->getElementsByTagName('description')
			->item(0)->childNodes->item(0)->nodeValue;
			$itemPubDate = $x->item($i)->getElementsByTagName('pubDate')
			->item(0)->childNodes->item(0)->nodeValue;
			$rssItems[$i] = array('title' => $itemTitle, 'link' => $itemLink, 
								  'desc' => $itemDesc, 'pubDate' => $itemPubDate);
		}

		return $rssItems;
	}
}
?>