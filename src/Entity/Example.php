<?php

namespace Drupal\click_admin_menu\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\click_admin_menu\ExampleInterface;

/**
 * Defines the Example entity.
 *
 * @ConfigEntityType(
 *   id = "example",
 *   label = @Translation("Example"),
 *   handlers = {
 *     "list_builder" = "Drupal\click_admin_menu\Controller\ExampleListBuilder",
 *     "form" = {
 *       "add" = "Drupal\click_admin_menu\Form\ExampleForm",
 *       "edit" = "Drupal\click_admin_menu\Form\ExampleForm",
 *       "delete" = "Drupal\click_admin_menu\Form\ExampleDeleteForm",
 *     }
 *   },
 *   config_prefix = "example",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/example/{example}",
 *     "delete-form" = "/admin/config/system/example/{example}/delete",
 *   }
 * )
 */
class Example extends ConfigEntityBase implements ExampleInterface {

    /**
     * The Example ID.
     *
     * @var string
     */
    public $id;

    /**
     * The Example label.
     *
     * @var string
     */
    public $label;

    // Your specific configuration property get/set methods go here,
    // implementing the interface.
    
    /**
     * The example link.
     * 
     * @var string 
     */
    public $link;
    
    /**
     * The example weight.
     * 
     * @var string 
     */
    public $weight;
}
