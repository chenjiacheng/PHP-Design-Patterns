# PHP设计模式

**创建型模式**

* [单例模式（Singleton）](Creational/Singleton)
* [简单工厂模式（Simple Factory）](Creational/SimpleFactory)
* [工厂方法模式（Factory Method）](Creational/FactoryMethod)
* [抽象工厂模式（Abstract Factory）](Creational/AbstractFactory)
* [静态工厂模式（Static Factory）](Creational/StaticFactory)
* [建造者模式（Builder）](Creational/Builder)

- [原型模式（Prototype）](Creational/Prototype)

**结构型模式**

* [代理模式（Proxy）](Structural/Proxy)
* [桥接模式（Bridge）](Structural/Bridge)
* [装饰模式（Decorator）](Structural/Decorator)
* [适配器模式（Adapter）](Structural/Adapter)

- [门面模式（Facade）](Structural/Facade)
- [组合模式（Composite）](Structural/Composite)
- [享元模式（Flyweight）](Structural/Flyweight)

**行为型模式**

* [观察者模式（Observer）](Behavioral/Observer)
* [模板方法模式（Template Method）](Behavioral/TemplateMethod)
* [策略模式（Strategy）](Behavioral/Strategy)
* [责任链模式（Chain of Responsibility）](Behavioral/ChainOfResponsibilities)
* [迭代器模式（Iterator）](Behavioral/Iterator)
* [状态模式（State）](Behavioral/State)

- [访问者模式（Visitor）](Behavioral/Visitor)
- [备忘录模式（Memento）](Behavioral/Memento)
- [命令模式（Command）](Behavioral/Command)
- [解释器模式（Interpreter）](Behavioral/Interpreter)
- [中介者模式（Mediator）](Behavioral/Mediator)

## 创建型模式

创建型设计模式简单来说就是用来创建对象的

| 设计模式                      | 简述                                           | 一句话归纳                     | 目的             | 案例       |
| ----------------------------- | ---------------------------------------------- | ------------------------------ | ---------------- | ---------- |
| 单例模式（Singleton Pattern） | 保证一个类仅有一个实例，并且提供一个全局访问点 | 世上只有一个我                 | 保证独一无二     | 数据库创建 |
| 工厂模式（Factory Pattern）   | 不同条件下创建不同实例                         | 产品标准化，生产更高效         | 封装创建细节     | 实体工厂   |
| 建造者模式（Builder Pattern） | 用来创建复杂的复合对象                         | 高配中配和低配，想选哪配就哪配 | 开放个性配置步骤 | 选配       |
| 原型模式（Prototype Pattern） | 通过拷贝原型创建新的对象                       | 拔一根猴毛，吹出千万个         | 高效创建对象     | 克隆       |

### 单例模式

```php
$db1 = Db::getInstance();
$db2 = Db::getInstance();
var_dump($db1 === $db2); // true

/**
 * 结构
 * 4私1公；
 * 私有化构造方法：防止使用 new 创建多个实例；
 * 私有化克隆方法：防止 clone 多个实例；
 * 私有化重建方法：防止反序列化；
 * 私有化静态属性：防止直接访问存储实例的属性；
 */
class Db
{
    // 私有化静态属性
    private static $instance = null;

    public static function getInstance(): Db
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // 私有化构造方法
    private function __construct()
    {
    }

    // 私有化克隆方法
    private function __clone()
    {
    }

    // 私有化重建方法
    public function __wakeup()
    {
    }
}
```

### 简单工厂模式

```php
$simpleFactory = new SimpleFactory();

$productA = $simpleFactory->createProductA();
$info = $productA->info();
var_dump($info); // A-info

$productB = $simpleFactory->createProductB();
$name = $productB->name();
var_dump($name); // B-name

/**
 * 结构
 * 简单工厂（SimpleFactory）：是简单工厂模式的核心，负责实现创建所有实例的内部逻辑。工厂类的创建产品类的方法可以被外界直接调用，创建所需的产品对象。
 * 抽象产品（Product）：是简单工厂创建的所有对象的父类，负责描述所有实例共有的公共接口。
 * 具体产品（ConcreteProduct）：是简单工厂模式的创建目标。
 */
// 结构工厂
class SimpleFactory
{
    // 具体产品
    public function createProductA(): ProductA
    {
        return new ProductA();
    }

    // 具体产品
    public function createProductB(): ProductB
    {
        return new ProductB();
    }
}

// 抽象产品
class ProductA
{
    public function info(): string
    {
        return 'A-info';
    }
}

// 抽象产品
class ProductB
{
    public function name(): string
    {
        return 'B-name';
    }
}
```

### 工厂方法模式

```php
$productAFactory = new ProductAFactory();
$productA = $productAFactory->createProduct();
$infoA = $productA->info();
var_dump($infoA); // A-info

$productBFactory = new ProductBFactory('name');
$productB = $productBFactory->createProduct();
$infoB = $productB->info();
var_dump($infoB); // B-info-name

/**
 * 结构
 * 抽象工厂（Abstract Factory）：提供了创建产品的接口，调用者通过它访问具体工厂的工厂方法 newProduct() 来创建产品。
 * 具体工厂（ConcreteFactory）：主要是实现抽象工厂中的抽象方法，完成具体产品的创建。
 * 抽象产品（Product）：定义了产品的规范，描述了产品的主要特性和功能。
 * 具体产品（ConcreteProduct）：实现了抽象产品角色所定义的接口，由具体工厂来创建，它同具体工厂之间一一对应。
 */
// 抽象产品接口
interface Product
{
    public function info();
}

// 抽象产品
class ProductA implements Product
{
    public function info(): string
    {
        return 'A-info';
    }
}

// 抽象产品
class ProductB implements Product
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function info(): string
    {
        return 'B-info-' . $this->name;
    }
}

// 抽象工厂接口
interface ProductFactory
{
    public function createProduct(): Product;
}

// 抽象工厂
class ProductAFactory implements ProductFactory
{
    // 具体产品
    public function createProduct(): Product
    {
        return new ProductA();
    }
}

// 抽象工厂
class ProductBFactory implements ProductFactory
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    // 具体产品
    public function createProduct(): Product
    {
        return new ProductB($this->name);
    }
}
```

### 抽象工厂模式

```php
$factory = new ProductFactory();

$productA = $factory->createProductA(150);
$priceA = $productA->calculatePrice();
var_dump($priceA); // 150

$productB = $factory->createProductB(150);
$priceB = $productB->calculatePrice();
var_dump($priceB); // 200

/**
 * 结构
 * 抽象工厂（Abstract Factory）：提供了创建产品的接口，它包含多个创建产品的方法 newProduct()，可以创建多个不同等级的产品。
 * 具体工厂（Concrete Factory）：主要是实现抽象工厂中的多个抽象方法，完成具体产品的创建。
 * 抽象产品（Product）：定义了产品的规范，描述了产品的主要特性和功能，抽象工厂模式有多个抽象产品。
 * 具体产品（ConcreteProduct）：实现了抽象产品角色所定义的接口，由具体工厂来创建，它同具体工厂之间是多对一的关系。
 */
// 抽象产品接口
interface Product
{
    // 计算价格
    public function calculatePrice(): int;
}

// 抽象产品
class ProductA implements Product
{
    private int $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function calculatePrice(): int
    {
        return $this->price;
    }
}

// 抽象产品
class ProductB implements Product
{
    private int $productPrice;

    private int $shippingCosts;

    public function __construct(int $productPrice, int $shippingCosts)
    {
        $this->productPrice = $productPrice;
        $this->shippingCosts = $shippingCosts;
    }

    public function calculatePrice(): int
    {
        return $this->productPrice + $this->shippingCosts;
    }
}

// 抽象工厂
class ProductFactory
{
    const SHIPPING_COSTS = 50;

    // 具体产品
    public function createProductA(int $price): Product
    {
        return new ProductA($price);
    }

    // 具体产品
    public function createProductB(int $price): Product
    {
        return new ProductB($price, self::SHIPPING_COSTS);
    }
}
```

