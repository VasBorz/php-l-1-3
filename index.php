<?php
//Задание #3.1
$file = file_get_contents('data.xml');
$xml = new SimpleXMLElement($file);

function xml ($xml){
    echo '<br>';
    foreach ($xml as $value => $key){
        echo '<div style="background: azure; border: 1px solid #e1e1e1; padding: 14px 0 0 10px;">';
        echo '<strong>' . $value . '</strong>' . ':' . $key->__toString() . '<br><br>';
        echo '</div>';
        if (is_object($key)){
            xml ($key);
        }
    }
}

if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    xml($xml);
}
//Задача #3.2

$arr = [
    'user1' => [
      'age' => 32,
      'firstName' => 'Vasyl',
      'secondName' => 'Gorz'
  ],
    'user2' => [
        'age' => 25,
        'firstName' => 'Slava',
        'secondName' => 'Vrong'
    ],
    'user3' => [
        'age' => 28,
        'firstName' => 'Oksana',
        'secondName' => 'Berg'
    ]
];
$arr2 = [
    'user1' => [
        'age' => 32,
        'firstName' => 'Vasyl',
        'secondName' => 'Gorz'
    ],
    'user2' => [
        'age' => 25,
        'firstName' => 'Slava',
        'secondName' => 'Vrong'
    ],
    'user3' => [
        'age' => 28,
        'firstName' => 'Oksana',
        'secondName' => 'Berg'
    ],
    'user4' => [
        'age' => 19,
        'firstName' => 'Petr',
        'secondName' => 'Sandr'
    ]
];
$file = 'output.json';
$json = json_encode($arr);

file_put_contents($file,$json);
$json = json_decode($json,true);

if (rand(0,1)){
    $file2 = 'output2.json';
    $json2 = json_encode($arr2);
    file_put_contents($file2,$json2);
    $json2 = file_get_contents($file2);
    $json2 = json_decode($json2,true);
}else{
    $json2 = $json;
}

$res = array_diff_assoc($json2,$json);

if(empty($res)){
    echo "they are the same <br>";
}else{
    echo '<pre>' . print_r($res) . '</pre>';
}

//Задача #3.3
$arr = [];

for ($i = 0; $i <= 50; $i++){
    $arr[] .= $i;
}
$fp = fopen('test.csv','w');
fputcsv($fp,$arr,',');
fclose($fp);

$fp = fopen('test.csv','r');
$res = fgetcsv($fp,1000,',');
fclose($fp);


$sum = array_sum($res);
echo 'Sum of all elements in array is:' . $sum . '<br>';

//<!--Задача #3.4-->

$fp = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';

$json = file_get_contents($fp);
$json = json_decode($json,true);

//First version
echo 'The page id is: ' . $json['query']['pages']['15580374']['pageid'] . '<br>';
echo 'Title of the page is: ' . $json['query']['pages']['15580374']['title'] . '<br>';

//Second version
function rec($arr,$flag){
    foreach ($arr as $value => $key ){
       if (is_array($key)){
           rec($key,$flag);
       }
       if ($value === $flag){
           if (!is_array($key)){
               echo $key;
           }
       }
    }
}

rec($json,'title');
rec($json,'pageid');
