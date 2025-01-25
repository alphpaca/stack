# Middleware

<primary-label ref="resource-actions"/>
<secondary-label ref="experimental"/>

Middlewares are a powerful mechanism allowing easily extend actions behaviors with more flexibility than standard
decoration pattern.

## Creating a Middleware

Middleware is a class implementing the `Alphpaca\Contracts\Resource\Action\Middleware` contract. By design, it has only
one `__invoke` method taking the instances implementing the `Alphpaca\Contracts\Resource\Action\Input\Input` and `Alphpaca\Contracts\Resource\Action\Context\Context`
contracts as its two first arguments. Third argument is a `callable` which is another middleware or an action to be invoked.

Just as a regular action, middleware is obligated by its contract to return an instance of a class implementing the 
`Alphpaca\Contracts\Resource\Action\Result` contract.

```PHP
<?php

namespace App\Resource\Action\Middleware;

use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;

class LoggerMiddleware implements Middleware
{
    public function __invoke(Input $input, Context $context, callable $next): Result
    {
        $enableLogging = $context->get('enable_logging', false); // something passed from outside
        
        if (false === $enableLogging)
        {
            return $next($input, $context);
        }
        
        // log something before invoking next middlewares/action
        
        $result = $next($input, $context);
        
        // log something after invoking next middleware/action
        
        return $result;
    }
}
```

## Using middlewares

The basic usage of actions and middlewares is by using the `Alphpaca\Component\Resource\Action\MiddlewareChainAction` class.

```php
<?php

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use Alphpaca\Component\Resource\Action\MiddlewareChainAction;
use App\Resource\Action\Middleware\AuthorizationCheckerMiddleware; // let's assume it exists
use App\Resource\Action\Middleware\LoggerMiddleware;
use App\Resource\Action\MyAction;

$action = new MyAction();

$authorizationCheckerMiddleware = new AuthorizationCheckerMiddleware();
$loggerMiddleware = new LoggerMiddleware();

$middlewareChainAction = new MiddlewareChainAction($action, $authorizationCheckerMiddleware, $loggerMiddleware);

$input = new InputBag();
$context = new ContextBag(['enable_logging' => true]);

$result = $middlewareChainAction($input, $context);

// now we can do anything with our $result
```

Let's decompose what actually is happening here:

1. We create an instance of our action (but we do not invoke it!)
2. We create instances of our middlewares
3. We create an instance of the `MiddlewareChainAction`
4. We create example input and context
5. We call the `$middlewareChainAction`
6. Firstly the `AuthorizationCheckerMiddleware` is executed, because it is the first passed middleware
7. Secondly the `LoggerMiddleware` is executed, because it is after the `AuthorizationCheckerMiddleware`
8. Finally, our `MyAction` is called, because action is always called as last