**工厂方法模式和抽象工厂模式的区别**

首先来看看两者的定义区别：

- 工厂方式模式：定义一个用于创建对象的接口，让子类决定实例化哪一个类
- 抽象工厂模式：为创建一组相关或相互依赖的对象提供一个接口，而且无需指定他们的具体类

个人觉得这个区别在于产品，如果产品单一，最合适用工厂方法模式，但是如果有多个业务品种、业务分类时，通过抽象工厂模式产生需要的对象是一种非常好的解决方式。 再通俗深化理解下：**工厂方法模式针对的是一个产品等级结构 ，抽象工厂模式针对的是面向多个产品等级结构的**。

再来看看工厂方法模式与抽象工厂模式对比：

| 工厂方法模式                               | 抽象工厂模式                               |
| :----------------------------------------- | :----------------------------------------- |
| 针对的是单个产品等级结构                   | 针对的是面向多个产品等级结构               |
| 一个抽象产品类                             | 多个抽象产品类                             |
| 可以派生出多个具体产品类                   | 每个抽象产品类可以派生出多个具体产品类     |
| 一个抽象工厂类，可以派生出多个具体工厂类   | 一个抽象工厂类，可以派生出多个具体工厂类   |
| 每个具体工厂类只能创建一个具体产品类的实例 | 每个具体工厂类可以创建多个具体产品类的实例 |

### 静态工厂模式

```php
$productA = StaticFactory::factory('A');
$infoA = $productA->info();
var_dump($infoA); // A-info

$productB = StaticFactory::factory('B');
$infoB = $productB->info();
var_dump($infoB); // B-info

/**
 * 结构
 * 静态工厂（StaticFactory）：是简单工厂模式的核心，负责实现创建所有实例的内部逻辑。工厂类的创建产品类的方法可以被外界直接调用，创建所需的产品对象。
 * 抽象产品（Product）：是简单工厂创建的所有对象的父类，负责描述所有实例共有的公共接口。
 * 具体产品（ConcreteProduct）：是简单工厂模式的创建目标。
 */
// 抽象产品接口
interface Product
{
    public function info();
}

// 抽象产品
class ProductA implements Product
{
    public function info(): string
    {
        return 'A-info';
    }
}

// 抽象产品
class ProductB implements Product
{
    public function info(): string
    {
        return 'B-info';
    }
}

// 静态工厂
class StaticFactory
{
    // 具体产品
    public static function factory(string $type): ProductA|ProductB
    {
        if ($type == 'A') {
            return new ProductA();
        }

        if ($type == 'B') {
            return new ProductB();
        }

        throw new \InvalidArgumentException('Unknown format given');
    }
}
```

### 建造者模式

```php
$director = new Director(); // 指挥者

// 建造汽车
$productABuilder = new ProductABuilder();
$newProductA = $director->build($productABuilder);
var_dump($newProductA); // ProductA::class

// 建造卡车
$productBBuilder = new ProductBBuilder();
$newProductB = $director->build($productBBuilder);
var_dump($newProductB); // ProductB::class

/**
 * 结构
 * 产品角色（Product）：它是包含多个组成部件的复杂对象，由具体建造者来创建其各个零部件。
 * 抽象建造者（Builder）：它是一个包含创建产品各个子部件的抽象方法的接口，通常还包含一个返回复杂产品的方法 getResult()。
 * 具体建造者(Concrete Builder）：实现 Builder 接口，完成复杂产品的各个部件的具体创建方法。
 * 指挥者（Director）：它调用建造者对象中的部件构造与装配方法完成复杂对象的创建，在指挥者中不涉及具体产品的信息。
 */
// 产品角色接口（车类）
abstract class Product
{
    public function setPart($key, $value): void
    {
    }
}

// 产品角色（汽车）
class ProductA extends Product
{

}

// 产品角色（卡车）
class ProductB extends Product
{

}

// 抽象建造者接口（车类生产者）
interface ProductBuilder
{
    public function createProduct(); // 创建产品

    public function addWheel(); // 添加轮子

    public function addEngine(); // 添加发动机

    public function addDoors(); // 添加门

    public function getProduct(): Product; // 获取产品
}

// 具体建造者（汽车生产者）
class ProductABuilder implements ProductBuilder
{
    private ProductA $productA;

    // 添加轮子
    public function addWheel()
    {
        $this->productA->setPart('wheelLF', new Wheel());
        $this->productA->setPart('wheelRF', new Wheel());
        $this->productA->setPart('wheelLR', new Wheel());
        $this->productA->setPart('wheelRR', new Wheel());
    }

    // 添加门
    public function addDoors()
    {
        $this->productA->setPart('rightDoor', new Door());
        $this->productA->setPart('leftDoor', new Door());
        $this->productA->setPart('trunkLid', new Door());
    }

    // 添加发动机
    public function addEngine()
    {
        $this->productA->setPart('engine', new Engine());
    }

    public function createProduct()
    {
        $this->productA = new ProductA();
    }

    public function getProduct(): Product
    {
        return $this->productA;
    }
}

// 具体建造者（卡车生产者）
class ProductBBuilder implements ProductBuilder
{
    private ProductB $productB;

    // 添加轮子
    public function addWheel()
    {
        $this->productB->setPart('wheel1', new Wheel());
        $this->productB->setPart('wheel2', new Wheel());
        $this->productB->setPart('wheel3', new Wheel());
        $this->productB->setPart('wheel4', new Wheel());
        $this->productB->setPart('wheel5', new Wheel());
        $this->productB->setPart('wheel6', new Wheel());
    }

    // 添加发动机
    public function addEngine()
    {
        $this->productB->setPart('truckEngine', new Engine());
    }

    // 添加门
    public function addDoors()
    {
        $this->productB->setPart('rightDoor', new Door());
        $this->productB->setPart('leftDoor', new Door());
    }

    public function createProduct()
    {
        $this->productB = new ProductB();
    }

    public function getProduct(): Product
    {
        return $this->productB;
    }
}

// 指挥者
class Director
{
    public function build(ProductBuilder $builder): Product
    {
        $builder->createProduct();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getProduct();
    }
}

// 轮子
class Wheel
{
}

// 发动机
class Engine
{
}

// 门
class Door
{
}
```

### 原型模式

```php
// 创建一个原型对象
$mapPrototype = new Map(40, 60, new Sea());
// 如果我们要创建一个新的map对象只需要克隆一下
$newMap = clone $mapPrototype;

var_dump($mapPrototype->sea === $newMap->sea); // false，如果是浅拷贝，输出的是 true

/**
 * 结构
 * 抽象原型类（Prototype）：规定了具体原型对象必须实现的接口。
 * 具体原型类（ConcretePrototype）：实现抽象原型类的 clone() 方法，它是可被复制的对象。
 */
// 抽象原型类
abstract class Prototype
{
    abstract public function __clone();
}

// 具体原型类
class Map extends Prototype
{
    public int $width; // 宽
    public int $height; // 高
    public Sea $sea; // 海洋

    public function __construct($width, $height, Sea $sea)
    {
        $this->width = $width;
        $this->height = $height;
        $this->sea = $sea;
    }

    public function __clone()
    {
        // 现在是深拷贝，如果去掉此处，就是浅拷贝
        $this->sea = clone $this->sea;
    }
}

// 海洋类
class Sea
{
}
```

