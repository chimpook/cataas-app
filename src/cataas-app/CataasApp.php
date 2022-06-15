<?php

/**
 * An example application which gets a cat from cataas.com
 * and applies a filter chosen by a day of the week
 */
class CataasApp
{
    protected Cataas $cataas;

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

    protected function getFilter(DateTime $date): string
    {
        return $this->filterRules[$date->format("l")];
    }

    public function exec(DateTime $date = new DateTime())
    {
        try {
            echo $this->cataas->filter($this->getFilter($date))->getUrl();
        } catch (Exception $e) {
            echo $e;
        }
    }
}