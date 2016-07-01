<?php
/**
 * This file is part of serafimarts.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Article;

use Carbon\Carbon;
use Domains\User\User;
use Common\Orm\Mapping as ORM;
use Common\Observers\IdObserver;
use PhpDeal\Annotation as Contract;
use Illuminate\Database\Eloquent\Builder;
use Domains\Article\Base\AbstractArticle;
use Domains\Article\Observers\UrlGeneratorObserver;
use Domains\Article\Observers\ContentRenderObserver;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Domains\Article\Repository\EloquentArticleRepository;

/**
 * @uses IdObserver
 * @uses UrlGeneratorObserver
 * @uses ContentRenderObserver
 * @uses EloquentArticleRepository
 *
 * @ORM\Observe({
 *     IdObserver::class,
 *     UrlGeneratorObserver::class,
 *     ContentRenderObserver::class
 * })
 * @ORM\Repository(class=EloquentArticleRepository::class)
 *
 * @Contract\Invariant("is_uuid($this->id)")
 * @Contract\Invariant("is_uuid($this->user_id)")
 * @Contract\Invariant("is_uuid($this->category_id)")
 *
 * @method Article|Builder|QueryBuilder published()
 */
class Article extends AbstractArticle
{
    /**
     * @param Builder $query
     * @return Builder|Article
     */
    public static function scopePublished(Builder $query) : Builder
    {
        $query = $query
            ->where('is_draft', false)
            ->where('publish_at', '<=', Carbon::now());

        /** @var Builder|\Illuminate\Database\Query\Builder $query */
        return $query->orderBy('publish_at', 'desc');
    }

    /**
     * @param $value
     * @return Carbon
     *
     * @Contract\Verify("is_string($value) || $value instanceof \DateTime")
     */
    public function getPublishAtAttribute($value) : Carbon
    {
        return Carbon::parse($value);
    }
}