<?php

namespace Drupal\openid_connect\Plugin\OpenIDConnectClient;

use Drupal\Core\Form\FormStateInterface;
use Drupal\openid_connect\Plugin\OpenIDConnectClientBase;

/**
 * ANS OpenID Connect client.
 *
 * Implements OpenID Connect Client plugin for Pro Sante Connect.
 *
 * @OpenIDConnectClient(
 *   id = "Prosanteconnect",
 *   label = @Translation("Prosanteconnect")
 * )
 */
class OpenIDConnectProsanteconnectClient extends OpenIDConnectClientBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'sandbox' => '',
      'scopes' => '',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['sandbox'] = [
      '#title' => $this->t('Environment'),
      '#type' => 'select',
      '#options' => array_combine(['BAS', 'PROD'], ['BAS', 'PROD']),
      '#default_value' => $this->configuration['sandbox'],
    ];
	
	$form['scopes'] = [
      '#title' => $this->t('Scopes Pro Santé Connect'),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['scopes'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getEndpoints() {
	  
	if ($this->configuration['sandbox'] == 'BAS') {
		// Data from https://auth.bas.psc.esante.gouv.fr/auth/realms/esante-wallet/.well-known/wallet-openid-configuration
		return [
		  'authorization' => 'https://wallet.bas.psc.esante.gouv.fr/auth/?acr_values=eidas1',
		  'token' => 'https://auth.bas.psc.esante.gouv.fr/auth/realms/esante-wallet/protocol/openid-connect/token',
		  'userinfo' => 'https://auth.bas.psc.esante.gouv.fr/auth/realms/esante-wallet/protocol/openid-connect/userinfo',
		];
	}
	else {
		// Data from https://auth.esw.esante.gouv.fr/auth/realms/esante-wallet/.well-known/wallet-openid-configuration
		return [
		  'authorization' => 'https://wallet.esw.esante.gouv.fr/auth/?acr_values=eidas1',
		  'token' => 'https://auth.esw.esante.gouv.fr/auth/realms/esante-wallet/protocol/openid-connect/token',
		  'userinfo' => 'https://auth.esw.esante.gouv.fr/auth/realms/esante-wallet/protocol/openid-connect/userinfo',
		];
	}
  }

  /**
   * {@inheritdoc}
   */
  public function getClientScopes() {
	  return $this->configuration['scopes'];
  }

  /**
   * {@inheritdoc}
   */
  public function retrieveUserInfo($access_token) {
    $userinfo = parent::retrieveUserInfo($access_token);
    if ($userinfo) {
		// Add specific treatment on UserInfo endpoint results
    }

    return $userinfo;
  }

}
