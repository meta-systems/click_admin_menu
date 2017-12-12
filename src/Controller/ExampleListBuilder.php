<?php

namespace Drupal\click_admin_menu\Controller;

use Drupal\Core\Config\Entity\DraggableListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Example.
 */
class ExampleListBuilder extends DraggableListBuilder {

    protected $weightKey = 'weight';
    
    public function getFormId() {
        return 'click_admin_menu_drag_form';
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildHeader() {
        $header['label'] = $this->t('Label');
        //$header['link'] = $this->t('Link');
        //$header['id'] = $this->t('Machine name');    
        return $header + parent::buildHeader();
    }

    /**
     * {@inheritdoc}
     */
    public function buildRow(EntityInterface $entity) {
        $row['label'] = $this->getLabel($entity);
        /*
        $row['link'] = [
            '#type' => '',
            '#title' => $entity->link,
        ];*/
        //$row['id'] = $entity->id();
        return $row + parent::buildRow($entity);
    }

}
