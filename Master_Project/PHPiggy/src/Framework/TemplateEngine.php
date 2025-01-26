<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    public function __construct(private string $basePath)
    {
    }

    public function render(string $template, array $data = [])
    {
        //Extraction works for assosiative array - constants skip duplicate variables
        extract($data, EXTR_SKIP);

        //to include the buffer after enabling the output_buffering feature in php.ini - prevents php to send contents directly to the browser until all of the php code has finished execution or buffer is closed
        ob_start();

        include $this->resolve($template);

        //content from the active buffer is returned as a string
        $output = ob_get_contents();

        //output buffer memory wiped and stops output buffering - php outputs to browser directly 
        ob_end_clean();

        return $output;
    }

    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }
}
