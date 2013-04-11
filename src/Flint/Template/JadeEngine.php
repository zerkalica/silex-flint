<?php
namespace Flint\Template;

use Jade\Compiler;
use Jade\Parser;

class JadeEngine implements TemplateEngineInterface
{
    protected $prettyPrint;
    protected $cachePath;
    protected $templatesFile;
    protected $directories;
    protected $ext = 'jade';
    protected $cacheData;

    public function __construct($cachePath, array $directories, $prettyPrint = true)
    {
        $this->cachePath = $cachePath;
        $this->directories = $directories;
        $this->templatesFile = $cachePath . DIRECTORY_SEPARATOR . 'templates.php';
        $this->prettyPrint = $prettyPrint;
    }

    public function render($template, array $data = array())
    {
        if (!$this->cacheData) {
            if (!file_exists($this->templatesFile)) {
                $this->cache();
            }
            $this->cacheData = include($this->templatesFile);
        }

        ob_start();
        $this->cacheData[$template]($data);
        return ob_get_clean();
    }

    protected function compile($input)
    {
        $parser = new Parser($input);
        $compiler = new Compiler($this->prettyPrint);

        return $compiler->compile($parser->parse($input));
    }

    public function cache()
    {
        $dir = dirname($this->templatesFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $content = '';
        foreach ($this->directories as $path) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
                /* @var $file \SplFileInfo */
                if ($file->isFile() && $file->getExtension() === $this->ext) {
                    $prefix = substr($file->getPath(), strlen($path));
                    if ($prefix) {
                        $prefix .= DIRECTORY_SEPARATOR;
                    }
                    $key = str_replace('\\', '/', $prefix . substr($file->getFilename(), 0, -strlen($file->getExtension()) - 1));
                    if ($key[0] === DIRECTORY_SEPARATOR) {
                        $key = substr($key, 1);
                    }
                    $content .= PHP_EOL
                        . '\'' . $key . '\' => function($data) { extract($data); ?>'
                        . PHP_EOL . $this->compile($file->getPathname())
                        . PHP_EOL . '<?php },';
                }
            }
        }

        $content ='<?php return array(' . $content . ');?>';

        file_put_contents($this->templatesFile, $content);
    }
}
