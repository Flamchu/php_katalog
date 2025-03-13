# Dokumentace pro produktový katalog

## Obecný popis projektu

Tento projekt představuje jednoduchý produktový katalog, který využívá architekturu MVC (Model-View-Controller). Slouží k zobrazení seznamu produktů a filtrování těchto produktů podle kategorií. Uživatelé mohou procházet produkty a filtrovat je na základě různých parametrů. Katalog je napojen na databázi, kde jsou uloženy informace o produktech, kategoriích a jejich propojení.

### Model-View-Controller (MVC)

Projekt využívá architekturu MVC, která rozděluje logiku aplikace na tři hlavní komponenty:

1. **Model (M)**: Tato část aplikace se stará o manipulaci s daty a komunikaci s databází. Modely definují strukturu tabulek, operace nad daty a poskytují funkce pro získání informací z databáze.
2. **View (V)**: Zodpovídá za zobrazení dat uživateli. Zobrazuje produkty, kategorie a další informace prostřednictvím HTML šablon.
3. **Controller (C)**: Kontroler je prostředník mezi modelem a zobrazením. Zpracovává požadavky uživatelů, získává potřebná data z modelů a předává je do pohledů pro zobrazení.

## Možnosti komunikace s databází prostřednictvím PDO

Pro komunikaci s databází je v projektu využíváno PDO (PHP Data Objects), což je flexibilní a bezpečný způsob připojení k databázi v PHP. PDO umožňuje bezpečné provádění SQL dotazů, včetně parametrizovaných dotazů, což zvyšuje bezpečnost proti SQL injection útokům.

### Příklad připojení k databázi:

```php
<?php
$host = 'localhost';
$port = '3306';
$db = 'katalog';
$user = 'root';
$pass = 'VelmiBezpecneHeslo';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
```

### Příklad parametrizovaného dotazu:

```php
<?php
// Příklad dotazu pro přidání nové kategorie
public function addCategory($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
?>
```

## Hashování hesla a jeho následné ověření

V projektu se pro správu administrátorských přihlašovacích údajů používá hashování hesla. Toto je důležitý bezpečnostní krok, aby hesla nebyla čitelná ve své pravé podobě.

### Postup hashování hesla:

1. **Hashování hesla**: Používá se funkce `hash()`, která generuje silný hash hesla. Tato funkce může používat různé algoritmy, v projektu používá SHA-256, který je považován za poměrně bezpečný.

2. **Ověření hesla**: Při přihlášení administrátora se zadané heslo porovná s uloženým hashem (opět pomocí funkce `hash()`). Poté porovnávám heslo s hashem a vracím `true`, pokud se shodují.

### Příklad hashování hesla:

```php
<?php
hash('sha256', $password);
?>
```

### Příklad ověření hesla:

```php
<?php
$user && hash('sha256', $password) === $user['password_hash'];
?>
```

## Popis a zdůvodnění řešení

### Architektura MVC

Tato architektura byla zvolena z několika důvodů:

- **Modularita**: MVC umožňuje jasné oddělení logiky aplikace, což usnadňuje její údržbu a rozšiřování. Každý komponent (Model, View, Controller) má svou odpovědnost, což zjednodušuje práci na projektu více vývojářům.
- **Flexibilita**: Umožňuje snadnou změnu uživatelského rozhraní (View), aniž by bylo nutné měnit logiku aplikace (Model, Controller). Stejně tak je možné upravit logiku zpracování dat bez změny vzhledu.
- **Bezpečnost**: Použití PDO pro komunikaci s databází poskytuje ochranu proti SQL injection, což zvyšuje bezpečnost aplikace.

### Hashování hesla

Hashování hesla je nutné pro zajištění bezpečnosti administrátorských přihlašovacích údajů. Použití algoritmu SHA-256 (pomocí funkce `hash()`) zaručuje, že hesla jsou uložena bezpečně a neexistuje způsob, jak je získat zpět ve své původní podobě. Ověření hesla, za pomoci porovnání hashe hesla zadaného uživatelem, který se chce přihlásit a hashe uloženého v databázi pak poskytuje bezpečný způsob, jak zajistit přihlašování uživatelů a bezpečnost dat, aniž by se kdekoliv ukládalo heslo ve své čisté textové podobě.
