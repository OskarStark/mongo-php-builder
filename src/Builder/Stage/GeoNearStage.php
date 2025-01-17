<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Stage;

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Document;
use MongoDB\BSON\Int64;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\Builder\Type\StageInterface;
use stdClass;

use function is_array;
use function is_object;

/**
 * Returns an ordered stream of documents based on the proximity to a geospatial point. Incorporates the functionality of $match, $sort, and $limit for geospatial data. The output documents include an additional distance field and can include a location identifier field.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/geoNear/
 */
class GeoNearStage implements StageInterface, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var non-empty-string $distanceField The output field that contains the calculated distance. To specify a field within an embedded document, use dot notation. */
    public readonly string $distanceField;

    /** @var Document|Serializable|array|stdClass $near The point for which to find the closest documents. */
    public readonly Document|Serializable|stdClass|array $near;

    /** @var Optional|Decimal128|Int64|float|int $distanceMultiplier The factor to multiply all distances returned by the query. For example, use the distanceMultiplier to convert radians, as returned by a spherical query, to kilometers by multiplying by the radius of the Earth. */
    public readonly Optional|Decimal128|Int64|float|int $distanceMultiplier;

    /** @var Optional|non-empty-string $includeLocs This specifies the output field that identifies the location used to calculate the distance. This option is useful when a location field contains multiple locations. To specify a field within an embedded document, use dot notation. */
    public readonly Optional|string $includeLocs;

    /** @var Optional|non-empty-string $key Specify the geospatial indexed field to use when calculating the distance. */
    public readonly Optional|string $key;

    /**
     * @var Optional|Decimal128|Int64|float|int $maxDistance The maximum distance from the center point that the documents can be. MongoDB limits the results to those documents that fall within the specified distance from the center point.
     * Specify the distance in meters if the specified point is GeoJSON and in radians if the specified point is legacy coordinate pairs.
     */
    public readonly Optional|Decimal128|Int64|float|int $maxDistance;

    /**
     * @var Optional|Decimal128|Int64|float|int $minDistance The minimum distance from the center point that the documents can be. MongoDB limits the results to those documents that fall outside the specified distance from the center point.
     * Specify the distance in meters for GeoJSON data and in radians for legacy coordinate pairs.
     */
    public readonly Optional|Decimal128|Int64|float|int $minDistance;

    /**
     * @var Optional|Document|QueryInterface|Serializable|array|stdClass $query Limits the results to the documents that match the query. The query syntax is the usual MongoDB read operation query syntax.
     * You cannot specify a $near predicate in the query field of the $geoNear stage.
     */
    public readonly Optional|Document|Serializable|QueryInterface|stdClass|array $query;

    /**
     * @var Optional|bool $spherical Determines how MongoDB calculates the distance between two points:
     * - When true, MongoDB uses $nearSphere semantics and calculates distances using spherical geometry.
     * - When false, MongoDB uses $near semantics: spherical geometry for 2dsphere indexes and planar geometry for 2d indexes.
     * Default: false.
     */
    public readonly Optional|bool $spherical;

    /**
     * @param non-empty-string $distanceField The output field that contains the calculated distance. To specify a field within an embedded document, use dot notation.
     * @param Document|Serializable|array|stdClass $near The point for which to find the closest documents.
     * @param Optional|Decimal128|Int64|float|int $distanceMultiplier The factor to multiply all distances returned by the query. For example, use the distanceMultiplier to convert radians, as returned by a spherical query, to kilometers by multiplying by the radius of the Earth.
     * @param Optional|non-empty-string $includeLocs This specifies the output field that identifies the location used to calculate the distance. This option is useful when a location field contains multiple locations. To specify a field within an embedded document, use dot notation.
     * @param Optional|non-empty-string $key Specify the geospatial indexed field to use when calculating the distance.
     * @param Optional|Decimal128|Int64|float|int $maxDistance The maximum distance from the center point that the documents can be. MongoDB limits the results to those documents that fall within the specified distance from the center point.
     * Specify the distance in meters if the specified point is GeoJSON and in radians if the specified point is legacy coordinate pairs.
     * @param Optional|Decimal128|Int64|float|int $minDistance The minimum distance from the center point that the documents can be. MongoDB limits the results to those documents that fall outside the specified distance from the center point.
     * Specify the distance in meters for GeoJSON data and in radians for legacy coordinate pairs.
     * @param Optional|Document|QueryInterface|Serializable|array|stdClass $query Limits the results to the documents that match the query. The query syntax is the usual MongoDB read operation query syntax.
     * You cannot specify a $near predicate in the query field of the $geoNear stage.
     * @param Optional|bool $spherical Determines how MongoDB calculates the distance between two points:
     * - When true, MongoDB uses $nearSphere semantics and calculates distances using spherical geometry.
     * - When false, MongoDB uses $near semantics: spherical geometry for 2dsphere indexes and planar geometry for 2d indexes.
     * Default: false.
     */
    public function __construct(
        string $distanceField,
        Document|Serializable|stdClass|array $near,
        Optional|Decimal128|Int64|float|int $distanceMultiplier = Optional::Undefined,
        Optional|string $includeLocs = Optional::Undefined,
        Optional|string $key = Optional::Undefined,
        Optional|Decimal128|Int64|float|int $maxDistance = Optional::Undefined,
        Optional|Decimal128|Int64|float|int $minDistance = Optional::Undefined,
        Optional|Document|Serializable|QueryInterface|stdClass|array $query = Optional::Undefined,
        Optional|bool $spherical = Optional::Undefined,
    ) {
        $this->distanceField = $distanceField;
        $this->near = $near;
        $this->distanceMultiplier = $distanceMultiplier;
        $this->includeLocs = $includeLocs;
        $this->key = $key;
        $this->maxDistance = $maxDistance;
        $this->minDistance = $minDistance;
        if (is_array($query) || is_object($query)) {
            $query = QueryObject::create(...$query);
        }

        $this->query = $query;
        $this->spherical = $spherical;
    }

    public function getOperator(): string
    {
        return '$geoNear';
    }
}
