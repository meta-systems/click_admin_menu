<?php
/**
 * @file
 * Contains \Drupal\click_admin_menu\Plugin\Block\YourBlockName.
 */ 
namespace Drupal\click_admin_menu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\click_admin_menu\Entity\Example;
use Drupal\Core\TempStore\PrivateTempStore;

/**
 * Provides my custom block.
 *
 * @Block(
 *   id = "clickmenu",
 *   admin_label = @Translation("click admin menu"),
 *   category = @Translation("Blocks")
 * )
 */
class ClickAdminMenu extends BlockBase {
  
   /**
   * {@inheritdoc}
   */
	public function build() {
        
        $configEntities = Example::loadMultiple();
        uasort($configEntities, [Example::class, 'sort']);
        
        $config = \Drupal::config('click_admin_menu.settings');

        $shortcutLinks = [];
        $moduleHandler = \Drupal::service('module_handler');
        if ($moduleHandler->moduleExists('shortcut')) {
            $shortcutArray = shortcut_renderable_links();
            if(array_key_exists('#links', $shortcutArray)) {
                $shortcutLinks = $shortcutArray['#links'];
            }
        }

        /** @var PrivateTempStore $tempstore */
        $tempstore = \Drupal::service('user.private_tempstore')->get('click_admin_menu');
        $last_added = $tempstore->get('last_added');
        if($last_added) {
            $tempstore->delete('last_added');
        }

        $renderable = [
            '#theme' => 'click_admin_menu',
            '#items' => $configEntities,
            '#shortcuts' => $shortcutLinks,
            '#title' => $config->get('click_admin_menu.page_title'),
            '#target' => $config->get('click_admin_menu.link_target'),
            '#last_added' => $last_added,
        ];
        $renderable['#cache'] = [
            'max-age' => 0,
        ];
        $rendered = drupal_render($renderable);
    
		return [
			'#attached' => [
				'library' => [
                    'click_admin_menu/click_admin_menu'
				],
			],
            '#type' => 'markup',
            '#markup' => $rendered,
		];
	}
	
}
