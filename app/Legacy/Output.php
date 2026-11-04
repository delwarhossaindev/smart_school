<?php

namespace App\Legacy;

class Output
{
    private string $output = '';

    public function get_output()
    {
        return $this->output;
    }

    public function set_output($output)
    {
        $this->output = (string) $output;

        return $this;
    }

    public function append_output($output)
    {
        $this->output .= $output;

        return $this;
    }

    public function set_header($header, $replace = true)
    {
        header($header, $replace);

        return $this;
    }

    public function set_status_header($code = 200, $text = '')
    {
        http_response_code($code);

        return $this;
    }

    public function set_content_type($mime, $charset = null)
    {
        header('Content-Type: '.$mime.($charset ? '; charset='.$charset : ''));

        return $this;
    }

    public function delete_cache($uri = '')
    {
        return true;
    }
}
