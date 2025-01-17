<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use InvalidArgumentException;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use Nette\PhpGenerator\PsrPrinter;

use function array_pop;
use function assert;
use function count;
use function current;
use function dirname;
use function explode;
use function file_put_contents;
use function implode;
use function is_dir;
use function ltrim;
use function mkdir;
use function sprintf;
use function str_replace;
use function str_starts_with;

abstract class AbstractGenerator
{
    protected Printer $printer;

    public function __construct(
        private string $rootDir,
    ) {
        $this->printer = new PsrPrinter();
    }

    /**
     * Split the namespace and class name from a fully qualified class name.
     *
     * @return array{0: string, 1: string}
     */
    final protected function splitNamespaceAndClassName(string $fqcn): array
    {
        $parts = explode('\\', ltrim($fqcn, '\\'));
        $className = array_pop($parts);

        return [implode('\\', $parts), $className];
    }

    final protected function writeFile(PhpNamespace $namespace): void
    {
        $classes = $namespace->getClasses();
        assert(count($classes) === 1, sprintf('Expected exactly one class in namespace "%s", got %d.', $namespace->getName(), count($classes)));

        $filename = $this->rootDir . $this->getFileName($namespace->getName(), current($classes)->getName());

        $dirname = dirname($filename);
        if (! is_dir($dirname)) {
            mkdir($dirname, 0755, true);
        }

        $file = new PhpFile();
        $file->setStrictTypes();
        $file->setComment('THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!');
        $file->addNamespace($namespace);

        file_put_contents($filename, $this->printer->printFile($file));
    }

    /**
     * Thanks to PSR-4, the file name can be determined from the fully qualified class name.
     *
     * @param string ...$fqcn Fully qualified class name, merged if multiple parts
     *
     * @return string File name relative to the root directory
     */
    private function getFileName(string ...$fqcn): string
    {
        $fqcn = implode('\\', $fqcn);

        // Config from composer.json autoload
        $config = [
            'MongoDB\\Tests\\' => 'tests/',
            'MongoDB\\' => 'src/',
        ];
        foreach ($config as $namespace => $directory) {
            if (str_starts_with($fqcn, $namespace)) {
                return $directory . str_replace([$namespace, '\\'], ['', '/'], $fqcn) . '.php';
            }
        }

        throw new InvalidArgumentException(sprintf('Could not determine file name for "%s"', $fqcn));
    }
}
