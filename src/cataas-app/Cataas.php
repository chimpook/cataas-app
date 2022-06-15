<?php

class Cataas
{
    protected string $cataas_url = "https://cataas.com";
    protected string $cataas_path = "/cat";
    protected array $commands = [];
    protected array $parameters = [];
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

    public function json(): Cataas
    {
        $this->parameters['json'] = 'true';
        return $this;
    }

    public function html(): Cataas
    {
        $this->parameters['html'] = 'true';
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

    protected function build_file_path(): string
    {
        $ext = $this->build_file_ext();
        $file_path = __DIR__ . '/cat.' . $ext;

        return $file_path;
    }

    protected function build_file_ext(): string
    {
        if (isset($this->commands['gif'])) {
            $file_ext = 'gif';
        } else if (isset($this->parameters['json'])) {
            $file_ext = 'json';
        } else if (isset($this->parameters['html'])) {
            $file_ext = 'html';
        } else {
            $file_ext = 'png';
        }
        return $file_ext;
    }

    public function get(string $custom_file_path = null)
    {
        $file_path = $custom_file_path ?? $this->build_file_path();
        $url = $this->getUrl();
        $ch = curl_init();
        $fp = fopen($file_path, 'wb');
        if ( !$fp ) {
            throw new Exception('Cat does not fit here (Cannot open file for writing).');
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        fclose($fp);
        if (isset($error_msg)) {
            throw new Exception('Cat not found (Cannot load the file from cataas service): ' . $error_msg);
        }
    }

    public function getUrl()
    {
        $this->build_cataas_path();
        return $this->cataas_url . $this->cataas_path;
    }
}
