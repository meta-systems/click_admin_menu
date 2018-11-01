<?php

namespace Drupal\click_admin_menu\Controller;

use Drupal\click_admin_menu\Entity\Example;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides route responses for the Example module.
 */
class ClickAdminMenuController extends ControllerBase
{
    public function clearCache(Request $request)
    {
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

    protected function getReferer(Request $request)
    {
        // Получаем урл реферера
        $referer = $request->headers->get('referer');
        if(!$referer) {
            return false;
        }
        $url = parse_url($referer);
        if($url === false) {
            return false;
        }
        return $url['path'] . (array_key_exists('query', $url) ? "?{$url['query']}" : '');
    }

    public function addPage(Request $request)
    {
        $referer = $this->getReferer($request);
        if(!$referer) {
            return $this->redirect('<front>');
        }

        $label = $request->get('title');
        if(empty($label)) {
            $label = $referer;
        }
        $entity = Example::create([
            'id' => 'auto_'.time(),
            'link' => $referer,
            'label' => $label,
        ]);
        $entity->save();

        // Выполняем редирект
        return new RedirectResponse($referer);
    }
}
