<?php

namespace Anax;

/**
 * Trait implementing reading from config-file and storing options in
 * $this->config.
 *
 */
trait TLoadFile
{
    /**
     * Load config file from ANAX_APP_PATH or ANAX_INSTALL_PATH.
     *
     * @param string $filename to load.
     * @param array  $expose   array with variables to expose to included file,
     *                         defaults to an empty array.
     *
     * @throws Exception when $filename is not found.
     *
     * @return mixed from returned value in required file.
     */
    public function loadFile($filename, $expose = [])
    {
        $anaxInstallPath = ANAX_INSTALL_PATH . "/config/$filename";
        $anaxAppPath = ANAX_APP_PATH . "/config/$filename";
        extract($expose);

        if (is_readable($anaxAppPath)) {
            return require $anaxAppPath;
        } elseif (is_readable($anaxInstallPath)) {
            return require $anaxInstallPath;
        }

        throw new Exception("Configure item '$filename' is not a readable file.");
    }
}
