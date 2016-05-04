<?php
/**
 * This file is part of BlueprintAdmin package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 02.05.2016 23:18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Serafim\Blueprint\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AssetsController
 * @package Serafim\Blueprint\Controllers
 */
class AssetsController extends Controller
{
    public function find($file)
    {
        $realPath = $this->getPublicPath($file);

        if (!is_file($realPath)) {
            throw new NotFoundHttpException('File ' . $file . ' not found');
        }

        return new BinaryFileResponse($realPath, 200, [
            'Content-Type' => $this->getHeader($file)
        ]);
    }

    /**
     * @param string $file
     * @return string
     */
    private function getHeader($file)
    {
        $parts = explode('.', $file);
        $ext   = array_pop($parts);

        switch ($ext) {
            case 'css':
                return 'text/css';
            case 'js':
                return 'application/javascript';
        }

        return 'plain/text';
    }

    /**
     * @param string $file
     * @return string
     */
    private function getPublicPath($file)
    {
        $file   = str_replace('..', '.', $file);

        return __DIR__ . '/../../resources/public/' . $file;
    }
}