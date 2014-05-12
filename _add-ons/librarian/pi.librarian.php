<?php
class Plugin_librarian extends Plugin {
	
	var $meta = array(
		'name' => 'Librarian',
		'description' => 'A Statamic plugin to retrieve book information from Open Library',
		'version' => '1.0',
		'author' => 'Jeremy Sexton',
		'author_url' => 'http://jeremysexton.net',
		'author_twitter' => '@jeremysexton'
	);
	
	public function index() {
	
		$api_start = "https://openlibrary.org/api/books?bibkeys=";
		$api_end = "&format=json&jscmd=data";
			
		$isbn = $this->fetchParam('isbn', null);
		$oclc = $this->fetchParam('oclc', null);
		$lccn = $this->fetchParam('lccn', null);
		$olid = $this->fetchParam('olid', null);
		
		$amazon_affiliate = $this->config["amazon_affiliate"];
		
		if ($isbn) {
			$numtype = "ISBN:".$isbn;
		} elseif ($oclc) {
			$numtype = "OCLC:".$oclc;
		} elseif ($lccn) {
			$numtype = "LCCN:".$lccn;
		} elseif ($olid) {
			$numtype = "OLID:".$olid;
		} else {
			return "";
		}

		$url = $api_start.$numtype.$api_end;

		// All the informations
		$data = file_get_contents($url);
		$data = json_decode($data, TRUE);
		
		// Dump Creation
		ob_start();
		var_dump($data);
		$dump = ob_get_contents();
		ob_end_clean();
		
		// Grabbing Sub-arrays
		$book_info = $data[$numtype];
		
		// Building our results array
		$the_goods = array(
			'dump' => $dump,
			
			'cover' => $book_info['cover']['large'],
			'title' => $book_info['title'],
			'subtitle' => $book_info['subtitle'],
			
			'author' => $book_info['authors'][0]['name'],
			'author 2' => $book_info['authors'][1]['name'],
			'author 3' => $book_info['authors'][2]['name'],			
		);
		
		if ($amazon_affiliate) {
			$amazon_link = 'http://amazon.com/gp/product/'.$book_info['identifiers']['isbn_10'][0].'?&tag='.$amazon_affiliate;
		} else {
			$amazon_link = 'http://amazon.com/gp/product/'.$book_info['identifiers']['isbn_10'][0];
		}
		
		$links = array(
			'amazon' => $amazon_link,
			'goodreads' => 'http://goodreads.com/book/show/'.$book_info['identifiers']['goodreads'][0],
			'openlibrary' => 'http://openlibrary.org/books/'.$book_info['identifiers']['openlibrary'][0],
		);
		
		return array_merge($the_goods, $links);
	
	}
	
}