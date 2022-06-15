<?php

class Cataas
{
    protected const CATAAS_URL = "https://cataas.com";
    protected string $cataas_path = "";
    protected string $mode = 'cat';
    protected array $commands = [];
    protected array $parameters = [];

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

    public function api(): Cataas
    {
        $this->mode = 'api';
        return $this;
    }

    public function says(string $text): Cataas
    {
        $this->commands['says'] = $text;
        return $this;
    }

    public function cats(): Cataas
    {
        $this->commands['cats'] = true;
        return $this;
    }

    public function tags(string $tags = null): Cataas
    {
        if (!empty($this->commands['cats'])) {
            $this->parameters['tags'] = $tags;    
        } else {
            $this->commands['tags'] = true;
        }
        
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

    public function skip(int $number = 0): Cataas
    {
        $this->parameters['skip'] = $number;
        return $this;
    }

    public function limit(int $number): Cataas
    {
        $this->parameters['limit'] = $number;
        return $this;
    }

    protected function build_cataas_path()
    {
        $this->cataas_path = DIRECTORY_SEPARATOR . $this->mode;
        $this->cataas_path .= !empty($this->commands['tags']) ? '/tags' : '';
        $this->cataas_path .= !empty($this->commands['cats']) ? '/cats' : '';
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

    protected function build_file_ext(): string
    {
        if (isset($this->commands['gif'])) {
            $file_ext = 'gif';
        } else if (isset($this->parameters['json']) || $this->mode === 'api') {
            $file_ext = 'json';
        } else if (isset($this->parameters['html'])) {
            $file_ext = 'html';
        } else {
            $file_ext = 'png';
        }
        return $file_ext;
    }

    public function get(string $file_path = null)
    {
        $url = $this->getUrl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        if (empty($file_path)) {
            curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $data) {
                echo $data;
                return strlen($data);
            });
        } else {
            $fp = fopen($file_path, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
        }

        curl_exec($ch);
        $error_msg = curl_errno($ch) ?? null;
        curl_close($ch);

        if (!empty($fp)) {
            fclose($fp);
        }

        if (!empty($error_msg)) {
            throw new Exception('Cat not found (Cannot load the file from the cataas service): ' . $error_msg);
        }
    }

    public function getUrl()
    {
        $this->build_cataas_path();
        return self::CATAAS_URL . $this->cataas_path;
    }

}
