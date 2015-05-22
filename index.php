<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
//error_reporting(0);

require_once('lib/glue.php');
require_once('lib/Savant3-3.0.1/Savant3.php');
require_once('secrets.php');

$urls = array(
    '/$'                        => 'index',
    '/feed/(?P<feed>.*)$'       => 'feed',
);

class index {
    function GET() {

        $tpl = new Savant3();

        $tpl->hn_front  = json_decode(file_get_contents(dirname(__FILE__).'/cache/hn-front.json'));
        $tpl->hn_ask    = json_decode(file_get_contents(dirname(__FILE__).'/cache/hn-ask.json'));
        $tpl->hn_show   = json_decode(file_get_contents(dirname(__FILE__).'/cache/hn-show.json'));
        $tpl->dn_front  = json_decode(file_get_contents(dirname(__FILE__).'/cache/dn-front.json'));
        $tpl->lobsters  = json_decode(file_get_contents(dirname(__FILE__).'/cache/lobsters.json'));

        $tpl->display('view/index.tpl.php');

    }
}

class feed {
    function GET($matches) {


        $feeds = array(
            'hn-front'  => 'https://news.ycombinator.com/rss',
            'hn-ask'    => 'http://hnrss.org/ask',
            'hn-show'   => 'http://hnrss.org/show',
            'lobsters'  => 'https://lobste.rs/rss',
            'dn-front'  => 'https://news.layervault.com/?format=rss',
            'dribbble'  => 'https://dribbble.com/shots/popular.rss'
        );

        $updated = array();

        foreach($feeds as $name => $url) {

            $cache_file = dirname(__FILE__).'/cache/'.$name.'.json';
            $modified = filemtime($cache_file);
            $now = time();
            $interval = 300; // five minutes

            if ( !$modified || ( ( $now - $modified ) > $interval ) ) {

                $updated[] = $name;  

                $context = stream_context_create(array(
                    'http' => array(
                        'method'=>'GET'
                    )
                ));

                $raw = file_get_contents($url, false, $context);
                $rss = simplexml_load_string($raw);
                $json = json_encode(new SimpleXMLElement($rss->asXML(), LIBXML_NOCDATA), JSON_PRETTY_PRINT);

                if ( $json ) {
                    $cache_static = fopen( $cache_file, 'w' );
                    fwrite( $cache_static, $json );
                    fclose( $cache_static );
                }

            }

        }

        if(array_key_exists($matches['feed'],$feeds)) {

            $output = file_get_contents(dirname(__FILE__).'/cache/'.$matches['feed'].'.json');
            header( 'Cache-Control: no-cache, must-revalidate' );
            header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
            header( 'Content-type: application/json' );
            echo $output;

        }

    }

}

try {
    glue::stick($urls);
}
catch(UnexpectedValueException $e) {
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: http://news.http410.com');
}
catch(InvalidArgumentException $e) {
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: http://news.http410.com');
}
