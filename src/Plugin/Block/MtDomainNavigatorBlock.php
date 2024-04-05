<?php

namespace Drupal\mt_domain_navigator\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a 'MtDomainNavigator' Block.
 *
 * @Block(
 *   id = "mt_domain_navigator_block",
 *   admin_label = @Translation("MT Domain Navigator Block"),
 *   category = @Translation("Custom"),
 * )
 */
class MtDomainNavigatorBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('mt_domain_navigator.settings');
    $domain = $config->get('domain');

    $links = [
      'base' => [
        'title' => $this->t('Base+'),
        'url' => Url::fromUri("http://base.$domain"),
      ],
      'groovy' => [
        'title' => $this->t('Groovy+'),
        'url' => Url::fromUri("http://groovy.$domain"),
      ],
      'flashy' => [
        'title' => $this->t('Flashy+'),
        'url' => Url::fromUri("http://flashy.$domain"),
      ],
    ];

    return [
      '#theme' => 'links__mt_domain_navigator',
      '#links' => $links,
    ];
  }

}