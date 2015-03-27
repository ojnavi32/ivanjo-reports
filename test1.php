<?php
namespace Drupal\form_test\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Query;
//use Guzzle\Http\Client;
use Drupal\node\Entity\Node;



class test1 extends ControllerBase {
    public function ShowPage() {

        $form = \Drupal::formBuilder()->getForm( new Form() );
    
        $markup = [
            '#theme' => 'test1', // theme name that will be matched in *.module
            '#title' => 'Click IMPORT',
            '#form' => $form,
        ];

        return $markup;
    }
}

class Form extends FormBase {

    public function getFormId()
    {
        return 'form4';
    }

    public function buildForm( array $form, FormStateInterface $form_state ) {
        $form['email'] = [
            '#type' => 'hidden',
            '#title' => $this->t( 'Input Title' ),
            '#default_value' => \Drupal::state()->get('third.email'),
        ];

        $form['content'] = [
            '#type' => 'hidden',
            '#title' => $this->t( 'Input Content' ),
            '#default_value' => \Drupal::state()->get('third.content'),
        ];

        $form['image'] = [
            '#type' => 'hidden',
            '#title' => $this->t( 'Input Image' ),
            '#default_value' => \Drupal::state()->get('third.image'),
        ];        

        $form['action']['submit'] = [
            '#type' => 'submit',
            '#value' => 'IMPORT',
            '#prefix' => '<div class="submit-button">',
            '#suffix' => '</div>',
        ];

        return $form;
    }

    public function submitForm( array &$form, FormStateInterface $form_state ) {
/*
    $getfile = file_get_contents("C:/wamp/www/work/modules/form_test/src/Controller/text1.txt");

        $str = explode('-- new article --', $getfile);
        $j = 0;
        while ($j < 3) {

        $aa = preg_split('/[\r\n]+/', $str[$j]);

        $new = null;

        foreach( $aa as $a){
            if( $a == "" ) continue;
            $new[] = $a;
        } //foreach loop

                $number =  'Hello there'; // Number
                $title = $new[1]; // Title
                $content =  $new[2]; // Content
                $date =  $new[3]; // Date
                $url = $new[4];  //url
            $p = [];
            $p['type'] = 'article';
            $p['title'] = ''.$title;

            $node = Node::create( $p );
            $node->save();

    $file = file_save_data(file_get_contents($url));
    \Drupal::service('file.usage')->add($file, 'editor', 'node', $node->id());

        $src = $file->url();
        $src = str_replace('http://default', 'http://localhost/work', $src);
        $uuid = $file->uuid();
        $img = "<img src='$src' data-entity-type='file' data-entity-uuid='$uuid'>";

            $node->body->format = 'full_html';
            $node->body->value = '<h1>'.$content.'</h1><br/>Date: '.$date.'<br />'.$img; 

            $node->save();
            $j++;
        }
*/

for ($id=4; $id <= 7; $id++) {

$db = db_select('port_data', 'port_data')
    ->fields('port_data', array('data'))
    ->condition('idx', $id)
    ->execute();

    while ($r = $db->fetchAssoc()) {
        $getfile = unserialize($r['data']);
//$getfile = file_get_contents("C:/wamp/www/work/modules/form_test/src/Controller/text1.txt");

            $p = [];
            $p['type'] = 'article';
            $p['title'] = ''.$getfile['post']['subject'];

            $node = Node::create( $p );
            $node->save();
/*
    $file = file_save_data(file_get_contents( $getfile['post']['site_extract'] ));
    \Drupal::service('file.usage')->add($file, 'editor', 'node', $node->id());

        $src = $file->url();
        $src = str_replace('http://default', 'http://localhost/work', $src);
        $uuid = $file->uuid();
*/
            $node->body->format = 'full_html';
            $node->body->value = '<h1>'.$getfile['content'].'</h1><br />'.$getfile['post']['site_extract']; 

            $node->save();

           } //while loop
        } //for loop
    } // public function submit
} // class test1