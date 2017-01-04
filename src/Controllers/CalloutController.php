<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;

class CalloutController extends BaseController
{
    public function create($type, $page)
    {
        return view('cms::callout.create')
            ->with('type', $type)
            ->with('page', $page);
    }
    
    public function save(Request $request, $type, $page)
    {
        $page->callouts()->create($this->calloutAttributes($request->all()));
        
        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::callout.messages.saved') ] ]);
    }
    
    public function edit($type, $page, $callout)
    {
        return view('cms::callout.edit')
            ->with('type', $type)
            ->with('page', $page)
            ->with('callout', $callout);
    }
    
    public function update(Request $request, $type, $page, $callout)
    {
        $callout->large_heading = null;
        $callout->small_heading = null;
        $callout->text = null;
        $callout->list = null;
        $callout->quote = null;
        $callout->button = null;
        $callout->url = null;
        
        $callout->fill($this->calloutAttributes($request->all()));
        
        $callout->save();
        
        return back()
            ->withErrors([ 'success' => [ trans('cms::callout.messages.updated') ] ]);
    }
    
    public function delete($type, $page, $callout)
    {
        $callout->delete();
        
        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::callout.messages.deleted') ] ]);
    }
    
    protected function calloutAttributes($attributes)
    {
        $used = [
            'block_id' => array_get($attributes, 'block_id'),
        ];
        
        foreach (array_get($attributes, 'uses', []) as $key) {
            $used[$key] = array_get($attributes, $key);
        }
        
        if (isset($used['button'])) {
            $used['url'] = array_get($attributes, 'url');
        }
        
        return $used;
    }
}
