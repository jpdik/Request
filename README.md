# Request

A simple request class for PHP

## Instalation

```sh
composer require jpdik/request
```

## Example use

Create a base_url:

```php
$req = new Request("https://api.openweathermap.org/data/2.5");
```
Specify the rest of request and Type (GET, POST, PUT or DELETE) and get the response:

```php
$res = $req->get("/weather", "?q=São joão del rei&appid=d15abc236092bbf9dd28fa2c0a7a02a9");

if($res){
  echo json_encode($res);
}
```

# Methods

```php
//GET
get($url, $option = null, array $headers = null, $timeout = null)

//POST
post($url, $body, $option = null, array $headers = null, $timeout = null)

//PUT
put($url, $body, $option = null, array $headers = null, $timeout = null)

//DELETE
delete($url, $option = null, array $headers = null, $timeout = null)
```

## Example Headers

```php
$headers = [
  "Content-Type: application/json",
  "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0b2tlbiI6IjcyYTg0NDdhOTA3MGYyZTVmOGIzZDkzYzViZjE4MWE0In0.99kTzhSVwges69qprisg9B3rty4eKTTBurH-1lGKe30"];
```

if Headers it's not informed, the default is used as JSON:

```php
$headers = [
  "Content-Type: application/json",
];
```

## Full example

```php
$req = new Request("https://api.openweathermap.org/data/2.5");

$res = $req->get("/weather", "?q=São joão del rei&appid=d15abc236092bbf9dd28fa2c0a7a02a9");

if($res){
  echo json_encode($res);
}
```