<?php

namespace Drupal\custom_field_type\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Define the "custom field type".
 * As per the Drupal Community Guidelines, we need to specify the annotation for all
 * the plugin types
 *
 * @FieldType(
 *   id = "custom_field_type",
 *   label = @Translation("Custom Plugin Field Type"),
 *   description = @Translation("Description for Custom Field Type"),
 *   category = @Translation("Text"),
 *   default_widget = "custom_plugin_field_widget", (Adding the field_widget after the field_widget class has been created)
 *   default_formatter = "custom_plugin_field_formatter", (Adding the field_formatter after the field_formatter class has been created)
 * )
 */

class CustomPluginFieldType extends FieldItemBase {

    /**
     * {@inheritdoc}
     */

    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return [
            'columns' => [
                'value' => [
                    'type' => 'varchar',
                    'length' => $field_definition->getSetting("length"),
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function defaultStorageSettings() {
        return [
            'length' => 255,
        ] + parent::defaultStorageSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
        $element = [];

        $element['length'] = [
            '#type' => 'number',
            '#title' => t("Length of your text"),
            '#required' => TRUE,
            '#default_value' => $this->getSetting("length"),
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function defaultFieldSettings() {
        return [
            'moreinfo' => "More info default value",
        ] + parent::defaultFieldSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
        $element = [];
        $element['moreinfo'] = [
            '#type' => 'textfield',
            '#title' => 'More information about this field',
            '#required' => TRUE,
            '#default_value' => $this->getSetting("moreinfo"),
        ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public static function PropertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('string')->setLabel(t("Name"));

        return $properties;
    }
}
