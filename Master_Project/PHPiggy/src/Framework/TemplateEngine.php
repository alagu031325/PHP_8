<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globalTemplateData = [];

    public function __construct(private string $basePath)
    {
    }

    public function render(string $template, array $data = [])
    {
        //Extraction works for assosiative array - constant EXTR_SKIP is used to skip duplicate variables
        extract($data, EXTR_SKIP);
        //doesnt override the existing variables with extract skip argument
        extract($this->globalTemplateData, EXTR_SKIP);

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

    public function addGlobal(string $key, mixed $value)
    {
        $this->globalTemplateData[$key] = $value;
    }
}
