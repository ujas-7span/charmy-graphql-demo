<?php

namespace App\GraphQL;

use GraphQL\Error\Error;
use GuzzleHttp\Exception\GuzzleException;
use Rebing\GraphQL\Error\ValidationError;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ErrorHandler
{
    public static function formatError(Error $e)
    {
        $error['message'] = $e->getMessage();

        $previous = $e->getPrevious();

        // Set GuzzleException error handling
        if ($previous instanceof GuzzleException) {
            $exception = json_decode($previous->getResponse()->getBody());
            $error['message'] = (!empty($exception->message) ? $exception->message : $exception->error_description);
            return $exception;
        }

        if ($previous && $previous instanceof ValidationError) {
            $errorMessage = $previous->getValidatorMessages()->toArray();
            foreach ($errorMessage as $key => $message) {
                if (strpos($key, 'input.') === 0) {
                    $key = str_replace('input.', "", $key);
                }
                $message  = str_replace('input.', "", $message);
                $error['fields'][$key] = $message;
            }
        }
        if ($previous && $previous instanceof ModelNotFoundException) {
            $modelName = last(explode('\\', $previous->getModel()));
            $error['message'] =  __('error.entityNotFound', ['entity' => $modelName]);
        }
        return $error;
    }
}
