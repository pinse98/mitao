<?php namespace App\Services;

use Illuminate\Routing\UrlGenerator;

class BackUrlMsg
{

    protected $generator;

    protected $backUrl;

    protected $msg;

    public function __construct(UrlGenerator $generator)
    {
        $this->generator = $generator;
    }

    private function initPrevUrl()
    {
        $this->backUrl = explode('?', $this->generator->previous())[0];
    }

    public function getBack()
    {
        $this->initPrevUrl();
        $ret = null;
        if ($this->backUrl) {
            if ($this->msg) {
                $ret = $this->backUrl . '?msg=' . $this->msg;
            } else {
                $ret = $this->backUrl;
            }
        }
        return $ret;
    }

    public function setMsg($msg = null)
    {
        if (is_string($msg)) {
            $this->msg = $msg;
        }
    }
}