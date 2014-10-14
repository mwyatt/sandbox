# Orno\Http

[![Build Status](https://travis-ci.org/orno/http.png?branch=master)](https://travis-ci.org/orno/http)
[![Code Coverage](https://scrutinizer-ci.com/g/orno/http/badges/coverage.png?s=1b0cda2434b853f84d4c672d35c27affc556fd5b)](https://scrutinizer-ci.com/g/orno/http/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/orno/http/badges/quality-score.png?s=d9fde5f29191fdfdeac82e49e4d0bc8243932573)](https://scrutinizer-ci.com/g/orno/http/)
[![Latest Stable Version](https://poser.pugx.org/orno/http/v/stable.png)](https://packagist.org/packages/orno/http)
[![Total Downloads](https://poser.pugx.org/orno/http/downloads.png)](https://packagist.org/packages/orno/http)

This package is simply a wrapper for the [Symfony\HttpFoundation](http://symfony.com/doc/current/components/http_foundation/introduction.html) component with a little encapsulation of properties added and some pre-built response objects and convenience 4xx HTTP exceptions.

It is recommended you check out the documentation [here](http://symfony.com/doc/current/components/http_foundation/introduction.html) and for information on using the pre-built responses and HTTP exceptions, consider looking at [Orno\Route](https://github.com/orno/route).

## Encapsulation

This package provides encapsulated methods for all `Request` and `Response` based objects. These are as follows.

### Request

| Method    | Arguments         | Description                                                                                                                                                                                                                                                                 |
| --------- | ----------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `query`   | `$key` `$default` | Provides access to the `ParameterBag` containing data from the `$_GET` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.             |
| `post`    | `$key` `$default` | Provides access to the `ParameterBag` containing data from the `$_POST` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.            |
| `server`  | `$key` `$default` | Provides access to the `ParameterBag` containing data from the `$_SERVER` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.          |
| `files`   | `$key` `$default` | Provides access to the `ParameterBag` containing data from the `$_FILES` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.           |
| `cookie`  | `$key` `$default` | Provides access to the `ParameterBag` containing data from the `$_COOKIE` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.          |
| `headers` | `$key` `$default` | Provides access to the `HeaderBag` containing headers taken from the `$_SERVER` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.    |

### Response

| Method    | Arguments         | Description                                                                                                                                                                                                                                                                      |
| --------- | ----------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `cookie`  | `$key` `$default` | Provides access to the data from the `$_COOKIE` global. Calling without a `$key` will return an array of all cookies, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present.                            |
| `headers` | `$key` `$default` | Provides access to the `ResponseHeaderBag` containing headers taken from the `$_SERVER` global. Calling without a `$key` will return the object, with a `$key` will return the value of that key. Providing a `$default` value will return that value if the key is not present. |
