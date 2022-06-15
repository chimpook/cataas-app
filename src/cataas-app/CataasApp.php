<?php

/**
 * An example application which gets a cat from cataas.com
 * and applies a filter chosen by a day of the week
 */
class CataasApp
{
    protected Cataas $cataas;

    protected string $filename = 'images' . DIRECTORY_SEPARATOR . 'examplecat.png';

    protected $filterRules = [
        'Sunday' => null,
        'Monday' => 'blur',
        'Tuesday' => 'mono',
        'Wednesday' => 'sepia',
        'Thursday' => 'negative',
        'Friday' => 'paint',
        'Saturday' => 'pixel',
    ];

    public function __construct(Cataas $cataas)
    {
        $this->cataas = $cataas;
    }

    public static function factory(Cataas $cataas)
    {
        return new static($cataas);
    }

    protected function isItTimeToRefresh(int $seconds = 60)
    {
        if (!file_exists($this->filename)) {
            return true;
        }

        $time_passed = microtime(true) - filemtime($this->filename);
        return $time_passed > $seconds;
    }

    protected function getFilter(DateTime $date): string
    {
        return $this->filterRules[$date->format("l")];
    }

    protected function getFilePath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . $this->filename;
    }

    public function exec(DateTime $date = new DateTime())
    {
        try {
            // cataas.com service hangs up sometimes while getting too many requests
            // so it is definitely a good idea to limit frequency of requests to one per minute
            if ($this->isItTimeToRefresh()) {
                $this->cataas->filter($this->getFilter($date))->get($this->getFilePath());
            }
            $this->output();
        } catch (Exception $e) {
            echo $e;
        }
    }

    protected function output()
    {
        echo <<<HTML
        <img src="{$this->filename}"/>
        HTML;
    }
}