<?php

namespace Drupal\mt_domain_navigator\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a 'MtDomainNavigator' Block.
 *
 * @Block(
 *   id = "mt_domain_navigator_block",
 *   admin_label = @Translation("Domain Navigator"),
 *   category = @Translation("More than Themes"),
 * )
 */
class MtDomainNavigatorBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('mt_domain_navigator.settings');
    $domain = $config->get('domain');
    $caption = $config->get('caption');
    $protocol = $config->get('protocol');

    $links_config = $config->get('links');
    $links = [];
    $links_config = str_replace('\n', "\n", $links_config);

    // Get the current path and query parameters
    $current_path = \Drupal::service('path.current')->getPath();
    $current_query = \Drupal::request()->query->all();

    // Get the alias of the current path
    $alias_manager = \Drupal::service('path_alias.manager');
    $alias_path = $alias_manager->getAliasByPath($current_path);

    foreach (explode("\r\n", $links_config) as $link) {
      list($title, $subdomain) = explode('|', $link);
      $url = $protocol . '://' . $subdomain . '.' . $domain . $alias_path;
      
      // Add the query parameters if they exist
      if (!empty($current_query)) {
        $url .= '?' . http_build_query($current_query);
      }

      // Construct the image URL
      $baseImageUrl = "https://mttpublic.s3.us-east-2.amazonaws.com/assets/webmaker/";
      $imageFilename = $subdomain . ".jpg";
      $imageUrl = $baseImageUrl . $imageFilename;

      $links[] = [
        'title' => $this->t($title),
        'url' => Url::fromUri($url),
        'image' => $imageUrl, // Add the image URL to the link array
      ];
    }

    // $links = [
    //   'base' => [
    //     'title' => $this->t('Base+'),
    //     'url' => Url::fromUri("http://base.$domain"),
    //   ],
    //   'groovy' => [
    //     'title' => $this->t('Groovy+'),
    //     'url' => Url::fromUri("http://groovy.$domain"),
    //   ],
    //   'flashy' => [
    //     'title' => $this->t('Flashy+'),
    //     'url' => Url::fromUri("http://flashy.$domain"),
    //   ],
    // ];

    return [
      '#theme' => 'links__mt_domain_navigator',
      '#links' => $links,
      '#caption' => $caption,
      '#attached' => [
        'library' => [
          'mt_domain_navigator/fontawesome',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}