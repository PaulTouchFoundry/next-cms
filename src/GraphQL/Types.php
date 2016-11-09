<?php

namespace Wearenext\CMS\GraphQL;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;
use Wearenext\CMS\GraphQL\Type\Block;
use Wearenext\CMS\GraphQL\Type\Callout;
use Wearenext\CMS\GraphQL\Type\Media;
use Wearenext\CMS\GraphQL\Type\Page;
use Wearenext\CMS\GraphQL\Type\PageType;
use Wearenext\CMS\GraphQL\Type\QueryType;
use Wearenext\CMS\GraphQL\Type\Url;

class Types
{
    // Object types:
    private static $block;
    private static $callout;
    private static $media;
    private static $page;
    private static $pageType;
    private static $queryType;
    private static $url;

    /**
     * @return \Wearenext\CMS\GraphQL\Type\Block
     */
    public static function block()
    {
        return self::$block ?: (self::$block = new Block());
    }

    /**
     * @return \Wearenext\CMS\GraphQL\Type\Callout
     */
    public static function callout()
    {
        return self::$callout ?: (self::$callout = new Callout());
    }

    /**
     * @return \Wearenext\CMS\GraphQL\Type\Media
     */
    public static function media()
    {
        return self::$media ?: (self::$media = new Media());
    }

    /**
     * @return \Wearenext\CMS\GraphQL\Type\Page
     */
    public static function page()
    {
        return self::$page ?: (self::$page = new Page());
    }

    /**
     * @return \Wearenext\CMS\GraphQL\Type\PageType
     */
    public static function pageType()
    {
        return self::$pageType ?: (self::$pageType = new PageType());
    }
    
    /**
     * @return \Wearenext\CMS\GraphQL\Type\QueryType
     */
    public static function queryType()
    {
        return self::$queryType ?: (self::$queryType = new QueryType());
    }
    
    /**
     * @return \Wearenext\CMS\GraphQL\Type\Url
     */
    public static function url()
    {
        return self::$url ?: (self::$url = new Url());
    }
    
    /**
     * @return \GraphQL\Type\Definition\BooleanType
     */
    public static function boolean()
    {
        return Type::boolean();
    }

    /**
     * @return \GraphQL\Type\Definition\FloatType
     */
    public static function float()
    {
        return Type::float();
    }

    /**
     * @return \GraphQL\Type\Definition\IDType
     */
    public static function id()
    {
        return Type::id();
    }

    /**
     * @return \GraphQL\Type\Definition\IntType
     */
    public static function int()
    {
        return Type::int();
    }

    /**
     * @return \GraphQL\Type\Definition\StringType
     */
    public static function string()
    {
        return Type::string();
    }

    /**
     * @param \GraphQL\Type\Definition\Type|\GraphQL\Type\DefinitionContainer $type
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public static function listOf($type)
    {
        return new ListOfType($type);
    }

    /**
     * @param \GraphQL\Type\Definition\Type|\GraphQL\Type\DefinitionContainer $type
     * @return \GraphQL\Type\Definition\NonNull
     */
    public static function nonNull($type)
    {
        return new NonNull($type);
    }
}