## 结构型模式

结构型设计模式就是关注类和对象的组合

| 设计模式                      | 简述                                                         | 一句话归纳                     | 目的               | 案例         |
| ----------------------------- | ------------------------------------------------------------ | ------------------------------ | ------------------ | ------------ |
| 代理模式（Proxy Pattern）     | 为其他对象提供一种代理以控制对这个对象的访问                 | 没有资源没时间，得找别人来帮忙 | 增强职责           | 媒婆         |
| 桥接模式（Bridge Pattern）    | 将两个能够独立变化的部分分离开来                             | 约定优于配置                   | 不允许用继承       | 桥           |
| 装饰模式（Decorator Pattern） | 为对象添加新功能                                             | 他大舅他二舅都是他舅           | 灵活扩展、同宗同源 | 煎饼         |
| 适配器模式（Adapter Pattern） | 将原来不兼容的两个类融合在一起                               | 万能充电器                     | 兼容转换           | 电源适配     |
| 门面模式（Facade Pattern）    | 对外提供一个统一的接口用来访问子系统                         | 打开一扇门，通向全世界         | 统一访问入口       | 前台         |
| 组合模式（Composite Pattern） | 将整体与局部（树形结构）进行递归组合，让客户端能够以一种的方式对其进行处理 | 人在一起叫团伙，心在一起叫团队 | 统一整体和个体     | 组织架构树   |
| 享元模式（Flyweight Pattern） | 使用对象池来减少重复对象的创建                               | 优化资源配置，减少重复浪费     | 共享资源池         | 全国社保联网 |

### 代理模式

```php
$subjectProxy = new SubjectOneProxy();
$subjectProxy->request();
/*输出结果：
string(48) "主题一访问真实主题之前的预处理。"
string(24) "访问真是主题方法"
string(51) "主题一访问真实主题之前的后续处理。"*/

$subjectProxy = new SubjectTwoProxy();
$subjectProxy->request();
/*输出结果：
string(48) "主题二访问真实主题之前的预处理。"
string(24) "访问真是主题方法"
string(51) "主题二访问真实主题之前的后续处理。"*/

/**
 * 结构
 * 抽象主题（Subject）类：通过接口或抽象类声明真实主题和代理对象实现的业务方法。
 * 真实主题（Real Subject）类：实现了抽象主题中的具体业务，是代理对象所代表的真实对象，是最终要引用的对象。
 * 代理（Proxy）类：提供了与真实主题相同的接口，其内部含有对真实主题的引用，它可以访问、控制或扩展真实主题的功能。
 */
// 抽象主题
interface Subject
{
    public function request();
}

// 真实主题
class RealSubject implements Subject
{
    public function request()
    {
        var_dump('访问真是主题方法');
    }
}

// 主题一代理
class SubjectOneProxy implements Subject
{
    private RealSubject $realSubject;

    public function request()
    {
        if (empty($this->realSubject)) {
            $this->realSubject = new RealSubject();
        }
        $this->preRequest();
        $this->realSubject->request();
        $this->postRequest();
    }

    public function preRequest()
    {
        var_dump('主题一访问真实主题之前的预处理。');
    }

    public function postRequest()
    {
        var_dump('主题一访问真实主题之前的后续处理。');
    }
}

// 主题二代理
class SubjectTwoProxy implements Subject
{
    private RealSubject $realSubject;

    public function request()
    {
        if (empty($this->realSubject)) {
            $this->realSubject = new RealSubject();
        }
        $this->preRequest();
        $this->realSubject->request();
        $this->postRequest();
    }

    public function preRequest()
    {
        var_dump('主题二访问真实主题之前的预处理。');
    }

    public function postRequest()
    {
        var_dump('主题二访问真实主题之前的后续处理。');
    }
}
```

### 桥接模式

```php
// 苹果笔记本
$apple = new Apple();
$computer = new Laptop($apple);
$info = $computer->info();
var_dump($info); // 苹果笔记本

// 联想台式机
$lenovo = new Lenovo();
$computer = new Desktop($lenovo);
$info = $computer->info();
var_dump($info); // 联想台式机

/**
 * 结构
 * 抽象化（Abstraction）角色：定义抽象类，并包含一个对实现化对象的引用。
 * 扩展抽象化（Refined Abstraction）角色：是抽象化角色的子类，实现父类中的业务方法，并通过组合关系调用实现化角色中的业务方法。
 * 实现化（Implementor）角色：定义实现化角色的接口，供扩展抽象化角色调用。
 * 具体实现化（Concrete Implementor）角色：给出实现化角色接口的具体实现。
 */
// 实现化（品牌）
interface Brand
{
    public function name(): string;
}

// 具体实现化（苹果品牌）
class Apple implements Brand
{
    public function name(): string
    {
        return '苹果';
    }
}

// 具体实现化（联想品牌）
class Lenovo implements Brand
{
    public function name(): string
    {
        return '联想';
    }
}

// 抽象化（电脑类型）
abstract class Computer
{
    // 组合品牌（桥）
    protected Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    abstract public function info(): string;
}

// 扩展抽象化（台式电脑）
class Desktop extends Computer
{
    public function info(): string
    {
        return $this->brand->name() . '台式机';
    }
}

// 扩展抽象化（笔记本电脑）
class Laptop extends Computer
{
    public function info(): string
    {
        return $this->brand->name() . '笔记本';
    }
}
```

### 装饰模式

```php
// 河粉
$hefen = new Hefen();
var_dump($hefen->name()); // 河粉
var_dump($hefen->price()); // 5

// 米粉
$mifen = new Mifen();
var_dump($mifen->name()); // 米粉
var_dump($mifen->price()); // 6

// 以下是装饰者

// 河粉+蛋
$egg = new Egg($hefen);
var_dump($egg->name()); // 河粉+蛋
var_dump($egg->price()); // 6

// 河粉+肉
$meat = new Meat($hefen);
var_dump($meat->name()); // 河粉+肉
var_dump($meat->price()); // 7

// 米粉+肠
$sausage = new Sausage($mifen);
var_dump($sausage->name()); // 米粉+肠
var_dump($sausage->price()); // 8

/**
 * 结构
 * 抽象构件（Component）角色：定义一个抽象接口以规范准备接收附加责任的对象。
 * 具体构件（ConcreteComponent）角色：实现抽象构件，通过装饰角色为其添加一些职责。
 * 抽象装饰（Decorator）角色：继承抽象构件，并包含具体构件的实例，可以通过其子类扩展具体构件的功能。
 * 具体装饰（ConcreteDecorator）角色：实现抽象装饰的相关方法，并给具体构件对象添加附加的责任。
 */
// 抽象构件（食物）
interface Food
{
    public function name(); // 名称

    public function price(); // 价格
}

// 具体构件（河粉）
class Hefen implements Food
{
    public function name()
    {
        return '河粉';
    }

    public function price()
    {
        return 5;
    }
}

// 具体构件（米粉）
class Mifen implements Food
{
    public function name()
    {
        return '米粉';
    }

    public function price()
    {
        return 6;
    }
}

// 抽象装饰（配料）
abstract class Decorator implements Food
{
    protected Food $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }
}

// 具体装饰（蛋）
class Egg extends Decorator
{
    public function name()
    {
        return $this->food->name() . '+蛋';
    }

    public function price()
    {
        return $this->food->price() + 1;
    }
}

// 具体装饰（肉）
class Meat extends Decorator
{
    public function name()
    {
        return $this->food->name() . '+肉';
    }

    public function price()
    {
        return $this->food->price() + 2;
    }
}

// 具体装饰（肠）
class Sausage extends Decorator
{
    public function name()
    {
        return $this->food->name() . '+肠';
    }

    public function price()
    {
        return $this->food->price() + 3;
    }
}
```

