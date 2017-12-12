<?php

namespace Drupal\click_admin_menu\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the Example add and edit forms.
 */
class ExampleForm extends EntityForm {

    /**
     * Constructs an ExampleForm object.
     *
     * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
     *   The entity query.
     */
    public function __construct(QueryFactory $entity_query) {
        $this->entityQuery = $entity_query;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
                $container->get('entity.query')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state) {
        $form = parent::form($form, $form_state);

        $example = $this->entity;

        $form['label'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#maxlength' => 255,
            '#default_value' => $example->label(),
            '#description' => $this->t("Label for the admin menu item."),
            '#required' => TRUE,
        );
        $form['id'] = array(
            '#type' => 'machine_name',
            '#default_value' => $example->id(),
            '#machine_name' => array(
                'exists' => array($this, 'exist'),
            ),
            '#disabled' => !$example->isNew(),
        );
        $form['link'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Link'),
            '#maxlength' => 255,
            '#default_value' => $example->link,
            '#description' => $this->t("Link for the admin menu item."),
            '#required' => TRUE,
        );

        // You will need additional form elements for your custom properties.
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $example = $this->entity;
        $status = $example->save();

        if ($status) {
            drupal_set_message($this->t('Saved the %label Example.', array(
                        '%label' => $example->label(),
            )));
        } else {
            drupal_set_message($this->t('The %label Example was not saved.', array(
                        '%label' => $example->label(),
            )));
        }

        $form_state->setRedirect('entity.example.collection');
    }

    /**
     * Helper function to check whether an Example configuration entity exists.
     */
    public function exist($id) {
        $entity = $this->entityQuery->get('example')
                ->condition('id', $id)
                ->execute();
        return (bool) $entity;
    }

}
