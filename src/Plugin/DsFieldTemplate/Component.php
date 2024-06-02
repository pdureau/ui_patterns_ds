<?php

declare(strict_types=1);

namespace Drupal\ui_patterns_ds\Plugin\DsFieldTemplate;

use Drupal\Core\Form\FormState;
use Drupal\ds\Plugin\DsFieldTemplate\DsFieldTemplateBase;
use Drupal\ui_patterns\Form\ComponentFormBuilderTrait;

/**
 * Plugin for the expert field template.
 *
 * @DsFieldTemplate(
 *   id = "component",
 *   title = @Translation("Component (UI Patterns)"),
 *   theme = "pattern_ds_field_template",
 * )
 */
class Component extends DsFieldTemplateBase {

  use ComponentFormBuilderTrait;

  /**
   * {@inheritdoc}
   */
  public function alterForm(&$form) {
    $config = $this->getConfiguration();
    // ksm($form);
    $form_state = new FormState();
    $form["ui_patterns"] = $this->buildComponentsForm($form_state, [], NULL, TRUE, TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return $this->getComponentFormDefault();
  }

  /**
   * {@inheritdoc}
   */
  public function massageRenderValues(&$field_settings, $values) {
    // @todo
  }

}
