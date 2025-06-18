# JFPHP Framework

![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-8892BF.svg)
![License](https://img.shields.io/badge/license-GPL--3.0--or--later-blue.svg)

Um micro-framework PHP com componentes modernos, fortemente tipados e reutilizáveis, projetado para acelerar o desenvolvimento de projetos com código limpo e robusto.

---

## Visão Geral

O JFPHP nasceu da necessidade de ter um conjunto de ferramentas padronizadas e modernas para lidar com tarefas comuns do desenvolvimento PHP, como a manipulação de coleções de dados e o tratamento de requisições HTTP. O framework é construído com as funcionalidades mais recentes do PHP 8.2+, incluindo `Enums`, classes `readonly` e tipagem estrita para máxima segurança e performance.

## Principais Funcionalidades

* **API de Coleções Genéricas**: Um sistema completo para trabalhar com listas e conjuntos de forma orientada a objetos.
    * `ListInterface`: Para coleções ordenadas que permitem acesso por índice (`ArrayList`).
    * `SetInterface`: Para coleções de elementos únicos (`HashSet`).
    * `ListIteratorInterface`: Um iterador avançado com suporte a navegação bidirecional e modificação durante o loop.
* **Manipulador de Requisições HTTP**: Um sistema desacoplado e moderno para lidar com dados de entrada.
    * Detecta automaticamente o método HTTP (`GET`, `POST`, `PUT`, `PATCH`, etc.).
    * Parseia dados de `$_GET`, `$_POST` e corpos de requisição `JSON`.
    * Utiliza um sistema de `Sanitizer` injetável para validação e limpeza de dados.
    * Retorna dados em `Value Objects` imutáveis e com tipo garantido.

## Estrutura do Framework (Namespaces)

Aqui está um mapa de todas as classes e interfaces disponíveis no framework:

* **`jayroncastro\jfphp`**
    * `ArrayList`
    * `HashSet`
    * `ArrayListIterator`
    * **`collections`** (Sub-namespace conceitual para interfaces de coleção)
        * `CollectionInterface`
        * `ListInterface`
        * `SetInterface`
        * `ListIteratorInterface`
    * **`abstract`** (Sub-namespace conceitual para classes base)
        * `AbstractCollection`
        * `AbstractList`
        * `AbstractSet`
* **`jayroncastro\jfphp\lang`**
    * `ValueObject`
* **`jayroncastro\jfphp\http`**
    * `Request`
    * `RequestParams`
    * `RequestResult` (Interface)
    * `SanitizerInterface`
    * **`enums`**
        * `DataType`
        * `HttpMethod`
    * **`result`**
        * `ArrayResult`
        * `BoolResult`
        * `EmailResult`
        * `FloatResult`
        * `HtmlResult`
        * `IntResult`
        * `RawResult`
        * `StringResult`
        * `TextareaResult`
        * `UrlResult`
* **`jayroncastro\jfphp\exception`**
    * `ExceptionMessage` (Enum)
    * `IndexOutOfBoundsException`
    * `IllegalStateException`
    * `NoSuchElementException`

## Requisitos

* PHP >= 8.2

## Instalação

A forma recomendada de instalar o JFPHP é via [Composer](https://getcomposer.org/).

```bash
composer require jayroncastro/jfphp
```

## Como Usar

### 1. Coleções

O sistema de coleções fornece uma API fluente e poderosa para manipular arrays de forma orientada a objetos.

**Exemplo com `ArrayList`:**

```php
use jayroncastro\jfphp\ArrayList;

$lista = new ArrayList(['PHP', 'JavaScript']);
$lista->add('Python');
// $lista agora contém ['PHP', 'JavaScript', 'Python']
```

**Exemplo com `HashSet`:**
```php
use jayroncastro\jfphp\HashSet;

$set = new HashSet();
$set->add('vermelho'); // true (adicionado)
$set->add('vermelho'); // false (ignorado, pois já existe)
// $set agora contém ['vermelho']
```

### 2. Manipulador de Requisições

O sistema permite buscar dados de `$_POST`, `$_GET`, ou do corpo da requisição de forma segura.

**Exemplo de uso em um projeto (ex: WordPress):**

```php
// 1. Crie um Sanitizer específico para seu projeto (ex: no seu plugin)
class WordPressSanitizer implements \jayroncastro\jfphp\http\SanitizerInterface {
    // ... lógica com funções do WordPress ...
}

// 2. Use o framework para pegar os dados
use jayroncastro\jfphp\http\Request;
use jayroncastro\jfphp\http\RequestParams;
use jayroncastro\jfphp\http\enums\DataType;

$request = new Request(new WordPressSanitizer());
$params = new RequestParams('user_email', DataType::EMAIL);
$emailResult = $request->getParam($params);
$emailLimpo = $emailResult->getValue();
```

## Licença

Este framework está licenciado sob a Licença Pública Geral GNU v3.0 ou posterior. Veja o arquivo `LICENSE` para mais detalhes.

## Autor

Criado e mantido por **Jayron Castro**.
```