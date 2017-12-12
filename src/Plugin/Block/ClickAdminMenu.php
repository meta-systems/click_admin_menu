<?php
/**
 * @file
 * Contains \Drupal\click_admin_menu\Plugin\Block\YourBlockName.
 */ 
namespace Drupal\click_admin_menu\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\click_admin_menu\Entity\Example;

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
        
        $renderable = [
            '#theme' => 'click_admin_menu',
            '#items' => $configEntities,
            '#title' => $config->get('click_admin_menu.page_title'),
            '#target' => $config->get('click_admin_menu.link_target'),
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
