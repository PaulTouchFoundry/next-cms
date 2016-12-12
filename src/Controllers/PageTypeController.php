<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;
use Wearenext\CMS\Models\PageType;
use Wearenext\CMS\Support\Html\Form;
use Wearenext\CMS\Requests\PageTypeRequest;

class PageTypeController extends BaseController
{
    public function view(Request $request)
    {
        $this->authorize('cms.pagetype_index');
        
        $query = PageType::query();
        if (!empty($searchQuery = $request->get('q', ''))) {
            $query->where('label', 'LIKE', "%{$searchQuery}%");
        }
        return view('cms::pagetype.view')
            ->with('pageTypes', $query->paginate());
    }
    
    public function create(Request $request)
    {
        $this->authorize('cms.pagetype_create');
        
        $form = new Form;
        return view('cms::pagetype.create')
            ->with('form', $form);
    }
    
    public function edit(Request $request, $pageType)
    {
        $this->authorize('cms.pagetype_edit');
        
        $form = new Form($pageType->toArray());
        return view('cms::pagetype.edit')
            ->with('pageType', $pageType)
            ->with('form', $form);
    }
    
    public function save(PageTypeRequest $request)
    {
        $this->authorize('cms.pagetype_save');
        
        $pageType = PageType::create($request->all());
        return redirect()
            ->to($pageType->viewUrl())
            ->withErrors([ 'success' => [ trans('cms::pagetype.messages.created') ] ]);
    }
    
    public function update(PageTypeRequest $request, $pageType)
    {
        $this->authorize('cms.pagetype_edit');
        
        $attributes = $request->all();
        $attributes['features'] = array_get($attributes, 'features', []);
        $attributes['fields'] = array_get($attributes, 'fields', []);
        $pageType->fill($attributes);
        $pageType->save();
        return redirect()
            ->to($pageType->viewUrl())
            ->withErrors([ 'success' => [ trans('cms::pagetype.messages.updated') ] ]);
    }
    
    public function delete(Request $request, $pageType)
    {
        $this->authorize('cms.pagetype_delete');
        
        $pageType->delete();
        return redirect()
            ->route('cms.pagetype.view')
            ->withErrors([ 'success' => [ trans('cms::pagetype.messages.updated') ] ]);
    }
}
