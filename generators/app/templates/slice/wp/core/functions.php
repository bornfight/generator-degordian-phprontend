<?php

# region Helpers

/**
 * @param      $fileName
 * @param null $data
 *
 * @return string
 * @throws Exception
 */
function renderRootFile($fileName, $data = null)
{
    $fileName = SLICE_ROOT . _sanitizeFileName($fileName) . '.php';
    
    if (file_exists($fileName) && is_readable($fileName)) {
        
        if ($data !== null) {
            extract($data, EXTR_OVERWRITE);
        }
        
        ob_start();
        ob_implicit_flush(false);
        
        require $fileName;
        
        return ob_get_clean();
    }
    
    throw new Exception('Missing file : ' . $fileName);
}

/**
 * @param $name
 *
 * @return string
 */
function _sanitizeFileName($name)
{
    return ltrim($name, '/');
}

# endregion

# region WP Like functions

/**
 * @param null $name
 *
 * @throws Exception
 */
function get_header($name = null)
{
    $fileName = 'header';
    
    if ($name !== null) {
        $fileName = $fileName . '-' . $name;
    }
    
    echo renderRootFile($fileName);
}

/**
 * @param null $name
 *
 * @throws Exception
 */
function get_footer($name = null)
{
    $fileName = 'footer';
    
    if ($name !== null) {
        $fileName = $fileName . '-' . $name;
    }
    
    echo renderRootFile($fileName);
}

/**
 *
 */
function wp_head()
{
    // nothing for now;
}

/**
 * @throws Exception
 */
function wp_footer()
{
    _defineInternalStaticPath();
    
    $homeUrl = get_home_url();
    $js = <<<JS
    
    var dwpSliceThemeHome = '$homeUrl';

function goHome(blank) {
    var isBlank = blank || false;
    
    if(isBlank === true) {
        window.open(dwpSliceThemeHome);
    } else {
        window.location = dwpSliceThemeHome;
    }
}

JS;
    echo '<script>' . $js . '</script>';
}

/**
 * @return mixed
 * @throws Exception
 */
function get_home_url()
{
    _defineInternalStaticPath();
    
    $chunks = explode('wp-content', INTERNAL_STATIC_PATH);
    
    return $chunks[0];
}

# endregion

# region Degordian function

/**
 * @param string $url
 *
 * @return string
 * @throws Exception
 */
function bu($url = '')
{
    _defineInternalStaticPath();
    
    return INTERNAL_STATIC_PATH . _sanitizeFileName($url);
}

/**
 * @throws Exception
 */
function _defineInternalStaticPath()
{
    if (defined('INTERNAL_STATIC_PATH')) {
        return;
    }
    
    $uriChunks = explode('slice', $_SERVER['REQUEST_URI']);
    
    if (count($uriChunks) !== 2) {
        throw new Exception('Invalid uri chunks length');
    }
    
    $internalStaticPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $uriChunks[0] . STATIC_DIR . '/';
    
    define('INTERNAL_STATIC_PATH', $internalStaticPath);
}


/**
 * @param      $partial
 * @param null $data
 * @param bool $return
 *
 * @return string
 * @throws Exception
 */
function get_partial($partial, $data = null, $return = false)
{
    $partial = PARTIALS_DIR . '/' . _sanitizeFileName($partial);
    
    $content = renderRootFile($partial, $data);
    
    if ($return === true) {
        return $content;
    }
    
    echo $content;
}

# endregion

/**
 * @param $baseDir
 * @param $dirname
 * @return string
 */
function getPageDir($baseDir, $dirname)
{
    return str_replace('/', '', str_replace($baseDir, '', $dirname));
}

/**
 * @param $filePath
 * @return string
 */
function getPageName($filePath)
{
    $chunks = explode('/', $filePath);

    return ucwords(str_replace('.php', '', end($chunks)));
}

/**
 * @param $dirName
 * @return array
 */
function getFirstLevelPages($dirName)
{
    return glob(rtrim($dirName, '/') . '/*.php');
}

/**
 * @param $filePath
 * @return string
 */
function getPageUrl($filePath)
{
    return 'pages/' . str_replace(__DIR__, '', $filePath);
}


