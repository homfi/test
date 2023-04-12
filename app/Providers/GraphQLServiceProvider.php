<?php

namespace App\Providers;

use App\Enums\OrderStatus;
use GraphQL\Type\Definition\EnumType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class GraphQLServiceProvider extends ServiceProvider
{
    private const ORDER_STATUS = 'OrderStatus';

    protected array $types = [];

    private static array $enums = [
        self::ORDER_STATUS,
    ];

    public function boot(TypeRegistry $typeRegistry): void
    {
        try {
            collect(self::$enums)
                ->each(fn($enum) => $typeRegistry->registerLazy(
                    $enum,
                    static fn() => new EnumType(self::enumData($enum))
                ));
        } catch (DefinitionException $exception) {
            Log::error($exception->getMessage());
        }

        collect($this->types)
            ->each(fn($type) => (new $type())->boot($typeRegistry));
    }

    private static function enumData(string $enum): array
    {
        return match ($enum) {
            self::ORDER_STATUS => OrderStatus::values(),
            default => []
        };
    }
}
