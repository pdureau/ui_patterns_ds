<?php

declare(strict_types=1);

namespace Drupal\ui_patterns_ds\Plugin\UiPatterns\Source;

use Drupal\ui_patterns\SourcePluginBase;

#[Source(
  id: 'ds_field',
  label: new TranslatableMarkup('DS Feild'),
  description: new TranslatableMarkup('Formatted display suite field.'),
  prop_types: ['slot']
)]
class DsField extends SourcePluginBase {

  /**
   * {@inheritdoc}
   */
  public function getPropValue(): mixed {
    // @todo : Update this. Looks like there is no impact of this.
    return [
      "#plain_text" => "This is a DS field",
    ];

  }

}
