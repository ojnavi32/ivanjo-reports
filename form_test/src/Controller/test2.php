<?php
namespace Drupal\form_test\Controller;

use Drupal\node\Entity\Node;

class test2
{
	public function ShowPage()
	{
        $markup = [
            '#theme' => 'test1', // theme name that will be matched in *.module
            '#title' => 'Welcome',
            '#form' => $form,
        ];

        return $markup;		
	}

	public function nodes()
	{
		$test = \Drupal::entityManager()->getStorage('node')->loadByProperties( array('type'=>'article') );

		foreach ($test as $r) {
			print $r->title;
		}
	}
}