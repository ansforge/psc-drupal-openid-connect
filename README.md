# psc-drupal-openid-connect
---
Ce projet est un patch du [module OpenID officiel de Drupal](https://www.drupal.org/project/openid_connect) intégrant nativement une partie de la configuration de Pro Santé Connect.

Dans la classe `OpenIDConnectProsanteconnectClient` du fichier *src\Plugin\OpenIDConnectClient\OpenIDConnectProsanteconnectClient.php*, la surcharge de la fonction `retrieveUserInfo` permettra de récupérer les champs du jeton UserInfo.

> La version courante est basée sur `openid_connect-8.x-1.2`

> Vous devez créer une archive ***tar.gz*** ou ***ZIP*** contenant le repertoire *openid_connect*

