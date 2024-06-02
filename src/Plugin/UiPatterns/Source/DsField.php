<?php

declare(strict_types=1);

namespace Drupal\ui_patterns_ds\Plugin\UiPatterns\Source;

use Drupal\ui_patterns\SourcePluginBase;

/**
 * Plugin implementation of the source.
 *
 * @Source(
 *   id = "ds_field",
 *   label = @Translation("DS field"),
 *   description = @Translation("Formatted display suite field"),
 *   prop_types = {
 *     "slot"
 *   }
 * )
 */
class DsField extends SourcePluginBase {

  /**
   * {@inheritdoc}
   */
  public function getPropValue(): mixed {
    ksm($this->context);
    // @todo
    return [
      "#plain_text" => "This is a DS field",
    ];

  }

}
