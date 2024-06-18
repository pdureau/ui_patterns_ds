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
    $context = [];
    $current_field = $this->getCurrentField();
    if ($current_field) {
      // @todo $current_field need to implement ContextInterface
      $context['field'] = $current_field;
    }
    $form_state = new FormState();
    $form = array_merge($form, $this->buildComponentsForm($form_state, $context, NULL, TRUE, TRUE));
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

  /**
   * Get the field currently being edited.
   *
   * @return string
   *   Name of the field currently being edited.
   */
  protected function getCurrentField(): ?string {
    $request = \Drupal::service('request_stack')->getCurrentRequest()->request;
    $parameters = $request->all();
    if (isset($parameters['fields']) && is_array($parameters['fields'])) {
      $fields = array_filter($parameters['fields'], function ($field) {
        return isset($field['settings_edit_form']['third_party_settings']['ds']['ft']['id']) && $field['settings_edit_form']['third_party_settings']['ds']['ft']['id'] == 'component';
      });
      $fields = array_keys($fields);
      $field = reset($fields);
    }
    if (empty($field)) {
      $trigger_element = $request->get('_triggering_element_name');
      $field = str_replace('_plugin_settings_edit', '', $trigger_element);
    }
    return isset($parameters['fields'][$field]) ? $field : NULL;
  }

}
