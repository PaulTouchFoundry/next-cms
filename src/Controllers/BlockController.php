<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;
use Wearenext\CMS\Models\Page;
use Wearenext\CMS\Models\Block;
use Wearenext\CMS\Models\Media;
use ErrorException;
use DB;

class BlockController extends BaseController
{
    /*
     * Generic Block methods
     */

    public function index(Request $request, $type, $page)
    {
        $blockCount = count($type->blocks);
        if ($blockCount == 1 || ($blockCount == 0 && $type->callout)) {
            return redirect()
                ->to($this->getDirectBlockUrl($type, $page));
        }
        
        $this->validate($request, [
            'blocks' => 'array',
        ]);
        
        return view('cms::block.index')
            ->with('type', $type)
            ->with('page', $page)
            ->with('blocks', $page->getBlockGenerator());
    }
    
    public function update(Request $request, $type, $page)
    {
        $this->validate($request, [
            'blocks' => 'array',
        ]);
        
        $blocks = $request->get('blocks', []);

        if (count($blocks) > 0) {
            $this->placeBlocks($blocks, $page);
        }

        return redirect()
            ->to($page->blockUrl());
    }

    public function editBlock($block)
    {
        $page = $block->page;
        $type = $page->type;

        return view("cms::block.{$block->block_type}_block.edit")
            ->with('type', $type)
            ->with('page', $page)
            ->with('block', $block);
    }

    public function updateBlock(Request $request, $block)
    {
        switch ($block->block_type) {
            case Block::TYPE_TEXT:
                return $this->updateTextBlock($request, $block);
            case Block::TYPE_ICON:
                return $this->updateIconListBlock($request, $block);
            case Block::TYPE_MEDIA:
                return $this->updateMediaBlock($request, $block);
            case Block::TYPE_EMBED:
                return $this->updateEmbedBlock($request, $block);
            default:
                throw new ErrorException("Updating block type '{$block->block_type}' is not possible");
        }
    }

    public function deleteBlock($block)
    {
        $page = $block->page;
        $block->delete();

        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::block.messages.deleted', ['name' => $block->title,]) ] ]);
    }

    protected function appendBlockPage(Page $page, Block $block)
    {
        // Check if page has starting block
        if (is_null($page->block)) {
            // If not then assign this block and return out
            $page->block()->associate($block);
            $page->save();
            return;
        }

        // Fetch last block
        $lastBlock = $page
            ->blocks()
            ->where('id', '!=', $block->id)
            ->whereNull('next_block_id')
            ->whereNull('deleted_at')
            ->firstOrFail();

        // Attach next block effectively appending the passed Block to the page
        $lastBlock->block()->associate($block);
        $lastBlock->save();
    }

    protected function placeBlocks(array $blockIDs, Page $page)
    {
        DB::transaction(function () use ($blockIDs, $page) {
            // Extract block IDs from request
            $blocks = collect(array_values($blockIDs))->reverse();

            // Apply starting block
            Block::findOrFail($blocks->last())->startingPage()->save($page);

            $nextBlock = null;
            // Assign next block ids of each entry
            foreach ($blocks as $id) {
                $block = Block::findOrFail($id);
                $block->next_block_id = $nextBlock;
                // Save instance
                $block->save();
                // Set the block for next iteration
                $nextBlock = $block->id;
            }
        });
    }

    /*
     * Text Block methods
     */

    public function createTextBlock($type, $page)
    {
        return view('cms::block.text_block.create')
            ->with('type', $type)
            ->with('page', $page);
    }

    public function saveTextBlock(Request $request, $type, $page)
    {
        $this->validate($request, [
            'title' => 'required_with:quicklink',
        ]);
        
        if ($this->hasBlockQuota($type, $page)) {
            return redirect()
                ->to($page->blockUrl())
                ->withErrors([ 'success' => [ trans('cms::block.messages.block_quota') ] ]);
        }

        $attributes = $request->all();

        $attributes['block_type'] = Block::TYPE_TEXT;

        $block = $page->blocks()->create($attributes);

        $this->appendBlockPage($page, $block);

        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::block.messages.text_block_saved') ] ]);
    }

    protected function updateTextBlock(Request $request, $block)
    {
        $this->validate($request, [
            'title' => 'required_with:quicklink',
        ]);

        $block->fill($request->all());
        $block->save();

        return back()
            ->withErrors([ 'success' => [ trans('cms::block.messages.text_block_updated') ] ]);
    }

