<?php

namespace App\Models;

use App\Enums\PostStatusEnum;
use App\Support\TiptapRenderer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property json $content
 * @property int $views
 * @property int $category_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read User $user
 *
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereViews($value)
 *
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'is_featured',
        'views_count',
        'published_at',
        'scheduled_at',
        'user_id',
        'category_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function contentHtml(): string
    {
        return (new TiptapRenderer)->render($this->content);
    }

    // Hooks

    /**
     * boot metodu laravelin modelleri için life cycle hooklarıdır. Bu metotlar modelin yaşam döngüsü boyunca çalıştırılabilir.
     *
     * created => Oluşturulduktan sonra çalışır,
     * creating => Oluşturulma aşamasında çalışır,
     * updated => Güncellendikten sonra çalışır,
     * updating => Güncellenme aşamasında çalışır,
     * saved => Kayıt edildikten sonra çalışır. (hem update hem create),
     * saving => Kayıt edilirken çalışır. (hem update hem create),
     * deleted => Silindikten sonra çalışır,
     * deleting => Silinirken çalışır
     */
    public static function boot(): void
    {
        parent::boot();

        static::saving(function (self $post) {
            $post->slug = Str::slug($post->title);

            if ($post->scheduled_at !== null) {
                $post->status = PostStatusEnum::scheduled;
            }
        });

        static::creating(function (self $post) {
            $post->uuid = Str::uuid();
        });
    }
}
