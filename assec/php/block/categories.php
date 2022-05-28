<?        
$j = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '../../data/categories_sorter.json');
$data  =  json_decode($j, true)[0];
$cats = 1;
if (isset($_GET['lis'])) $cats = code($_GET['lis']);

$mits = 0;
if (isset($_GET['Nist'])) $mits = code($_GET['Nist']);

$gat_re  = -1;
if (isset($_GET['gategories'])) $gat_re = code($_GET['gategories']);

$item = '';
if (isset($_GET['items'])) $item = code($_GET['items']);
?>



<details class="items_elements_glav" <? if ($cats == 1) print 'open' ?>>
    <summary>Мальчики (1 - 6 лет)</summary>

    <details class="items_elements_zagalovok <? if ($gat_re == 'all' && $mist == 0 && $cats == 1) echo 'activ' ?>" onclick="locations('store&gategories=all&lis=1&Nist=0')">
        <summary>Все</summary>
    </details>

    <details class="items_elements_zagalovok" <? if ($mits == 1 && $cats == 1) print 'open' ?>>
        <summary>Категории</summary>
        <? foreach ($data['boys']['categor'] as $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=1&Nist=1">
                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 1) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>
    <details class="items_elements_zagalovok" <? if ($mits == 2 && $cats == 1) print 'open' ?>>
        <summary>Белье и пижамы</summary>
        <? foreach ($data['boys']['BiP'] as $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=1&Nist=2">

                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 1) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>
</details>

<details class="items_elements_glav" <? if ($cats == 0) print 'open' ?>>
    <summary>Девочки    (1 - 6 лет)</summary>

    <details class="items_elements_zagalovok <? if ($gat_re == 'all' && $mist == 0 && $cats == 0) echo 'activ' ?> " onclick="locations('store&gategories=all&lis=0&Nist=0')">
        <summary>Все</summary>
    </details>

    <details class="items_elements_zagalovok" <? if ($mits == 1 && $cats == 0) print 'open' ?>>
        <summary>Категории</summary>
        <? foreach ($data['girl']['categor'] as $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=0&Nist=1">
                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 0) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>
    <details class="items_elements_zagalovok" <? if ($mits == 2 && $cats == 0) print 'open' ?>>
        <summary>Белье и пижамы</summary>
        <? foreach ($data['girl']['BiP'] as $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=0&Nist=2">
                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 0) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>

</details>

<details class="items_elements_glav" <? if ($cats == 2) print 'open' ?>>
    <summary> Малыши   (0 - 1 года)</summary>

    <details class="items_elements_zagalovok <? if ($gat_re == 'all' && $mist == 0 && $cats == 2) echo 'activ' ?>" onclick="locations('store&gategories=all&lis=2&Nist=0')">
        <summary>Все</summary>
    </details>

    <details class="items_elements_zagalovok" <? if ($mits == 1 && $cats == 2) print 'open' ?>>
        <summary>Категории</summary>
        <? foreach ($data['baby']['categor'] as  $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=2&Nist=1">
                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 2) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>
    <details class="items_elements_zagalovok" <? if ($mits == 2 && $cats == 2) print 'open' ?>>
        <summary>Белье и пижамы</summary>
        <? foreach ($data['baby']['BiP'] as $item) { ?>
            <a href="store&gategories=<? print $item[0] ?>&lis=2&Nist=2">
                <p class="filsetr_items__element <? if ($gat_re == $item[0] && $cats == 2) print 'activision' ?>">
                    <? print $item[1] ?>
                </p>
            </a>
        <? } ?>
    </details>

</details>