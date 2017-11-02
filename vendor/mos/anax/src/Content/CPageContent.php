<?php

namespace Anax\Content;

/**
 * Pages based on file content.
 */
class CPageContent
{
    use \Anax\TConfigure,
        \Anax\DI\TInjectionAware;



    /**
     * Properties.
     */
    private $toc = null;



    /**
     * Map url to page if such mapping can be done.
     *
     * @throws NotFoundException when mapping can not be done.
     */
    public function getContentForRoute()
    {
        $route = $this->di->request->getRoute();
        $parts = $this->di->request->getRouteParts();
        $toc   = $this->getTableOfContent($parts[0]);

        $route = $this->mapRoute2Toc($route, $toc);
        $baseroute = dirname($route);

        $filter = $this->config['textfilter'];
        $title  = $toc[$route]['title'];
        $file   = $toc[$route]['filename'];

        //$content = $this->di->fileContent->get($baseroute . '/' . $file);
        $basepath = $this->config['basepath'];
        $target = "$basepath/$baseroute/$file";
        $content = file_get_contents($target);
        $content = $this->di->textFilter->doFilter($content, $filter);

        return [$title, $content, $toc];
    }



    /**
     * Map the route to the correct entry in the toc.
     *
     * @param string $route current route used to access page.
     * @param array  $toc   the toc as array.
     *
     * @return string as the title for the content.
     */
    public function mapRoute2Toc($route, $toc)
    {
        if (key_exists($route, $toc)) {
            return $route;
        } elseif (key_exists($route . "/index", $toc)) {
            return $route . "/index";
        }

        throw new \Anax\Exception\NotFoundException(t('The page does not exists.'));
    }



    /**
     * Extract title from content.
     *
     * @param string $file filenam to load load content from.
     *
     * @return string as the title for the content.
     */
    public function getTitleFromFirstLine($file)
    {
        $content = file_get_contents($file, false, null, -1, 512);
        $title = strstr($content, "\n", true);

        return $title;
    }



    /**
     * Get table of content for all pages.
     *
     * @param string $id to use to generate key for toc.
     *
     * @return array as table of content.
     */
    public function getTableOfContent($id)
    {
        if ($this->toc) {
            return $this->toc;
        }

        $key = $this->di->cache->createKey(__CLASS__, 'toc-' . $id);
        $this->toc = $this->di->cache->get($key);

        if (!$this->toc) {
            $this->toc = $this->createTableOfContent();
            $this->di->cache->put($key, $this->toc);
        }

        return $this->toc;
    }



    /**
     * Generate ToC from directory structure, containing url, title and filename
     * of each page.
     *
     * @return array as table of content.
     */
    public function createTableOfContent()
    {
        $basepath   = $this->config['basepath'];
        $pattern    = $this->config['pattern'];
        $route      = $this->di->request->getRoute();

        // if dir, add index if file exists.
        // partly for adding doc/index to work
        // partly to make doc/ generate proper toc.
        $baseroute  = dirname($route);
        $path       = $basepath . '/' . $baseroute . '/' . $pattern;

        $toc = [];
        foreach (glob($path) as $file) {
            $parts    = pathinfo($file);
            $filename = $parts['filename'];

            $title = $this->getTitleFromFirstLine($file);
            $file2route = substr($filename, strpos($filename, '_') + 1);

            $url = $baseroute . '/' . $file2route;
            /*
            if ($file2route == 'index' ) {
                $url = $baseroute;
            }*/

            // Create level depending on the file id
            $id = substr($filename, 0, strpos($filename, '_'));
            $level = 2;
            if ($id % 100 === 0) {
                $level = 0;
            } elseif ($id % 10 === 0) {
                $level = 1;
            }

            $toc[$url] = [
                'title'     => $title,
                'filename'  => $parts['basename'],
                'level'     => $level,
            ];
        }

        return $toc;
    }
}
