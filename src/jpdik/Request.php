<?php

namespace jpdik;

use Exception;

/**
 * Class Request
 * Author: João Paulo
 * 
 * Descrição: Classe para criar requisições REST
 * 
 * Exemplo:
 * 
 * $req = new Request("https://api.openweathermap.org/data/2.5");
 * 
 * $res = $req->get("/weather?q={city name}&appid={API key}");
 * 
 * echo $res;
 */
class Request
{
  public $base_url;

  /**
   * Construtor
   * 
   * Cria a base de URL que será usada nas requisições:
   * 
   * Exemplo:
   * 
   * $req = new Request("https://api.openweathermap.org/data/2.5");
   * 
   */
  public function __construct($baseurl)
  {
    $this->base_url = $baseurl;

    return $this;
  }

  /**
   * Método GET
   * 
   * Faz uma requisição do tipo GET.
   * 
   * Também é permitido passar oçpões para a URL e headers (campos opcionais)
   * 
   * Exemplo:
   * 
   * $res = $req->get("/weather?q={city name}&appid={API key}");
   */
  public function get($url, $option = null, array $headers = null, $timeout = null)
  {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->base_url . $url . $option);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    if ($timeout)
      curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

    if (!$headers)
      $headers = [
        "Content-Type: application/json",
      ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    if ($response === false)
      return curl_error($ch);
    curl_close($ch);
    if (in_array("Content-Type: application/json", $headers))
      $response = json_decode($response);

    return $response;
  }

  /**
   * Método POST
   * 
   * Faz uma requisição do tipo POST.
   * 
   * Também é permitido passar oçpões para a URL e headers (campos opcionais)
   * 
   * Exemplo:
   * 
   * $res = $req->post("/weather?q={city name}&appid={API key}", ["status": 1]);
   */
  public function post($url, $body, $option = null, array $headers = null, $timeout = null)
  {
    if (!$headers)
      $headers = [
        "Content-Type: application/json",
      ];

    if (in_array("Content-Type: application/json", $headers))
      $params = json_encode($body);
    else
      $params = $body;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->base_url . $url . $option);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    if ($timeout)
      curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);


    if ($response === false)
      throw new Exception(curl_error($ch));
    curl_close($ch);
    if (in_array("Content-Type: application/json", $headers))
      $response = json_decode($response);

    return $response;
  }

  /**
   * Método PUT
   * 
   * Faz uma requisição do tipo PUT.
   * 
   * Também é permitido passar oçpões para a URL e headers (campos opcionais)
   * 
   * Exemplo:
   * 
   * $res = $req->put("/weather?q={city name}&appid={API key}", [], null, ["Content-Type: application/json", "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"]);
   */
  public function put($url, $body, $option = null, array $headers = null, $timeout = null)
  {
    if (!$headers)
      $headers = [
        "Content-Type: application/json",
      ];

    if (in_array("Content-Type: application/json", $headers))
      $params = json_encode($body);
    else
      $params = $body;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $this->base_url . $url . $option);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    if ($timeout)
      curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

    curl_setopt($ch, CURLOPT_PUT, TRUE);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    if (!$headers)
      $headers = [
        "Content-Type: application/json",
      ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);
    if (in_array("Content-Type: application/json", $headers))
      $response = json_decode($response);

    return $response;
  }

  /**
   * Método DELETE
   * 
   * Faz uma requisição do tipo DELETE.
   * 
   * Também é permitido passar oçpões para a URL e headers (campos opcionais)
   * 
   * Exemplo:
   * 
   * $res = $req->delete("/weather?q={city name}&appid={API key}", null, ["Content-Type: application/json", "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"]);
   */
  public function delete($url, $option = null, array $headers = null, $timeout = null)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->base_url . $url . $option);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    if ($timeout)
      curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    if (!$headers)
      $headers = [
        "Content-Type: application/json",
      ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);
    if (in_array("Content-Type: application/json", $headers))
      $response = json_decode($response);

    return $response;
  }
}