    /*
     * Icon List Block methods
     */

    public function createIconListBlock($type, $page)
    {
        return view('cms::block.icon_list_block.create')
            ->with('type', $type)
            ->with('page', $page);
    }

    public function saveIconListBlock(Request $request, $type, $page)
    {
        if ($this->hasBlockQuota($type, $page)) {
            return redirect()
                ->to($page->blockUrl())
                ->withErrors([ 'success' => [ trans('cms::block.messages.block_quota') ] ]);
        }

        $attributes = $request->all();

        $attributes['block_type'] = Block::TYPE_ICON;

        $block = $page->blocks()->create($attributes);

        $this->appendBlockPage($page, $block);

        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::block.messages.icon_list_block_saved') ] ]);
    }

    protected function updateIconListBlock(Request $request, $block)
    {
        $block->fill($request->all());
        $block->save();

        return back()
            ->withErrors([ 'success' => [ trans('cms::block.messages.icon_list_block_updated') ] ]);
    }

    /*
     * Media Block methods
     */

    public function createMediaBlock($type, $page)
    {
        return view('cms::block.media_block.create')
            ->with('type', $type)
            ->with('page', $page);
    }

    public function saveMediaBlock(Request $request, $type, $page)
    {
        if ($this->hasBlockQuota($type, $page)) {
            return redirect()
                ->to($page->blockUrl())
                ->withErrors([ 'success' => [ trans('cms::block.messages.block_quota') ] ]);
        }

        $attributes = $request->all();

        $attributes['block_type'] = Block::TYPE_MEDIA;

        $block = $page->blocks()->create($attributes);
        
        $block->media()->detach();
        $block->media()->attach(Media::findOrFail($attributes['media_id']));

        $this->appendBlockPage($page, $block);

        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::block.messages.media_block_saved') ] ]);
    }

    protected function updateMediaBlock(Request $request, $block)
    {
        $block->fill($request->all());
        
        $block->media()->detach();
        
        $block->media()->attach(Media::findOrFail($request->get('media_id')));
        
        $block->save();
        
        return back()
            ->withErrors([ 'success' => [ trans('cms::block.messages.media_block_updated') ] ]);
    }

    /*
     * HTML Block methods
     */

    public function createEmbedBlock($type, $page)
    {
        return view('cms::block.embed_block.create')
            ->with('type', $type)
            ->with('page', $page);
    }

    public function saveEmbedBlock(Request $request, $type, $page)
    {
        if ($this->hasBlockQuota($type, $page)) {
            return redirect()
                ->to($page->blockUrl())
                ->withErrors([ 'success' => [ trans('cms::block.messages.block_quota') ] ]);
        }

        $attributes = $request->all();

        $attributes['block_type'] = Block::TYPE_EMBED;

        $block = $page->blocks()->create($attributes);

        $this->appendBlockPage($page, $block);

        return redirect()
            ->to($page->blockUrl())
            ->withErrors([ 'success' => [ trans('cms::block.messages.embed_block_saved') ] ]);
    }

    protected function updateEmbedBlock(Request $request, $block)
    {
        $block->fill($request->all());

        $block->save();

        return back()
            ->withErrors([ 'success' => [ trans('cms::block.messages.embed_block_updated') ] ]);
    }
    
    protected function hasBlockQuota($type, $page)
    {
        if (!$type->block_quota) {
            return false;
        }
        
        if ($type->block_quota <= $page->blocks()->count()) {
            return true;
        }
        
        return false;
    }
    
    protected function getDirectBlockUrl($type, $page)
    {
        $t = array_get(array_keys($type->blocks), '0');
        
        // Callouts
        if (!$t) {
            $callout = $page->callouts()->first();
            if ($callout) {
                return route('cms.callout.edit', ['cmsType' => $type->slug, 'cmsPage' => $page, 'cmsCallout' => $callout,]);
            }
            
            return route('cms.callout.create', ['cmsType' => $type->slug, 'cmsPage' => $page,]);
        }
        
        // Blocks
        $block = $page->blocks()->first();
        if ($block) {
            return route('cms.block.edit_block', ['cmsBlock' => $block,]);
        }
        
        return route("cms.block.create_{$t}_block", ['cmsType' => $type->slug, 'cmsPage' => $page,]);
    }
}
