<?php
namespace Framework;

class Template
{
    protected $data;

    /**
     * @param $data
     * @return $this
     */
    public function assign($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param $filePath
     */
    public function render($filePath)
    {
        extract($this->data);
        require TEMPLATE_ROOT.$filePath;
    }

    /**
     * @param $filePath
     */
    public function renderOnlyFile($filePath)
    {
        require TEMPLATE_ROOT.$filePath;
    }
}
