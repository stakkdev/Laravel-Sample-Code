<?php

namespace App\Http\Middleware\API\V1;

use App\Traits\API\V1\Common\APIResponse;

use App\Exceptions\API\V1\SuccessException;
use App\Exceptions\API\V1\SomeThingWentWrong;
use App\Exceptions\API\V1\BadRequestException;
use App\Exceptions\API\V1\ValidationException;
use App\Exceptions\API\V1\RecordNotFoundException;

use App\Http\Resources\API\V1\Interfaces\IHandler;

class ResourceHandler
{
    use APIResponse;

    private $iHandler;

    public function __construct(IHandler $iHandler)
    {
        $this->iHandler = $iHandler;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        try {
            $response = $next($request);

            // Having the `original` property means that we have the models and
            // the response can be tried to transform
            if (property_exists($response, 'original')) {
                // Transform based on model and reset the content
                return $this->reponseSuccess($this->iHandler->transformModel($response->original));
            }
        } catch (SuccessException $ex) {
            // if there is success exception then show 
            return $this->reponseSuccess($ex->getData(), $ex->getMessage());
        } catch (SomeThingWentWrong $ex) {
            return $this->respondNotFound($ex->getMessage());
        } catch (ValidationException $ex) {
            return $this->respondInvalidParameters($ex->getMessage());
        } catch (BadRequestException $ex) {
            return $this->respondInvalidParameters($ex->getMessage());
        } catch (RecordNotFoundException $ex) {
            return $this->respondNotFound($ex->getMessage());
        } catch (Exception $ex) {
            return $this->respondInternalError($ex->getMessage());
        }
    }
}
