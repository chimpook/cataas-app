<?php

class Cataas
{
    protected string $cataas_url = "https://cataas.com";
    protected string $cataas_path = "/cat";
    protected const MODE_IMAGE = 0;
    protected const MODE_JSON = 1;
    protected const MODE_HTML = 2;
    protected const MODE_URL = 3;
    protected array $commands = [];
    protected array $parameters = [];
    protected int $mode = self::MODE_JSON;
    protected string $file_name = 'cat';
    protected string $file_extension = 'png';
    protected string $file_path = '';

    public function __construct()
    {

    }

    public function tag(string $tag): Cataas
    {
        $this->commands['tag'] = $tag;
        return $this;
    }

    public function gif(): Cataas
    {
        $this->commands['gif'] = true;
        return $this;
    }

    public function says(string $text): Cataas
    {
        $this->commands['says'] = $text;
        return $this;
    }

    public function size(int $size): Cataas
    {
        $this->parameters['size'] = $size;
        return $this;
    }

    public function color(string $color): Cataas
    {
        $this->parameters['color'] = $color;
        return $this;
    }

    public function type(string $type): Cataas
    {
        $this->parameters['type'] = $type;
        return $this;
    }

    public function filter(string $filter): Cataas
    {
        $this->parameters['filter'] = $filter;
        return $this;
    }

    public function width(int $width): Cataas
    {
        $this->parameters['width'] = $width;
        return $this;
    }

    public function height(int $height): Cataas
    {
        $this->parameters['height'] = $height;
        return $this;
    }

    public function image(string $image_path = null): Cataas
    {
        $this->mode = self::MODE_IMAGE;

        if (!empty($image_path)) {
            $ext = pathinfo($image_path, PATHINFO_EXTENSION);
        }

        $ext = 
        $this->image_path = $image_path;
        
        return $this;
    }

    public function json(): Cataas
    {
        $this->mode = self::MODE_JSON;
        return $this;
    }

    public function html(): Cataas
    {
        $this->mode = self::MODE_HTML;
        return $this;
    }

    public function url(): Cataas
    {
        $this->mode = self::MODE_URL;
        return $this;
    }

    protected function build_cataas_path()
    {
        $this->cataas_path .= !empty($this->commands['tag']) ? '/' . $this->commands['tag'] : '';
        $this->cataas_path .= !empty($this->commands['gif']) ? '/gif' : '';
        $this->cataas_path .= !empty($this->commands['says']) ? '/says/' . $this->commands['says'] : '';
        if (empty($this->parameters)) {
            return;
        }
        $this->cataas_path .= '?';
        $parameters = [];
        foreach ($this->parameters as $key => $value) {
            $parameters[] = $key . '=' . $value;
        }
        $this->cataas_path .= implode('&', $parameters);
    }

    public function get(string $file_path = null)
    {
        $url = $this->getUrl();
        $ch = curl_init($url);
        $fp = fopen($file_path, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    public function getUrl()
    {
        $this->build_cataas_path();
        return $this->cataas_url . $this->cataas_path;
    }
}
