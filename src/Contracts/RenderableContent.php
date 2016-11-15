<?php

namespace Wearenext\CMS\Contracts;

interface RenderableContent
{
    public function getRenderPageModel();
    public function getRenderBlockCollection();
    public function getRenderMediaCollection();
    public function getFeatureCollection();
}
