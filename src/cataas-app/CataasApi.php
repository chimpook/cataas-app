<?php

class CataasApi
{
    protected string $cataas_url = "https://cataas.com";
    protected string $cataas_path = "/cat";
    protected string $file_path = '';
    protected $tags = '';

    public function __construct()
    {

    }

    public function setTags(string $tags): CataasApi
    {
        $this->tags = $tags;
        return $this;
    }

    public function getTags(): string
    {
        return '';
    }

    public function getCats(): string
    {
        return '';
    }

}
