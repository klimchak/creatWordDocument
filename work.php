<?php

require_once 'vendor/autoload.php';

//определяем пути до файла и его название
$uploadDir = __DIR__.'\uploads\\';
$uploadFile = $uploadDir . 'dictionary.docx';

//переносим загруженный файл
move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
if (!file_exists($uploadFile)){
    header('Location: index.php?err=1');
    exit();
}

//Путь к файлу
$source = $uploadFile;

//новый шаблон объекта считывателя
$objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');

//функция считывание файла срандомными словами
function readFileTable ($objReader, $source){
    $body = array();
    $phpWord = $objReader->load($source);
    foreach ($phpWord->getSections() as $section) {
        $arrays = $section->getElements();
        foreach ($arrays as $array) {
            if (get_class($array) === 'PhpOffice\PhpWord\Element\Table'){
                $rows = $array->getRows();
                foreach ($rows as $row){
                    $cells = $row->getCells();
                    foreach ($cells as $cell){
                        $celements = $cell->getElements();
                        foreach ($celements as $celem){
                            if(get_class($celem) === 'PhpOffice\PhpWord\Element\Text') {
                                $body[] = $celem->getText();
                            }
                            if(get_class($celem) === 'PhpOffice\PhpWord\Element\TextRun') {
                                $elements = $celem->getElements();
                                foreach($elements as $element) {
                                    if (!method_exists($element, 'getText')){
                                        $body[] = 'rrrrr';
                                    }else{
                                        $body[] = $element->getText();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $body;
}

//считывание файла в массив и рандомим
$arrayKeyWord = readFileTable($objReader, $source);
shuffle($arrayKeyWord);

//условие на предельное количество слов
if (count($arrayKeyWord) < 2700){
    $val = 2701 - count($arrayKeyWord);
    $arrDop = array_slice($arrayKeyWord, -$val);
    $arrAllString = array_merge($arrDop, $arrayKeyWord);
}

//четыре независимых массива для 4х колонок
$arr1 = array_slice($arrAllString, 0, 675);
shuffle($arrayKeyWord);
$arr2 = array_slice($arrAllString, 675,675);
shuffle($arrayKeyWord);
$arr3 = array_slice($arrAllString, 1350, 675);
shuffle($arrayKeyWord);
$arr4 = array_slice($arrAllString, 2025, 675);

//объект шаблона для записи данных в файл
$_doc = new PhpOffice\PhpWord\TemplateProcessor('Template.docx');

//титульник
$_doc->setValue('d_org', $_POST['v1']); //добавить организацию
$_doc->setValue('d_address', $_POST['v2']); //адрес
$_doc->setValue('d_index', $_POST['v3']); //индекс
$_doc->setValue('d_name', $_POST['v4']); //Наименование основное
$_doc->setValue('d_nameS', $_POST['v5']); //наименование доп
$_doc->setValue('d_year', $_POST['v6']); //город и год


//функция записи в файл 1 и 2 столбца будущего словаря
function writeDoc($obj, $arr, $nameValCol1, $nameValCol2){
//запись колонки в первую таблицу
    shuffle($arr);
    $i = 1;
    foreach ($arr as $item) {
        $obj->setValue($nameValCol1 . $i, $item);
        ++$i;
    }

//запись столбца второй таблицы
    $i = 1;
    asort($arr);
    foreach ($arr as $item) {
        $obj->setValue($nameValCol2 . $i, $item);
        ++$i;
    }
}

//непосредственно запись в файл
writeDoc($_doc, $arr1, 'arr', 'arr_a');
writeDoc($_doc, $arr2, 'arr_2r', 'arr_2ra');
writeDoc($_doc, $arr3, 'arr_3r', 'arr_3ra');
writeDoc($_doc, $arr4, 'arr_4r', 'arr_4ra');


//доп поле истинности
$_doc->setValue('footer5', $_POST['v11']);

//удаление загруженного файла
if (unlink($source)){
    $del = 1;
}

// вывод непосредственно в браузер
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="tus'.$_POST['date'].'.docx"');
header('Cache-Control: max-age=0');
$_doc->saveAs('php://output');
die;