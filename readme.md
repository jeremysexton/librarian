#Librarian

A Statamic add-on to pull in book information from [Open Library](http://openlibrary.org).

##About

You want books, we got books. Librarian will go to Open Library and tell you everything you want to know about your books. Just feed it the ISBN, OCLC, LCCN, or OLID for the book in question and bask in the glow of all the information coming at your eyeballs.

##Support, etc

Troll me on the tweets at [@jeremysexton](http://twitter.com/jeremysexton) or shoot me an email jeremy(at)jeremysexton.net.

If there's something the Open Library API produces that isn't included in this plugin and you'd like it to be, just let me know!

If this plugin changed your life and you insist on buying me a beer, [I'm not going to stop you](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LTC6XY9F7RTJ2).

##Example

```
{{ librarian isbn="1476730407" }}

	<h1>{{ title }}</h1>
	<h2>{{ subtitle }}</h2>
	<h3>{{ author }}</h3>
	
	<img src="{{ cover }}"/>
	
	<ul>
		<li><a href="{{ amazon }}">Amazon Link</a></li>
		<li><a href="{{ goodreads }}">Goodreads Link</a></li>
		<li><a href="{{ openlibrary }}">Open Library Link</a></li>
	</ul>

{{ /librarian }}
```

##Documentation

###Config

*Get that paper, dawg*

* **amazon_affiliate** - Your Amazon Affiliate tag. If it's set, you will automatically get affiliate links instead of regular, old, no-money-making links.

###Parameters

*Yo, which book? Only one of these are necessary.*

* **isbn** - ISBN-10 or ISBN-13, doesn't matter
* **oclc** - The OCLC number. I don't even know what this number is, but if you do, then go ahead and use it.
* **lccn** - The LCCN number. This identifies books somehow, I imagine.
* **olid** - The OLID number. This is the identifier for Open Library.

### Variables

*So, what info exactly?*

* **cover** - Raw URL for the large cover of the book. If you want a smaller image, I recommend the {{ transform }} tag.
* **title**
* **subtitle**
* **author** - Open Library breaks authors up into an array, so this will be the first author if there are many.
* **author_2** - If there are 2 authors, this will grab the name of the second.
* **author_3** - Obvi…
* **amazon** - Amazon link to the book. An affiliate link, if you set your tag in the config folder.
* **goodreads** - Goodreads link to the book.
* **openlibrary** - Open Library link for the book.
* **dump** - Spits out the raw, dirty array information.