### 适配器模式

```php
// 原本的类
$book = new Book();
$book->open();
$book->turnPage();
var_dump($book->getPage()); // 2

// 适配器
$kindle = new Kindle();
$book = new EBookAdapter($kindle);
$book->open();
$book->turnPage();
var_dump($book->getPage()); // 2

/**
 * 结构
 * 目标（Target）接口：当前系统业务所期待的接口，它可以是抽象类或接口。
 * 适配者（Adaptee）类：它是被访问和适配的现存组件库中的组件接口。
 * 适配器（Adapter）类：它是一个转换器，通过继承或引用适配者的对象，把适配者接口转换成目标接口，让客户按目标接口的格式访问适配者。
 */
// 适配者接口类
interface BookInterface
{
    public function turnPage(); // 翻页

    public function open(); // 打开

    public function getPage(): int; // 获取页数
}

// 适配者（书）
class Book implements BookInterface
{
    private int $page;

    public function turnPage()
    {
        $this->page++;
    }

    public function open()
    {
        $this->page = 1;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}

// 目标接口(电子书）
interface EBookInterface
{
    public function unlock();

    public function pressNext();

    /**
     * 返回当前页和总页数，像 [10, 100] 是总页数100中的第10页。
     *
     * @return int[]
     */
    public function getPage(): array;
}

/**
 * 目标（具体电子书）
 * 这里是适配过的类. 在生产代码中, 这可能是来自另一个包的类，一些供应商提供的代码。
 * 注意它使用了另一种命名方案并用另一种方式实现了类似的操作
 */
class Kindle implements EBookInterface
{
    /**
     * @var int
     */
    private int $page = 1;

    /**
     * @var int
     */
    private int $totalPages = 100;

    public function pressNext()
    {
        $this->page++;
    }

    public function unlock()
    {
    }

    /**
     * 返回当前页和总页数，像 [10, 100] 是总页数100中的第10页。
     *
     * @return int[]
     */
    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}

// 适配器（电子书去适配普通书）
class EBookAdapter implements BookInterface
{
    protected EBookInterface $eBook;

    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    /**
     * 这个类使接口进行适当的转换.
     */
    public function open()
    {
        $this->eBook->unlock();
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
```

### 门面模式

```php
// 客户
$facade = new Facade();
$bool = $facade->prove();
var_dump($bool); // true

/**
 * 结构
 * 外观（Facade）角色：为多个子系统对外提供一个共同的接口。
 * 子系统（Sub System）角色：实现系统的部分功能，客户可以通过外观角色访问它。
 * 客户（Client）角色：通过一个外观角色访问各个子系统的功能。
 */
// 外观
class Facade
{
    private SubFlow1 $subFlow1;
    private SubFlow2 $subFlow2;
    private SubFlow3 $subFlow3;

    public function __construct()
    {
        $this->subFlow1 = new SubFlow1();
        $this->subFlow2 = new SubFlow2();
        $this->subFlow3 = new SubFlow3();
    }

    public function prove(): bool
    {
        $isTrue = $this->subFlow1->isTrue();
        $isOk = $this->subFlow2->isOk();
        $isSuccess = $this->subFlow3->isSuccess();

        return $isTrue && $isOk && $isSuccess;
    }
}

// 子系统
class SubFlow1
{
    public function isTrue(): bool
    {
        return true;
    }
}

// 子系统
class SubFlow2
{
    public function isOk(): bool
    {
        return true;
    }
}

// 子系统
class SubFlow3
{
    public function isSuccess(): bool
    {
        return true;
    }
}
```

### 组合模式

```php
$form = new Form();
$form->addElement(new TextElement('Email:'));
$form->addElement(new InputElement());

$embed = new Form();
$embed->addElement(new TextElement('Password:'));
$embed->addElement(new InputElement());

$form->addElement($embed);

var_dump($form->render()); // <form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>

/**
 * 结构
 * 抽象构件（Component）角色：它的主要作用是为树叶构件和树枝构件声明公共接口，并实现它们的默认行为。在透明式的组合模式中抽象构件还声明访问和管理子类的接口；在安全式的组合模式中不声明访问和管理子类的接口，管理工作由树枝构件完成。（总的抽象类或接口，定义一些通用的方法，比如新增、删除）
 * 树叶构件（Leaf）角色：是组合中的叶节点对象，它没有子节点，用于继承或实现抽象构件。
 * 树枝构件（Composite）角色 / 中间构件：是组合中的分支节点对象，它有子节点，用于继承和实现抽象构件。它的主要作用是存储和管理子部件，通常包含 Add()、Remove()、GetChild() 等方法。
 */
// 抽象构件
interface RenderableInterface
{
    public function render(): string;
}

// 树叶构件
class TextElement implements RenderableInterface
{
    /**
     * @var string
     */
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(): string
    {
        return $this->text;
    }
}

// 树叶构件
class InputElement implements RenderableInterface
{
    public function render(): string
    {
        return '<input type="text" />';
    }
}

/**
 * 树枝构件
 * 该组合内的节点必须派生于该组件契约。为了构建成一个组件树，
 * 此为强制性操作。
 */
class Form implements RenderableInterface
{
    /**
     * @var RenderableInterface[]
     */
    private array $elements;

    /**
     * 遍历所有元素，并对他们调用 render() 方法，然后返回表单的完整
     * 的解析表达。
     *
     * 从外部上看，我们不会看到遍历过程，该表单的操作过程与单一对
     * 象实例一样
     *
     * @return string
     */
    public function render(): string
    {
        $formCode = '<form>';

        foreach ($this->elements as $element) {
            $formCode .= $element->render(); // 核心代码
        }

        $formCode .= '</form>';

        return $formCode;
    }

    /**
     * @param RenderableInterface $element
     */
    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}
```

### 享元模式

