<?php

declare(strict_types=1);

namespace DesignPatterns\Structural\Adapter;

class EBookAdapter implements BookInterface
{
    protected EBookInterface $eBook;

    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    /**
     * 这个类使接口进行适当的转换.
     */
    public function open()
    {
        $this->eBook->unlock();
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    /**
     * 注意这里适配器的行为： EBookInterface::getPage() 将返回两个整型，除了 BookInterface
     * 仅支持获得当前页，所以我们这里适配这个行为
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}