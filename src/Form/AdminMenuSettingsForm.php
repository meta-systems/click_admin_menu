<?php

namespace Drupal\click_admin_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description of AdminMenuSettingsForm
 *
 * @author User
 */
class AdminMenuSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'click_admin_menu_form';
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Form constructor.
        $form = parent::buildForm($form, $form_state);
        // Default settings.
        $config = $this->config('click_admin_menu.settings');
        // Page title field.
        $form['page_title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('click_admin_menu.page_title'),
        );
        // Source text field.
        $form['link_target'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Target blank'),
            '#default_value' => $config->get('click_admin_menu.link_target'),
        );

        return $form;
    }
    
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('click_admin_menu.settings');
        $config->set('click_admin_menu.link_target', $form_state->getValue('link_target'));
        $config->set('click_admin_menu.page_title', $form_state->getValue('page_title'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'click_admin_menu.settings',
        ];
    }
}
