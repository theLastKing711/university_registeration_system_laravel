<?php

namespace App\Models;

use App\Enum\FileUploadDirectory;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string $file_url
 * @property int $size
 * @property string|null $file_type
 * @property string $public_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\TemporaryUploadedImagesFactory factory($count = null, $state = [])
 * @method static Illuminate\Database\Eloquent\Builder<static> joinRelationship(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages newQuery()
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByLeftPowerJoins(string|array<string, \Illuminate\Contracts\Database\Query\Expression> $column)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByLeftPowerJoinsCount(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoins(string|array<string, \Illuminate\Contracts\Database\Query\Expression> $column)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsAvg(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsCount(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsMax(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsMin(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerJoinsSum(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsAvg(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsMax(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsMin(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> orderByPowerLeftJoinsSum(string $column, string|null $order)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinHas(string $relations, mixed operater, mixed value)
 * @method static Illuminate\Database\Eloquent\Builder<static> powerJoinWhereHas(string $relations, \Closure(Illuminate\Database\Query\JoinClause $join)|array $join_callback_or_array)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemporaryUploadedImages whereUserId($value)
 *
 * @mixin \Eloquent
 */
class TemporaryUploadedImages extends Model
{
    /** @use HasFactory<\Database\Factories\TemporaryUploadedImagesFactory> */
    use HasFactory;

    /**
     * Summary of medially
     *
     * @return MorphTo<Model, $this>|MorphTo<Model, \Eloquent>
     */
    public function uploadable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Summary of user
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function fromCloudinaryUploadResponse(array $cloud_image_resposne, FileUploadDirectory $fileUploadDirectory): self
    {

        $first_eager_response =
                        $cloud_image_resposne['eager'][0];

        $temporary_uploaded_image = new TemporaryUploadedImages;
        $temporary_uploaded_image->public_id = $cloud_image_resposne[CloudinaryEngine::PUBLIC_ID];
        $temporary_uploaded_image->file_name = $cloud_image_resposne[CloudinaryEngine::ORIGINAL_FILENAME];
        $temporary_uploaded_image->file_url = $cloud_image_resposne[CloudinaryEngine::SECURE_URL];
        $temporary_uploaded_image->size = $cloud_image_resposne[CloudinaryEngine::BYTES];
        $temporary_uploaded_image->file_type = $cloud_image_resposne[CloudinaryEngine::RESOURCE_TYPE];
        $temporary_uploaded_image->collection_name = $fileUploadDirectory->value;
        $temporary_uploaded_image->thumbnail_url = $first_eager_response[CloudinaryEngine::SECURE_URL];

        return $temporary_uploaded_image;
    }

    #[Scope]
    protected function profilePicture(Builder $query): void
    {
        $query
            ->where(
                'collection_name',
                FileUploadDirectory::USER_PROFILE_PICTURE
            );

    }
}
