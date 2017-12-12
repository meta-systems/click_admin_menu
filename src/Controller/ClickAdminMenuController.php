<?php

namespace Drupal\click_admin_menu\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides route responses for the Example module.
 */
class ClickAdminMenuController extends ControllerBase {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
	
	
  public function clearCache(Request $request) {
    // Получаем урл реферера.
    $referer = $request->headers->get('referer');
    dpm($referer);
	// Чистим кеш.
    drupal_flush_all_caches();
    // Выводим при необходимости сообщение.
    drupal_set_message($this->t('кеш очищен'));
    // Выполняем редирект.
    return $referer ? new RedirectResponse($referer) : $this->redirect('<front>');
  }
	
	/*
	public function myPage() {

		drupal_flush_all_caches(); // срабатывает только один раз

		if(isset($_SERVER['HTTP_REFERER'])){
			
			header('Location: '.$_SERVER['HTTP_REFERER']); // срабатывает только один раз
			
			$element = array(
				'#markup' => ' HTTP  '.$_SERVER['HTTP_REFERER'],
			);
			
		} else {

			$element = array(
			  '#markup' => ' нету referera ',
			);
		}
		return $element;
	}
	*/
}
