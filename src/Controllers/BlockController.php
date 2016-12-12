<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;
use Wearenext\CMS\Requests\Block\BlockRequest;
use Wearenext\CMS\Models\Page;
use Wearenext\CMS\Models\Block;
use ErrorException;
use DB;

class BlockController extends BaseController
{
    /*
     * Generic Block methods
     */

    public function index(BlockRequest $request, $type, $page)
    {
        return view('cms::block.index')
            ->with('type', $type)
            ->with('page', $page)
            ->with('blocks', $page->getBlockGenerator());
    }
    
    public function update(BlockRequest $request, $type, $page)
    {
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
}
