<?php

namespace Wearenext\CMS\Support\Html;

use Illuminate\Pagination\BootstrapThreePresenter;

class PaginationLinks extends BootstrapThreePresenter
{

    /**
     * Returns a wrapper for the active link
     * @param  String $text Text to wrap
     * @return
     */
    public function getActivePageWrapper($text)
    {
        return '<li class="is-active"><a href="#">'.$text.'</a></li>';
    }

    /**
     * Returns a wrapper for a disabled link
     * @param  String $text Text to wrap
     * @return
     */
    public function getDisabledTextWrapper($text)
    {
        return '<li class="is-disabled"><a href="#">'.$text.'</a></li>';
    }

    /**
     * Returns a wrapper for available link
     * @param  String $text Text to wrap
     * @return
     */
    public function getAvailablePageWrapper($url, $page, $rel = null)
    {
        return '<li><a href="'.$url.'"'.$rel.'>'.$page.'</a></li>';
    }

    /**
     * Renders the pagination for the set of objects
     * @return
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '%s %s %s',
                $this->getPreviousButton(trans('pagination.first')),
                $this->getLinks(),
                $this->getNextButton(trans('pagination.last'))
            );
        }

        return '';
    }
}
