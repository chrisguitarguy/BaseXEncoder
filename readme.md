# BaseXEncoder

Turn a number, like an auto incremented database ID, into a nicer, URL friendly
string. And go the other way too. Useful for something like a URL shortener.

## Examples

Using the default, 52 character (a-z, A-Z, 0-9 without vowels) alphabet.

    $e = new BaseXEncoder();
    $res = $e->encode(125); // $res == "dB"
    $num = $e->decode($res); // $num = 125

Using a custom alphabet.

    $e = new BaseXEncoder('abcdefg');
    $num = 123098231;
    $res = $e->encode($num);
    $e->decode($res) == $num // true
