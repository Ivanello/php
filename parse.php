<?php

$file = "file.csv";
// $url = "http://www.stackoverflow.com/";

//parsing csv file
$expected = array_map('str_getcsv', file('file.csv'));
$url = $expected[1][0];

function file_get_contents_curl($url)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIE, "test=seo");//for cookie

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	};

$html = file_get_contents_curl($url);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
$description = "";
for ($i = 0; $i < $metas->length; $i++)
	{
		$meta = $metas->item($i);
		if($meta->getAttribute('name') == 'description')
			$description = $meta->getAttribute('content');
	}

// system('clear');
echo "URL: $url\r\n";
echo "Title: $title\r\n";
echo "Description: $description \r\n\r\n";

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
assert_options(ASSERT_CALLBACK, 'my_assert_handler');

function my_assert_handler($file, $line, $code, $desc = null)
	{
    	echo " ! Assertion failed: ";
		if ($desc) {
        	echo "$desc";
		}
		echo "\n";
	}

assert ($expected[1][1]==$title,"Expected ".$expected[0][1]." is: '".$expected[1][1]."' and actual is: '" . $title."'.\r\n");
assert ($expected[1][2]==$description,"Expected ".$expected[0][2]." is: '".$expected[1][2]."' and actual is: '".$description."'.\r\n");
?>