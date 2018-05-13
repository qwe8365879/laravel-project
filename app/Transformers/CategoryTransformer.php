<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Model\Category;


class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent','children','articles'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(Category $category)
    {
        return [

            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
			'parent' => $category->parent
        ];
    }

    public function includeParent(Category $category){
        return $this->item($category->getParent, new CategoryTransformer);
    }

    public function includeChildren(Category $category){
        return $this->collection($category->children, new CategoryTransformer);
    }

    public function includeArticles(Category $category){
        return $this->collection($category->articles, new ArticleTransformer);
    }
}
