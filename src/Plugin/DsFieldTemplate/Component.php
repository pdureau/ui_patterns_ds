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
 *   theme = "ui_patterns_ds",
 * )
 */
class Component extends DsFieldTemplateBase {

  use ComponentFormBuilderTrait;

  /**
   * {@inheritdoc}
   */
  public function alterForm(&$form) {
    $config = $this->getConfiguration();
    $form_state = new FormState();
    $form =array_merge($form, $this->buildComponentsForm($form_state, [], NULL, TRUE, TRUE));
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
    $field_settings = $values['ui_patterns'];
  }

}
