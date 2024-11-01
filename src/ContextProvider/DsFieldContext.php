<?php

namespace Drupal\ui_patterns_ds\ContextProvider;

use Drupal\Core\Plugin\Context\Context;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\Core\Plugin\Context\ContextProviderInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Context for fetching values from special fields from DS.
 */
class DsFieldContext implements ContextProviderInterface {

  use StringTranslationTrait;

  /**
   * Constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   Current request that trigger field settings.
   */
  public function __construct(private readonly RequestStack $requestStack) {}

  /**
   * {@inheritdoc}
   */
  public function getRuntimeContexts(array $unqualified_context_ids) {
    $context_definition = new ContextDefinition('string', $this->t('DS Field pattern context'));
    $result = [];
    $request = $this->requestStack->getCurrentRequest()->request;
    $parameters = $request->all();
    if (isset($parameters['fields']) && is_array($parameters['fields'])) {
      $fields = array_filter($parameters['fields'], function ($field) {
        return isset($field['settings_edit_form']['third_party_settings']['ds']['ft']['id']) && $field['settings_edit_form']['third_party_settings']['ds']['ft']['id'] == 'component';
      });
      $fields = array_keys($fields);
      $field = reset($fields);
      if (!empty($field)) {
        $trigger_element = $request->get('_triggering_element_name');
        $field = str_replace('_plugin_settings_edit', '', $trigger_element);
        if ($parameters['fields'][$field]) {
          $values[] = $parameters['fields'][$field];
        }
        $context = new Context($context_definition, $values);
        $result = [
          'ds_field_context' => $context,
        ];
      }
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getAvailableContexts() {
    return $this->getRuntimeContexts([]);
  }

}
