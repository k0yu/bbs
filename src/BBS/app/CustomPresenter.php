<?php

namespace App;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\BootstrapThreeNextPreviousButtonRendererTrait;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Pagination\UrlWindowPresenterTrait;

class CustomPresenter implements Presenter
{
    use BootstrapThreeNextPreviousButtonRendererTrait, UrlWindowPresenterTrait;

    private $paginator;

    private $window;

    public function __construct(Paginator $paginator, UrlWindow $window = null)
    {
        $this->paginator = $paginator;
        $this->window = is_null($window) ? UrlWindow::make($paginator) : $window->get();
    }

    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="pagination">%s %s %s</ul>',
                $this->getPreviousButton("<"),
                $this->getLinks(),
                $this->getNextButton(">")
            );
        }

        return null;
    }

    public function hasPages()
    {
        return $this->paginator->hasPages() && count($this->paginator->items() !== 0);
    }

    protected function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>'.$text.'</span></li>';
    }

    protected function getActivePageWrapper($text)
    {
        return '<li class="active"><span>'.$text.'</span></li>';
    }

    protected function getDots()
    {
        return $this->getDisabledTextWrapper("...");
    }

    protected function currentPage()
    {
        return $this->paginator->currentPage();
    }

    protected function lastPage()
    {
        return $this->paginator->lastPage();
    }

    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<li><a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a></li>';
    }
}