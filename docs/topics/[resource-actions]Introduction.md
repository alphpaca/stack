# Introduction

<primary-label ref="resource-actions"/>
<secondary-label ref="experimental"/>

Actions is the main mechanism allowing you to manipulate your resources. No matter if you want to build a simple CRUD
or domain-rich models – actions are your gateway to perform operations on resources.

Actions are a great way to decouple logic from your resource model. Alphpaca Stack comes with great extensions like
the `alphpaca/http-resource`, providing a great layer between the HTTP protocol and your resource.

## Creating an action

To create an action you need to create a class implementing the `Alphpaca\Contracts\Resource\Action\Action` contract.
Action by design is a single method class (`__invoke`) taking instances of `Alphpaca\Contracts\Resource\Action\Input\Input` and `Alphpaca\Contracts\Resource\Action\Context\Context`
as its arguments. It **always** must return an instance of a class implementing the `Alphpaca\Contracts\Resource\Action\Result` contract.

```php
<?php

namespace App\Resource\Action;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Result;
use App\Resource\Action\Result\OkResult; // a custom result object

class CreateReviewAction implements Action
{
    public function __invoke(Input $input, Context $context): Result
    {
        // your logic behind creating a review goes here
        
        return new OkResult();
    }
}
```

## Using actions

Once we create an action, we need to somehow execute its logic. The easiest way is to just invoke our action, just as
any other regular PHP class.

```php
<?php

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use App\Resource\Action\CreateReviewAction;

$input = new InputBag(); // some input that can be used by the action
$context = new ContextBag(); // some context that can be used by the action

$action = new CreateReviewAction();
$result = $action($input, $context);

// do something with a result
```

Of course, it is the most basic usage. Later we will learn about more advanced usages of Actions thanks to features
like [Registry](Registry.md) or [Middlewares]([resource-actions]Middleware).