```php
$flyweight = new FlyweightFactory();
$zhangsan1 = $flyweight->getFlyweight('170cm的模特');
$show1 = $zhangsan1->show('第1件L号的衣服');
var_dump($show1); // 共享的享元：170cm的模特第1件L号的衣服

$zhangsan2 = $flyweight->getFlyweight('170cm的模特');
$show2 = $zhangsan2->show('第99件L号的衣服');
var_dump($show2); // 共享的享元：170cm的模特第99件L号的衣服

// 重点
var_dump($zhangsan1 === $zhangsan2); // true，170的模特一直是一个人；节省大量的内存；这样的特性使得享元模式可以运用于数据库连接池以及缓冲池等场景；

$lisi = $flyweight->getFlyweight('180cm的模特');
$show3 = $lisi->show('第1件XXL号的衣服');
var_dump($show3); // 共享的享元：180cm的模特第1件XXL号的衣服

$wangwu = new UnsharedConcreteFlyweight('190cm的模特');
$show4 = $wangwu->show('第1件XXXL号的衣服'); // 不共享的享元：190cm的模特第1件XXXL号的衣服
var_dump($show4);

$wangwu->delete();
$show5 = $wangwu->show('第1件XXXL号的衣服'); // 不共享的享元：第1件XXXL号的衣服
var_dump($show5);

/**
 * 结构
 * 抽象享元角色（Flyweight）：是所有的具体享元类的基类，为具体享元规范需要实现的公共接口，非享元的外部状态以参数的形式通过方法传入。
 * 具体享元（Concrete Flyweight）角色：实现抽象享元角色中所规定的接口。
 * 非享元（Unsharable Flyweight)角色：是不可以共享的外部状态，它以参数的形式注入具体享元的相关方法中。
 * 享元工厂（Flyweight Factory）角色：负责创建和管理享元角色。当客户对象请求一个享元对象时，享元工厂检査系统中是否存在符合要求的享元对象，如果存在则提供给客户；如果不存在的话，则创建一个新的享元对象。
 */
// 抽象享元角色
abstract class Flyweight
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function show($content)
    {
    }
}

// 共享的具体享元类
class ConcreteFlyweight extends Flyweight
{
    public function show($content)
    {
        return '共享的享元：' . $this->name . $content;
    }
}

// 不共享的具体享元类
class UnsharedConcreteFlyweight extends Flyweight
{
    public function show($content)
    {
        return '不共享的享元：' . $this->name . $content;
    }

    // 附加的删除方法
    public function delete()
    {
        $this->name = '';
    }
}

// 享元工厂
class FlyweightFactory
{
    private $flyweights = [];

    public function getFlyweight($name)
    {
        if (!isset($this->flyweights[$name])) {
            $this->flyweights[$name] = new ConcreteFlyweight($name);
        }
        return $this->flyweights[$name];
    }
}
```

## 行为型模式

行为型设计模式就是关注对象之间的通信

| 设计模式                                      | 简述                                                         | 一句话归纳                     | 目的                   | 案例           |
| --------------------------------------------- | ------------------------------------------------------------ | ------------------------------ | ---------------------- | -------------- |
| 观察者模式（Observer Pattern）                | 状态发生改变时通知观察者，一对多的关系                       | 到点就通知我                   | 解耦观察者与被观察者   | 闹钟           |
| 模板方法模式（Template Pattern）              | 定义一套流程模板，根据需要实现模板中的操作                   | 流程全部标准化，需要微调请覆盖 | 逻辑复用               | 手机开机打电话 |
| 策略模式（Strategy Pattern）                  | 封装不同的算法，算法之间能互相替换                           | 条条大道通罗马，具体哪条你来定 | 把选择权交给用户       | 选择支付方式   |
| 责任链模式（Chain of Responsibility Pattern） | 拦截的类都实现统一接口，每个接收者都包含对下一个接收者的引用。将这些对象连接成一条链，并且沿着这条链传递请求，直到有对象处理它为止。 | 各人自扫门前雪，莫管他们瓦上霜 | 解耦处理逻辑           | 请假审批流程   |
| 迭代器模式（Iterator Pattern）                | 提供一种方法顺序访问一个聚合对象中的各个元素                 | 流水线上坐一天，每个包裹扫一遍 | 统一对集合的访问方式   | 逐个检票进站   |
| 状态模式（State Pattern）                     | 根据不同的状态做出不同的行为                                 | 状态驱动行为，行为决定状态     | 绑定状态和行为         | 订单状态跟踪   |
| 访问者模式（Visitor Pattern）                 | 稳定数据结构，定义新的操作行为                               | 横看成岭侧成峰，远近高低各不同 | 解耦数据结构和数据操作 | 电脑组件升级   |
| 备忘录模式（Memento Pattern）                 | 保存对象的状态，在需要时进行恢复                             | 失足不成千古恨，想重来时就重来 | 备份、后悔机制         | 草稿箱         |
| 命令模式（Command Pattern）                   | 将请求封装成命令，并记录下来，能够撤销与重做                 | 运筹帷幄之中，决胜千里之外     | 解耦请求和处理         | 遥控器         |
| 解释器模式（Interpreter Pattern）             | 给定一个语言，定义它的语法表示，并定义一个解释器，这个解释器使用该标识来解释语言中的句子 | 我想说”方言“，一切解释权都归我 | 实现特定语法解析       | 摩斯密码       |
| 中介者模式（Mediator Pattern）                | 将对象之间的通信关联关系封装到一个中介类中单独处理，从而使其耦合松散 | 联系方式我给你，怎么搞定我不管 | 统一管理网状资源       | 朋友圈         |

### 观察者模式

```php
$observer = new UserObserver(); // 观察者
$user = new User();
$user->attach($observer); // 注册观察者

$user->changeEmail('foo@bar.com'); // 更新操作（监听）

var_dump($observer->getNotice()); // 昭告天下

/**
 * 结构
 * 抽象主题（Subject）角色：也叫抽象目标类，它提供了一个用于保存观察者对象的聚集类和增加、删除观察者对象的方法，以及通知所有观察者的抽象方法。
 * 具体主题（Concrete Subject）角色：也叫具体目标类，它实现抽象目标中的通知方法，当具体主题的内部状态发生改变时，通知所有注册过的观察者对象。
 * 抽象观察者（Observer）角色：它是一个抽象类或接口，它包含了一个更新自己的抽象方法，当接到具体主题的更改通知时被调用。
 * 具体观察者（Concrete Observer）角色：实现抽象观察者中定义的抽象方法，以便在得到目标的更改通知时更新自身的状态。
 */
// User 是具体主题，SplSubject（PHP自带） 是抽象主题
class User implements \SplSubject
{
    private string $email;

    private \SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

// UserObserver 是具体观察者，SplObserver（PHP自带） 是抽象观察者
class UserObserver implements \SplObserver
{
    private string $notice;

    // 它通常使用 SplSubject::notify() 通知主体
    public function update(\SplSubject $subject)
    {
        $this->notice = '昭告天下';
        var_dump($this->notice);
    }

    public function getNotice(): string
    {
        return $this->notice;
    }
}
```

### 模板方法模式

```php
$xiaomi = new Xiaomi();
$xiaomi->action();
/*string(6) "开机"
string(10) "小米logo"
string(9) "打电话"*/

$huawei = new Huawei();
$huawei->action();
/*string(6) "开机"
string(10) "华为logo"
string(9) "打电话"*/

/**
 * 结构
 * 抽象类（Abstract Class）：定义操作中骨架；比如说执行顺序等；讲具体的执行内容延迟到子类；
 * 具体子类（Concrete Class）：定义具体的执行内容；
 */
// 抽象类
abstract class Phone
{
    // 定义操作顺序
    final public function action()
    {
        $this->powerOn();
        $this->showLogo();
        $this->callUp();
    }

    // 开机
    protected function powerOn()
    {
        var_dump('开机');
    }

    // 显示logo
    abstract protected function showLogo();

    // 打电话
    protected function callUp()
    {
        var_dump('打电话');
    }
}

// 具体子类
class Xiaomi extends Phone
{
    protected function showLogo()
    {
        var_dump('小米logo');
    }
}

// 具体子类
class Huawei extends Phone
{
    protected function showLogo()
    {
        var_dump('华为logo');
    }
}
```

