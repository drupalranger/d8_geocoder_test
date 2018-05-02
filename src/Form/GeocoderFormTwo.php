<?php

namespace Drupal\geocoder_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class for this form.
 */
class GeocoderFormTwo extends FormBase {

  protected $title = 'Geocoder - DI + Form API AJAX test';

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'geocoder_test_two';
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->title = $this->t($title);
    return $this;
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $geocoder = \Drupal::service('geocoder');
    $form['anything'] = [
      '#type' => 'markup',
      '#markup' => 'Hello there 222',
      '#suffix' => '<div id="any-wrapper">-</div>',
    ];

    $form['ajax_anything'] = [
      '#type' => 'button',
      '#value' => $this->t('Click on me'),
      '#ajax' => [
        'callback' => [$this, 'doAnything'],
        'wrapper' => 'any-wrapper',
        'progress' => [
          'type' => 'throbber',
          'message' => t('Doing anything...'),
        ],
      ],
    ];

    return $form;
  }

  /**
   * Dummy ajax callback.
   */
  public function doAnything(array &$form, FormStateInterface &$form_state) {
    return time();
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('Hello submit', 'status');
  }

}
