<?php


class PageTypeTest extends BaseTest
{
    public function testView()
    {
        $this->actingAs(new \Wearenext\CMS\Models\User(['cms_role' => 'admin']))
             ->visit('/admin/pagetype')
             ->see('Page Types');
    }
    
    public function testCreate()
    {
        $this->actingAs(new \Wearenext\CMS\Models\User(['cms_role' => 'admin']))
            ->visit('/admin/pagetype/create')
            ->see('cms::pagetype.create.header')
            ->see('cms::pagetype.fields.label.label')
            ->type('Test', 'label')
            ->see('cms::pagetype.fields.slug.label')
            ->type('test', 'slug')
            ->press('cms::pagetype.controls.save')
            ->seePageIs('/admin/pagetype');
    }
}
