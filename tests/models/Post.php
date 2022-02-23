<?php

namespace Worksome\ModelAttributes\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Worksome\ModelAttributes\AttributeRelation;
use Worksome\ModelAttributes\Tests\Models\Attributes\CommentLength;
use Worksome\ModelAttributes\Tests\Models\Attributes\ImageUrl;
use Worksome\ModelAttributes\Tests\Models\Attributes\TagName;
use Worksome\ModelAttributes\Tests\Models\Attributes\UserName;

final class Post extends Model
{
    public function userName()
    {
        return new AttributeRelation(
            $this->belongsTo(
                UserName::class,
                $this->user()->getForeignKeyName(),
                $this->user()->getOwnerKeyName(),
            )
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function imageUrl()
    {
        return new AttributeRelation(
            $this->morphOne(
                ImageUrl::class,
                'imageable'
            )
        );
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function commentLength()
    {
        return new AttributeRelation(
            $this->morphMany(
                CommentLength::class,
                'commentable'
            )
        );
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tagNames(): AttributeRelation|MorphToMany
    {
        return new AttributeRelation(
            $this->morphToMany(
                TagName::class,
                'taggable',
                $this->tags()->getTable(),
                $this->tags()->getQualifiedForeignPivotKeyName(),
                $this->tags()->getQualifiedRelatedPivotKeyName(),
//                $this->tags()->getQualifiedParentKeyName(),
//                $this->tags()->getQualifiedRelatedKeyName(),
            )
        );
    }
}