### 策略模式

```php
$concreteStrategyA = new ConcreteStrategyA();
$context = new Context($concreteStrategyA);
var_dump($context->strategyMethod()); // 具体策略A的策略方法被访问！

$concreteStrategyB = new ConcreteStrategyB();
$context = new Context($concreteStrategyB);
var_dump($context->strategyMethod()); // 具体策略B的策略方法被访问！

/**
 * 结构
 * 抽象策略（Strategy）类：定义了一个公共接口，各种不同的算法以不同的方式实现这个接口，环境角色使用这个接口调用不同的算法，一般使用接口或抽象类实现。
 * 具体策略（Concrete Strategy）类：实现了抽象策略定义的接口，提供具体的算法实现。
 * 环境（Context）类：持有一个策略类的引用，最终给客户端调用。
 */
// 抽象策略类
interface Strategy
{
    public function strategyMethod(); // 策略方法
}

// 具体策略类A
class ConcreteStrategyA implements Strategy
{
    public function strategyMethod(): string
    {
        return '具体策略A的策略方法被访问！';
    }
}

// 具体策略类B
class ConcreteStrategyB implements Strategy
{
    public function strategyMethod(): string
    {
        return '具体策略B的策略方法被访问！';
    }
}

// 环境类
class Context
{
    private Strategy $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function strategyMethod()
    {
        return $this->strategy->strategyMethod();
    }
}
```

### 责任链模式

```php
// 客户端
$teacher1 = new ClassAdviser();
$teacher2 = new DepartmentHead();
$teacher3 = new Dean();

$teacher1->setNext($teacher2);
$teacher2->setNext($teacher3);

var_dump($teacher1->handleRequest(1)); // 班主任批准请假1天
var_dump($teacher1->handleRequest(3)); // 系主任批准请假3天
var_dump($teacher1->handleRequest(8)); // 院长批准请假8天
var_dump($teacher1->handleRequest(11)); // 请假天数太多，没有人批准该假条

/**
 * 结构
 * 抽象处理者（Handler）角色：定义一个处理请求的接口，包含抽象处理方法和一个后继连接。
 * 具体处理者（Concrete Handler）角色：实现抽象处理者的处理方法，判断能否处理本次请求，如果可以处理请求则处理，否则将该请求转给它的后继者。
 * 客户类（Client）角色：创建处理链，并向链头的具体处理者对象提交请求，它不关心处理细节和请求的传递过程。
 */
// 抽象处理者（领导）
abstract class Leader
{
    private Leader $next;

    public function setNext(Leader $next): Leader
    {
        $this->next = $next;
        return $this;
    }

    public function getNext(): Leader
    {
        return $this->next;
    }

    abstract public function handleRequest(int $leaveDays);
}

// 具体处理者（班主任）
class ClassAdviser extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 2) {
            return "班主任批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}

// 具体处理者（系主任）
class DepartmentHead extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 7) {
            return "系主任批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}

// 具体处理者（院长）
class Dean extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 10) {
            return "院长批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}
```

### 迭代器模式

```php
$ag = new ConcreteAggregate();
$ag->add('张三');
$ag->add('李四');
$ag->add('王五');

$ci = $ag->getIterator();
while ($ci->hasNext()) {
    var_dump($ci->next());
    /*string(6) "张三"
    string(6) "李四"
    string(6) "王五"*/
}

$ag2 = new ConcreteAggregate();
$ag2->add('张三');
$ag2->add('李四');
$ag2->add('王五');
$ag2->remove('李四');

$ci2 = $ag2->getIterator();
while ($ci2->hasNext()) {
    var_dump($ci2->next());
    /*string(6) "张三"
    string(6) "王五"*/
}

/**
 * 结构
 * 抽象聚合（Aggregate）角色：定义存储、添加、删除聚合对象以及创建迭代器对象的接口。
 * 具体聚合（ConcreteAggregate）角色：实现抽象聚合类，返回一个具体迭代器的实例。
 * 抽象迭代器（Iterator）角色：定义访问和遍历聚合元素的接口，通常包含 hasNext()、first()、next() 等方法。
 * 具体迭代器（Concretelterator）角色：实现抽象迭代器接口中所定义的方法，完成对聚合对象的遍历，记录遍历的当前位置。
 */
// 抽象聚合
interface Aggregate
{
    public function add($name); // 增加一个

    public function remove($name); // 删除一个

    public function getIterator(): ConcreteIterator; // 获取迭代器
}

// 具体聚合
class ConcreteAggregate implements Aggregate
{
    private array $list;

    public function add($name)
    {
        $this->list[] = $name;
    }

    public function remove($name)
    {
        foreach ($this->list as $k => $v) {
            if ($name == $v) {
                unset($this->list[$k]);
            }
        }

        $this->list = array_values($this->list);
    }

    public function getIterator(): ConcreteIterator
    {
        return new ConcreteIterator($this->list);
    }
}

// 抽象迭代器（可使用系统内置类 \Iterator 代替）
interface Iterator
{
    public function hasNext(); // 判断是否还有下一个

    public function next(); // 获取下一个
}

// 具体迭代器
class ConcreteIterator implements Iterator
{
    private array $list;

    private int $index = 0;

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function hasNext()
    {
        return $this->index < count($this->list);
    }

    public function next()
    {
        if ($this->hasNext()) {
            $name = $this->list[$this->index];
            $this->index++;
            return $name;
        }
    }
}
```

### 状态模式

```php
$contextOrder = new ContextOrder();

// 创建订单
$order = new CreateOrder();
$contextOrder->setState($order);
var_dump($contextOrder->getStatus()); // created
$contextOrder->done();
var_dump($contextOrder->getStatus()); // shipping

// 订单发货
$order = new ShippingOrder();
$contextOrder->setState($order);
var_dump($contextOrder->getStatus()); // shipping
$contextOrder->done();
var_dump($contextOrder->getStatus()); // completed

/**
 * 结构
 * 环境类（Context）角色：也称为上下文，它定义了客户端需要的接口，内部维护一个当前状态，并负责具体状态的切换。
 * 抽象状态（State）角色：定义一个接口，用以封装环境对象中的特定状态所对应的行为，可以有一个或多个行为。
 * 具体状态（Concrete State）角色：实现抽象状态所对应的行为，并且在需要的情况下进行状态切换。
 */
// 环境类
class ContextOrder extends StateOrder
{
    public function getState(): StateOrder
    {
        return static::$state;
    }

    public function setState(StateOrder $state)
    {
        static::$state = $state;
    }

    public function done()
    {
        static::$state->done();
    }

    public function getStatus(): string
    {
        return static::$state->getStatus();
    }
}

// 抽象状态类
abstract class StateOrder
{
    private array $details;

    protected static $state;

    abstract protected function done();

    protected function setStatus(string $status)
    {
        $this->details['status'] = $status;
        $this->details['updatedTime'] = time();
    }

    protected function getStatus(): string
    {
        return $this->details['status'];
    }
}

// 具体状态类
class CreateOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('created');
    }

    protected function done()
    {
        static::$state = new ShippingOrder();
    }
}

// 具体状态类
class ShippingOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('shipping');
    }

    protected function done()
    {
        $this->setStatus('completed');
    }
}
```

### 访问者模式

未使用设计模式之前无法升级各个元件

