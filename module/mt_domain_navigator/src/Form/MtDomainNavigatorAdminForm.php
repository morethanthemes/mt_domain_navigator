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

    $form['protocol'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Protocol'),
      '#default_value' => $config->get('protocol'),
      '#description' => $this->t('Enter the protocol (http or https)'),
    ];

    $form['domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Domain'),
      '#description' => $this->t('Enter the domain.'),
      '#default_value' => $config->get('domain'),
    ];

    $form['caption'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Caption'),
      '#default_value' => $config->get('caption'),
    ];

    $form['links'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Links'),
      // '#default_value' => $config->get('links'),
      '#default_value' => str_replace('\n', "\n", $config->get('links')),
      '#description' => $this->t('Enter each link on a new line in the format: title|url'),
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
      // ->set('protocol', $form_state->getValue('protocol'))
      // ->set('caption', $form_state->getValue('caption'))
      // ->set('links', $form_state->getValue('links'))
      

    parent::submitForm($form, $form_state);
  }

}
