<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\Helper\Factory;

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata as ResourceMetadataContract;
use Tests\Alphpaca\Component\Resource\Helper\Resource\ExampleResource;

/**
 * @method static ResourceMetadataContract withName(string $name, ResourceMetadataContract $resourceMetadata = null)
 * @method static ResourceMetadataContract withSource(string $source, ResourceMetadataContract $resourceMetadata = null)
 * @method static ResourceMetadataContract withSourceType(MetadataSourceType $sourceType, ResourceMetadataContract $resourceMetadata = null)
 * @method static ResourceMetadataContract withClass(string $class, ResourceMetadataContract $resourceMetadata = null)
 * @method static ResourceMetadataContract withPriority(int $priority, ResourceMetadataContract $resourceMetadata = null)
 */
class ResourceMetadataFactory
{
    /** @var array<string> */
    public const array ALLOWED_PROPERTIES = ['name', 'source', 'sourceType', 'class', 'priority'];

    public static function example(mixed ...$args): ResourceMetadataContract
    {


        $args['name'] ??= 'app_example';
        $args['source'] ??= ExampleResource::class;
        $args['sourceType'] ??= MetadataSourceType::ATTRIBUTE;
        $args['class'] ??= ExampleResource::class;
        $args['priority'] ??= 0;

        return new ResourceMetadata(...$args);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (str_starts_with($name, 'with')) {
            $propertyName = lcfirst(substr($name, 4));

            if (empty($propertyName)) {
                throw new \InvalidArgumentException('Invalid property name: property name cannot be empty');
            }

            if (empty($arguments)) {
                throw new \InvalidArgumentException(sprintf('No value provided for property "%s"', $propertyName));
            }

            if (!in_array($propertyName, self::ALLOWED_PROPERTIES, true)) {
                throw new \InvalidArgumentException(sprintf(
                    'Invalid property "%s". Allowed properties: %s',
                    $propertyName,
                    implode(', ', self::ALLOWED_PROPERTIES),
                ));
            }

            $value = $arguments[0] ?? null;
            $resourceMetadata = $arguments[1] ?? null;

            return self::withProperty($propertyName, $value, $resourceMetadata);
        }

        throw new \BadMethodCallException(sprintf('Call to undefined method %s::%s()', self::class, $name));
    }

    private static function withProperty(string $property, mixed $value, ?ResourceMetadataContract $resourceMetadata = null): ResourceMetadataContract
    {
        $existingProperties = $resourceMetadata ? self::getPropertiesWithValues($resourceMetadata) : [];
        $existingProperties[$property] = $value;

        return self::example(...$existingProperties);
    }

    private static function getPropertiesWithValues(ResourceMetadataContract $resourceMetadata): array
    {
        $result = [];
        $reflection = new \ReflectionClass($resourceMetadata);

        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if (!$property->isPublic()) {
                continue;
            }

            $result[$property->getName()] = $property->getValue($resourceMetadata);
        }

        return $result;
    }
}