```php
$computer = new Computer();
$computer->add(new Cpu());
$computer->add(new Memory());
$computer->add(new Keyboard());
$computer->print();
/*string(8) "i am cpu"
string(11) "i am memory"
string(13) "i am keyboard"*/

abstract class Unit
{
    abstract public function getName(); // 获取名称
}

// Cpu类
class Cpu extends Unit
{
    public function getName(): string
    {
        return 'i am cpu';
    }
}

// 内存类
class Memory extends Unit
{
    public function getName(): string
    {
        return 'i am memory';
    }
}

// 键盘类
class Keyboard extends Unit
{
    public function getName(): string
    {
        return 'i am keyboard';
    }
}

// 计算机类
class Computer
{
    protected array $items = [];

    public function add(Unit $unit): void
    {
        $this->items[] = $unit;
    }

    public function print(): void
    {
        // 循环打印各个组成部分
        foreach ($this->items as $item) {
            var_dump($item->getName());
        }
    }
}
```

使用访问者设计模式之后

```php
$computer = new Computer();
$computer->add(new Cpu());
$computer->add(new Memory());
$computer->add(new Keyboard());

// 升级前
$computer->print();
/*string(8) "i am cpu"
string(11) "i am memory"
string(13) "i am keyboard"*/

// 升级后
$printVisitor = new PrintVisitor();
$computer->print($printVisitor);
/*string(15) "hello, i am cpu"
string(18) "hello, i am memory"
string(20) "hello, i am keyboard"*/

/**
 * 结构
 * 抽象访问者（Visitor）角色：定义一个访问具体元素的接口，为每个具体元素类对应一个访问操作 visit() ，该操作中的参数类型标识了被访问的具体元素。
 * 具体访问者（ConcreteVisitor）角色：实现抽象访问者角色中声明的各个访问操作，确定访问者访问一个元素时该做什么。
 * 抽象元素（Element）角色：声明一个包含接受操作 accept() 的接口，被接受的访问者对象作为 accept() 方法的参数。
 * 具体元素（ConcreteElement）角色：实现抽象元素角色提供的 accept() 操作，其方法体通常都是 visitor.visit(this) ，另外具体元素中可能还包含本身业务逻辑的相关操作。
 * 对象结构（Object Structure）角色：是一个包含元素角色的容器，提供让访问者对象遍历容器中的所有元素的方法，通常由 List、Set、Map 等聚合类实现。
 */
// 抽象元素（组件）
abstract class Unit
{
    abstract public function getName(); // 获取名称

    abstract public function accept(Visitor $visitor); // 留一个升级入口
}

// 具体元素（Cpu类）
class Cpu extends Unit
{
    public function getName(): string
    {
        return 'i am cpu';
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitCpu($this);
    }
}

// 具体元素（内存类）
class Memory extends Unit
{
    public function getName(): string
    {
        return 'i am memory';
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitMemory($this);
    }
}

// 具体元素（键盘类）
class Keyboard extends Unit
{
    public function getName(): string
    {
        return 'i am keyboard';
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitKeyboard($this);
    }
}

// 抽象访问者
interface Visitor
{
    public function visitCpu(Cpu $cpu);

    public function visitMemory(Memory $memory);

    public function visitKeyboard(Keyboard $keyboard);
}

// 具体访问者
class PrintVisitor implements Visitor
{
    public function visitCpu(Cpu $cpu): string
    {
        return "hello, " . $cpu->getName();
    }

    public function visitMemory(Memory $memory): string
    {
        return "hello, " . $memory->getName();
    }

    public function visitKeyboard(Keyboard $keyboard): string
    {
        return "hello, " . $keyboard->getName();
    }
}

// 对象结构角色（计算机类）
class Computer
{
    protected array $items = [];

    public function add(Unit $unit): void
    {
        $this->items[] = $unit;
    }

    // 调用各个组件的accept方法
    public function print(Visitor $visitor = null): void
    {
        // 循环打印各个组成部分
        if ($visitor == null) {
            foreach ($this->items as $item) {
                var_dump($item->getName());
            }
        } else {
            foreach ($this->items as $item) {
                var_dump($item->accept($visitor));
            }
        }

    }
}
```

### 备忘录模式

```php
// 发起人
$or = new Originator();
// 管理者
$cr = new Caretaker();

$or->setState('s0');
var_dump('初始状态：' . $or->getState()); // 初始状态：s0

// 保存状态
$cr->setMemento($or->createMemento());

$or->setState('s1');
var_dump('新的状态：' . $or->getState()); // 新的状态：s1

// 恢复状态
$or->restoreMemento($cr->getMemento());
var_dump('恢复状态：' . $or->getState()); // 恢复状态：s0

/**
 * 结构
 * 发起人（Originator）角色：记录当前时刻的内部状态信息，提供创建备忘录和恢复备忘录数据的功能，实现其他业务功能，它可以访问备忘录里的所有信息。
 * 备忘录（Memento）角色：负责存储发起人的内部状态，在需要的时候提供这些内部状态给发起人。
 * 管理者（Caretaker）角色：对备忘录进行管理，提供保存与获取备忘录的功能，但其不能对备忘录的内容进行访问与修改。
 */
// 备忘录
class Memento
{
    private string $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function setState($state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }
}

// 发起人
class Originator
{
    private string $currentState;

    public function setState($state): void
    {
        $this->currentState = $state;
    }

    public function getState(): string
    {
        return $this->currentState;
    }

    public function createMemento(): Memento
    {
        return new Memento($this->currentState);
    }

    public function restoreMemento(Memento $memento): void
    {
        $this->currentState = $memento->getState();
    }
}

// 管理者
class Caretaker
{
    private Memento $memento;

    public function setMemento(Memento $m): void
    {
        $this->memento = $m;
    }

    public function getMemento(): Memento
    {
        return $this->memento;
    }
}
```

### 命令模式

