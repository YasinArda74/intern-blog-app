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
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property array<array-key, mixed> $content
 * @property string $status
 * @property int $is_featured
 * @property int $views_count
 * @property string|null $published_at
 * @property string|null $scheduled_at
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereViewsCount($value)
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

    // region Kelime sayısına bağlı olarak blogun süresini hesaplar dakidada 200 kelime okunulduğunu baz alır ve en düşük 1 dakika yazar
    public function readingTimeMinutes(): int
    {
        return max(1, (int) ceil($this->countWordsInContent($this->content) / 200));
    }

    private function countWordsInContent(mixed $node): int
    {
        if (is_string($node)) {
            return $this->countWordsInText($node);
        }

        if (! is_array($node)) {
            return 0;
        }

        $wordCount = 0;
        $text = $node['text'] ?? null;

        if (is_string($text)) {
            $wordCount += $this->countWordsInText($text);
        }

        foreach (is_array($node['content'] ?? null) ? $node['content'] : [] as $child) {
            $wordCount += $this->countWordsInContent($child);
        }

        return $wordCount;
    }

    private function countWordsInText(string $text): int
    {
        $wordCount = preg_match_all('/[\p{L}\p{N}]+/u', $text);

        if ($wordCount === false) {
            throw new \UnexpectedValueException('Post content contains invalid UTF-8.');
        }

        return $wordCount;
    }
//endregion
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
            } elseif (blank($post->status)) {
                $post->status = PostStatusEnum::published;
                $post->published_at ??= now();
            }
        });

        static::creating(function (self $post) {
            $post->uuid = Str::uuid();
        });
    }
}
