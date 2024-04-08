<?php

namespace Drupal\mt_domain_navigator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MtDomainNavigatorAdminForm.
 */
class MtDomainNavigatorAdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mt_domain_navigator.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mt_domain_navigator_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mt_domain_navigator.settings');

    $form['domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Domain'),
      '#description' => $this->t('Enter the domain.'),
      '#default_value' => $config->get('domain'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('mt_domain_navigator.settings')
      ->set('domain', $form_state->getValue('domain'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
