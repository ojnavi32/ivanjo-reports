<?php
namespace Drupal\form_test\scripts;

use Drupal\node\Entity\Node;

$getfile = file_get_contents('text.txt');

$str = explode('-- new article --', $pizza);
$j = 0;
while ($j < 3) {

$aa = preg_split('/[\r\n]+/', $str[$j]);

$new = null;

foreach( $aa as $a){
    if( $a == "" ) continue;
    $new[] = $a;
} //foreach loop

        $number =  $new[0].'<br />'; // Number
        $title = $new[1].'<br />'; // Title
        $content =  $new[2].'<br />'; // Content
        $date =  $new[3].'<br />'; // Date
        $url = $new[4].'<br />';  //url

    $p = [];
    $p['type'] = 'article';
    $p['title'] = "($number) $title: <br /> $date";

    $node = Node::create( $p );
    $node->save();

    $file = file_save_data(file_get_contents("$url"));
    \Drupal::service('file.usage')->add($file, 'editor', 'node', $node->id());

    $src = $file->url();
    $src = str_replace('http://default', 'http://localhost/drupal-8', $src);
    $uuid = $file->uuid();
    $img = "<img src='$src' data-entity-type='file' data-entity-uuid='$uuid'>";

    $node->body->format = 'full_html';
    $node->body->value = '<h1>$content</h1>' . $img;

    $node->save();    

$j++;   
} //while loop
/*
$count_new = 0;

for( $i = 0; $i < 3 ; $i ++ ) {
    $n = getNode();
    $node = Node::create($n);
    $node->save();

    $file = file_save_data(file_get_contents("C:\Users\Teacher\Downloads"));
    \Drupal::service('file.usage')->add($file, 'editor', 'node', $node->id());

    $src = $file->url();
    $src = str_replace('http://default', 'http://localhost/drupal-8', $src);
    $uuid = $file->uuid();
    $img = "<img src='$src' data-entity-type='file' data-entity-uuid='$uuid'>";

    $node->body->format = 'full_html';
    $node->body->value = '<h1>Hello</h1>' . $img;

    $node->save();
}



function getNode()
{
    global $count_new;
    $count_new ++;
    $p = [];
    $p['type'] = 'forum';
    $p['title'] = "($count_new) This is subject: " . date("Y-m-d H:i:s");
    return $p;
}
*/