```php
// 实例化调用者：服务员
$waiterInvoker = new WaiterInvoker();

// 设置早餐菜单
$waiterInvoker->setChangFen(new ChangFenCommand()); // 设置肠粉
$waiterInvoker->setHeFen(new HeFenCommand()); // 设置河粉
$waiterInvoker->setHunTun(new HunTunCommand()); // 设置馄饨

// 选择早餐
var_dump($waiterInvoker->chooseChangFen()); // 做好了肠粉
var_dump($waiterInvoker->chooseHeFen()); // 做好了河粉
var_dump($waiterInvoker->chooseHunTun()); // 做好了馄饨

/**
 * 结构
 * 抽象命令类（Command）角色：声明执行命令的接口，拥有执行命令的抽象方法 execute()。
 * 具体命令类（Concrete Command）角色：是抽象命令类的具体实现类，它拥有接收者对象，并通过调用接收者的功能来完成命令要执行的操作。
 * 实现者/接收者（Receiver）角色：执行命令功能的相关操作，是具体命令对象业务的真正实现者。
 * 调用者/请求者（Invoker）角色：是请求的发送者，它通常拥有很多的命令对象，并通过访问命令对象来执行相关请求，它不直接访问接收者。
 */
// 抽象命令类（早餐）
interface BreakfastCommand
{
    /**
     * 这是在命令行模式中很重要的方法，
     * 这个接收者会被载入构造器
     */
    public function execute();
}

// 具体命令类（肠粉）
class ChangFenCommand implements BreakfastCommand
{
    protected ChangFenReceiver $changFenReceiver;

    public function __construct()
    {
        $this->changFenReceiver = new ChangFenReceiver();
    }

    public function execute(): string
    {
        return $this->changFenReceiver->cooking();
    }
}

// 具体命令类（河粉）
class HeFenCommand implements BreakfastCommand
{
    protected HeFenReceiver $heFenReceiver;

    public function __construct()
    {
        $this->heFenReceiver = new HeFenReceiver();
    }

    public function execute(): string
    {
        return $this->heFenReceiver->cooking();
    }
}

// 具体命令类（馄饨）
class HunTunCommand implements BreakfastCommand
{
    protected HunTunReceiver $hunTunReceiver;

    public function __construct()
    {
        $this->hunTunReceiver = new HunTunReceiver();
    }

    public function execute(): string
    {
        return $this->hunTunReceiver->cooking();
    }
}

// 接收者（肠粉厨师）
class ChangFenReceiver
{
    public function cooking(): string
    {
        return '做好了肠粉';
    }
}

// 接收者（河粉厨师）
class HeFenReceiver
{
    public function cooking(): string
    {
        return '做好了河粉';
    }
}

// 接收者（馄饨厨师）
class HunTunReceiver
{
    public function cooking(): string
    {
        return '做好了馄饨';
    }
}

// 调用者（服务员）
class WaiterInvoker
{
    protected BreakfastCommand $changFenCommand;
    protected BreakfastCommand $heFenCommand;
    protected BreakfastCommand $hunTunCommand;

    public function setChangFen(BreakfastCommand $command)
    {
        $this->changFenCommand = $command;
    }

    public function setHeFen(BreakfastCommand $command)
    {
        $this->heFenCommand = $command;
    }

    public function setHunTun(BreakfastCommand $command)
    {
        $this->hunTunCommand = $command;
    }

    public function chooseChangFen()
    {
        return $this->changFenCommand->execute();
    }

    public function chooseHeFen()
    {
        return $this->heFenCommand->execute();
    }

    public function chooseHunTun()
    {
        return $this->hunTunCommand->execute();
    }
}
```

### 解释器模式

```php
// 客户端
$bus = new Context();

var_dump($bus->freeRide('深圳的老人')); // 本次乘车免费
var_dump($bus->freeRide('深圳的年轻人')); // 本次乘车扣费2元
var_dump($bus->freeRide('广州的妇女')); // 本次乘车免费
var_dump($bus->freeRide('广州的儿童')); // 本次乘车免费
var_dump($bus->freeRide('东莞的儿童')); // 本次乘车扣费2元

/**
 * 结构
 * 抽象表达式（Abstract Expression）角色：定义解释器的接口，约定解释器的解释操作，主要包含解释方法 interpret()。
 * 终结符表达式（Terminal Expression）角色：是抽象表达式的子类，用来实现文法中与终结符相关的操作，文法中的每一个终结符都有一个具体终结表达式与之相对应。
 * 非终结符表达式（Nonterminal Expression）角色：也是抽象表达式的子类，用来实现文法中与非终结符相关的操作，文法中的每条规则都对应于一个非终结符表达式。
 * 环境（Context）角色：通常包含各个解释器需要的数据或是公共的功能，一般用来传递被所有解释器共享的数据，后面的解释器可以从这里获取这些值。
 * 客户端（Client）：主要任务是将需要分析的句子或表达式转换成使用解释器对象描述的抽象语法树，然后调用解释器的解释方法，当然也可以通过环境角色间接访问解释器的解释方法。
 */
// 非终结符表达式类
class AndExpression implements Expression
{
    protected Expression $city;
    protected Expression $person;

    public function __construct(Expression $city, Expression $person)
    {
        $this->city = $city;
        $this->person = $person;
    }

    public function interpret(string $info): bool
    {
        $str = explode('的', $info);

        return $this->city->interpret($str[0]) && $this->person->interpret($str[1]);
    }
}

// 环境类
class Context
{
    protected array $citys = ['深圳', '广州'];
    protected array $persons = ['老人', '妇女', '儿童'];
    protected Expression $cityPerson;

    public function __construct()
    {
        $city = new TerminalExpression($this->citys);
        $person = new TerminalExpression($this->persons);
        $this->cityPerson = new AndExpression($city, $person);
    }

    public function freeRide(string $info): string
    {
        $ok = $this->cityPerson->interpret($info);
        if ($ok) {
            return '本次乘车免费';
        } else {
            return '本次乘车扣费2元';
        }
    }
}

// 抽象表达式类
interface Expression
{
    public function interpret(string $info): bool;
}

// 终结符表达式类
class TerminalExpression implements Expression
{
    protected array $list = [];

    public function __construct(array $data = [])
    {
        for ($i = 0; $i < count($data); $i++) {
            $this->list[] = $data[$i];
        }
    }

    public function interpret(string $info): bool
    {
        if (in_array($info, $this->list)) {
            return true;
        }

        return false;
    }
}
```

### 中介者模式

```php
$mediator = new ConcreteMediator();

$colleagueA = new ConcreteColleagueA();
$colleagueB = new ConcreteColleagueB();

$mediator->register($colleagueA);
$mediator->register($colleagueB);

$colleagueA->send();
var_dump('----------------------');
$colleagueB->send();

/*string(28) "具体同时类A发出请求"
string(28) "具体同时类A收到请求"
string(28) "具体同时类B收到请求"
string(22) "----------------------"
string(28) "具体同时类A收到请求"
string(28) "具体同时类B收到请求"
string(28) "具体同时类B发出请求"*/

/**
 * 结构
 * 抽象中介者（Mediator）角色：它是中介者的接口，提供了同事对象注册与转发同事对象信息的抽象方法。
 * 具体中介者（Concrete Mediator）角色：实现中介者接口，定义一个 List 来管理同事对象，协调各个同事角色之间的交互关系，因此它依赖于同事角色。
 * 抽象同事类（Colleague）角色：定义同事类的接口，保存中介者对象，提供同事对象交互的抽象方法，实现所有相互影响的同事类的公共功能。
 * 具体同事类（Concrete Colleague）角色：是抽象同事类的实现者，当需要与其他同事对象交互时，由中介者对象负责后续的交互。
 */
// 抽象同事类
abstract class Colleague
{
    protected Mediator $mediator;

    public function setMedium(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    abstract public function receive();

    abstract public function send();
}

// 具体同事类A
class ConcreteColleagueA extends Colleague
{
    public function receive(): string
    {
        var_dump('具体同时类A收到请求');
        return '具体同时类A收到请求';
    }

    public function send(): string
    {
        var_dump('具体同时类A发出请求');
        $this->mediator->relay(); // 请中介者转发
        return '具体同时类A发出请求';
    }
}

// 具体同事类B
class ConcreteColleagueB extends Colleague
{
    public function receive(): string
    {
        var_dump('具体同时类B收到请求');
        return '具体同时类B收到请求';
    }

    public function send(): string
    {
        $this->mediator->relay(); // 请中介者转发
        var_dump('具体同时类B发出请求');
        return '具体同时类B发出请求';
    }
}

// 抽象中介者
abstract class Mediator
{
    abstract public function register(Colleague $colleague); // 注册

    abstract public function relay(); // 转发
}

// 具体中介者
class ConcreteMediator extends Mediator
{
    protected array $list = [];

    public function register(Colleague $colleague)
    {
        if ($colleague !== null) {
            $this->list[] = $colleague;
            $colleague->setMedium($this);
        }
    }

    public function relay()
    {
        // 通知所有人
        foreach ($this->list as $item) {
            $item->receive();
        }
    }
}
```